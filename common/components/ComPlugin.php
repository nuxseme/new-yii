<?php
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
 namespace common\components;

 use Yii;
 use yii\base\Component;
 use yii\base\Event;
 use yii\caching\Cache;
 use common\events\PluginEvent;

/**
 * plugin 组件
 *
 * @author caoxl
 */
 class ComPlugin extends Component implements Mountpoint{
 	/**
	*@var Cache|string 如果是Object 必须继承至 yii\caching\Cache 对象 
	*     如果是字符串则代表相应的类
 	*/
	public $cache = 'cache';

 	/**
	*@var array $lists 所有组件列表
 	*/
 	public $lists = array();

 	/**
	*@var string $baseNamespace 基础命名空间
 	*/
 	public $baseNamespace = 'plugins';

 	/**
	*@var array $_availablePlugins 所有可用的组件
 	*/
 	private $_availablePlugins = array();

 	/**
	*@var array $_loadedPlugins 所有已经加载进入的插件
 	*/
 	private $_loadedPlugins = array();

 	/**
	*@var PluginEvent 插件事件对象
 	*/
 	private $_pluginEvent = null;

 	/**
     * 初始化插件
     *
     * @param void
     */
 	public function init()
 	{
 		//设置插件别名
 		(!$this->baseNamespace || !is_string($this->baseNamespace)) && $this->baseNamespace = 'plugins';
 		Yii::setAlias($this->baseNamespace, SYS_COMMON_PATH . 'plugins');

 		//获取可用插件
 		$this->getAvailablePlugins();

 		//加载可用插件
 		!empty($this->_availablePlugins) && $this->loadPlugins();
 	}

 	/**
     * 获取可用插件
     * 如果开启缓存,则不直接进行解析,
     * 先从缓存中获取hash对比当前配置hash 如一致则取缓存 否则重新解析 并重写缓存
     *
     * @param void
     * @return void
     */
 	public function getAvailablePlugins()
 	{
 		if(is_string($this->cache))
 		{
            $this->cache = Yii::$app->get($this->cache, false);
        }

 		if($this->cache instanceof Cache) 
 		{
            $cacheKey = __CLASS__;
            $hash = md5(json_encode($this->lists));//当前配置的hash
            if(($data = $this->cache->get($cacheKey)) !== false && isset($data[1]) && $data[1] === $hash) 
            {//如果缓存存在并且hash匹配则使用缓存
            	$this->_availablePlugins = $data[0];
            } 
            else 
            {//如果缓存不存在 或者hash不匹配重新解析
                $this->_availablePlugins = $this->resolvePlugins();
                $this->cache->set($cacheKey, [$this->_availablePlugins, $hash], 0, 'plugins');
            }
        } 
        else 
        {//无缓存情况直接解析
            $this->_availablePlugins = $this->resolvePlugins();
        }
 	}

 	/**
     * 解析插件
     *
     * @param void
     * @return array $availablePlugins
     */
 	public function resolvePlugins()
 	{
 		//插件的排序
 		$sorts = array();
 		$availablePlugins = array();

		foreach((array)$this->lists as $name => $conf) 
		{
			$name = trim($name);
			$includeIds = array();//使用使用的应用ID 为空的话代表都可以使用
			isset($conf['available']) && is_array($conf['available']) && $includeIds = array_unique($conf['available']); 
			$includeSize = count($includeIds); 
			if($includeSize > 1)
			{
				$delKeys = array_keys($includeIds, array('*', 'all'));
				foreach ((array)$delKeys as $key) 
				{
					unset($includeIds[$key]);
				}
			}
			else
			{
				$includeSize == 1 && in_array($includeIds[0], array('all', '*')) && $includeIds = array();
			}
			
			$exceptIds = array();//不可用的应用ID
			if(isset($conf['unavailable']) && is_array($conf['unavailable']))
			{
				$conf['unavailable'] = array_unique($conf['unavailable']);
				$delKeys = array_keys($includeIds, array('*', 'all'));
				foreach ((array)$delKeys as $key) 
				{
					unset($exceptIds[$key]);
				}
			}

			$available = false;
			if(empty($includeIds))
			{
				$available = empty($exceptIds) ? true : (in_array(Yii::$app->id, $exceptIds) ? false : true);
			}
			else
			{
				$available = empty($exceptIds) ? (in_array(Yii::$app->id, $includeIds) ? true : false) : (in_array(Yii::$app->id, array_merge($includeIds, $exceptIds)) ? true : false);
			}
			!isset($conf['sort']) && $conf['sort'] = 0;
			!is_integer($conf['sort']) && $conf['sort'] = intval($conf['sort']);
			$conf['available'] = empty($includeIds) ? '*' : $includeIds;
			$conf['unavailable'] = $exceptIds;

			$sorts[] = $conf['sort'];
			$available && $availablePlugins[$name] = $conf;
		}

 		//对可用的插件按照其sort 进行升序排序
        if(!empty($availablePlugins))
        {
      		array_multisort($sorts, SORT_ASC, SORT_NUMERIC, $availablePlugins);
        }
        return $availablePlugins;
 	}

 	/**
     * 获取插件namespace
     * @param string $name 插件名称
     * @return string $ns
     */
 	public function getPluginNs($name)
 	{
 		return $this->baseNamespace . '\\' . lcfirst($name);
 	}

 	/**
	* 获取当前上下文类型
	* @param void
	* @return string $contextType
	*/
	public function getContextType()
	{
		return 'Plugin';
	}

 	/**
     * 注册插件
     * @param int $code 错误代码
     * @param string $message 错误信息
     */
 	private function _getPluginEvent($code, $message)
 	{
 		$pluginEvent = $this->_pluginEvent === null ? (new PluginEvent) : $this->_pluginEvent;
		$pluginEvent->code = $code;
		$pluginEvent->message = $message;
		$pluginEvent->context = $this;
		return $pluginEvent;
 	}

 	/**
     * 注册插件
     *
     * @param void
     */
 	public function loadPlugins()
 	{
 		$noEmptyProperties = array('name');//必须存在且不能为空的属性
 		$noEmptyFunctions = array('events');//必须存在且返回结果不能为空的函数
 		foreach($this->_availablePlugins as $name => $conf) 
 		{
			$className = $this->getPluginClassName($name);//插件类名称
			if(!class_exists($className))
			{//类不存在 则跳过不加载
				continue;
			}
			$pass = true;
			$conf1 = array();
			$classProperties = get_class_vars($className);
			foreach($noEmptyProperties as $property)
			{
				Event::trigger($this::MOUNT_CLASS, $this::E_BEFORE_PLUGIN_LOAD);
				if(!array_key_exists($property, $classProperties) || !$classProperties[$property])
				{					
					Event::trigger($this::MOUNT_CLASS, $this::E_PLUGIN_LOAD_FAILED, $this->_getPluginEvent($className::ERROR_MISS_PROPERTY, 'Can not find property:' . $func . '!'));
					$pass = false;
					break;
				}
				$conf1[$property] = $classProperties[$property];
			}
			if($pass == false)
			{
				continue;
			}
			foreach($noEmptyFunctions as $func) 
			{
				if(!method_exists($className, $func))
				{
					Event::trigger($this::MOUNT_CLASS, $this::E_PLUGIN_LOAD_FAILED, $this->_getPluginEvent($className::ERROR_MISS_FUNCTION, 'Can not find function:' . $func . '!'));
					$pass = false;
					break;
				}
				$res = call_user_func(array($className, $func));
				if(!is_array($res) || empty($res))
				{
					Event::trigger($this::MOUNT_CLASS, $this::E_PLUGIN_LOAD_FAILED, $this->_getPluginEvent($className::ERROR_RETURN_VALUE, 'Function:' . $func . ' return a bad value!'));
					$pass = false;
					break;
				}
				$conf1[$func] = $res;
			}

           	if($pass == false)
           	{
                continue;
           	}

			foreach($conf1['events'] as $each) 
			{
				if(!isset($each['handler']) || !$each['handler'] || !isset($each['name']) || !$each['name'])
				{
					Event::trigger($this::MOUNT_CLASS, $this::E_PLUGIN_LOAD_FAILED, $this->_getPluginEvent($className::ERROR_CONFIG, 'Bad event config!'));
					$pass == false;
					break;
				}
			}

           	if($pass == false)
           	{
                continue;
           	}

           	//进行事件的注册
			foreach($conf1['events'] as $each) 
			{
				Event::on($this::MOUNT_CLASS, $each['name'], $each['handler'], isset($each['data']) ? $each['data'] : null, isset($each['append']) ? (boolean)$each['append'] : true);
			}


           	$this->_setPluginModule($name);

			$this->_loadedPlugins[$name] = array_merge($conf, $conf1);

			Event::trigger($this::MOUNT_CLASS, $this::E_AFTER_PLUGIN_LOAD);
 		}
 	}

 	/**
     * 获取插件信息
     *
     * @param string $name 插件名称
     * @return mixed 如果插件已经加载返回插件信息 否则返回false
     */
 	public function getPlugInfo($name)
 	{
 		return $this->isLoaded($name) ? $this->_loadedPlugins[$name] : false;
 	}

 	/**
     * 获取插件类名称
     *
     * @param string $name 插件名称
     * @return string $className
     */
 	public function getPluginClassName($name)
 	{
 		return $this->getPluginNs($name) . '\\Plugin';
 	}

 	/**
     * 插件是否已经加载
     *
     * @param string $name 插件名称
     * @return boolean
     */
 	public function isLoaded($name)
 	{
 		return array_key_exists($name, $this->_loadedPlugins);
 	}

 	/**
     * 设置插件模块
     *
     * @param string $name 插件名称
     * @return boolean
     */
 	private function _setPluginModule($name)
 	{
 		$id = 'plugin' . ucwords($name);
 		$conf = array(
 			'controllerNamespace' => $this->getPluginNs($name) . '\\controllers',//controller命名空间
 			'class' => $this->getPluginClassName($name),
 			'id' => $id,
 		);
 		Yii::$app->setModule($id, $conf);
 	}
 }