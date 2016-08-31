<?php
/**
 * @link http://www.tomtop.com
 * @copyright Copyright (c) TOMTOP
 * @license http://www.tomtop.com/license/
 */
namespace common\components;

use Yii;
/**
 * TOMTOP 初始化配置
 * 
 * @author Caoxl
 */
class TTConf{
	/**
	*@var array $envs 环境类型
	*/
	public static $envs = array('prod', 'dev', 'test');

	/**
	*@var TTConf 当前单例对象
	*/
	private static $_instance;

	/**
     * 构造函数
     *
     * @param void
     * @return void
     */
	private function __construct()
	{

	}

	/**
     * 本类使用单例模式
     *
     * @param void
     * @return TTConf
     */
	public static function getInstance()
	{
		if(!self::$_instance instanceof self)
		{
			self::$_instance = new self;
		}
		return self::$_instance;
	}

	/**
     * 构建配置
     *
     * @param string $env 环境 prod test dev
	 * @param string $id 应用ID
     *
     * @return array $config
     * @throws Exception 基础配置文件丢失抛出异常
     */
	public function buildConf($env, $id)
	{
		$config = array('params' => array());//最终配置
		$env = $this->filterEnv($env);//环境
		$confFiles = [//基础配置文件
			'main' => [
				SYS_ENV_PATH . 'common' . DS . 'config' . DS . 'main.php',
				SYS_ENV_PATH . $id  . DS . 'config' . DS . 'main-local.php',
			],
			'params' => [
				SYS_ENV_PATH . 'common' . DS . 'config' . DS . 'params.php',
				SYS_ENV_PATH . $id  . DS . 'config' . DS . 'params-local.php',
			],
		];

		if($env != 'prod')
		{
			$envConfFiles = [];
			foreach ($confFiles as $type => $files) 
			{
				foreach ($files as $index => $file) 
				{
					$envConfFile = str_replace('.php', '-' . $env . '.php', $file);
					if(is_file($envConfFile))
					{
						$file = $envConfFile;
					}
					elseif(!is_file($file))
					{
						throw new \Exception('Necessary configuration file missing!');
					}
					$envConfFiles[$type][$index] = $file;
				}
			}
			$confFiles = $envConfFiles;
		}

		foreach($confFiles as $type => $files) 
		{
			foreach($files as $index => $file) 
			{
				$config = call_user_func(array($this, 'op' . ucwords($type) . 'Config'), $config, require($file));
			}
		}

		//设置别名
		if(isset($config['alias']))
		{
			foreach((array)$config['alias'] as $key => $ln) 
			{
				Yii::setAlias($key, $ln);
			}
			unset($config['alias']);
		}

		return $config;
	}

	/**
     * 过滤环境 环境不存在 切换为prod环境
     *
     * @param string $env 环境 prod test dev
     *
     * @return string $env
     */
	protected function filterEnv($env = 'prod')
	{
		(!$env || !in_array($env, self::$envs)) && $env = 'prod';
		return $env;
	}

	/**
     * 处理主配置
     *
     * @param array $config 总配置
     * @param array $originConfig 原始配置
     *
     * @return array $config
     */
	protected function opMainConfig(array $config, array $originConfig)
	{
		return $this->arrayMergeRecursiveSimple($config, $originConfig);
	}

	/**
     * 处理params配置
     *
     * @param array $config 总配置
     * @param array $originConfig 原始配置
     *
     * @return array $config
     */
	protected function opParamsConfig(array $config, array $originConfig)
	{
		$config['params'] = $this->arrayMergeRecursiveSimple($config['params'], $originConfig);
		return $config;
	}

	/**
     * 递归合并数组 如果键名重复后面的数组会覆盖前面的数组的值 否则 后面的将会添加到前面
     *
     * @param array $array1
     * @param array $array2
     * @param array $array3
     * ...
     *
     * @return array $array 合并之后的
     */
	function arrayMergeRecursiveSimple() 
	{
	    if(func_num_args() < 2) 
	    {
	        trigger_error(__FUNCTION__ .' needs two or more array arguments', E_USER_WARNING);
	        return;
	    }
	    $arrays = func_get_args();
	    $merged = array();
	    while($arrays) 
	    {
	        $array = array_shift($arrays);
	        if(!is_array($array)) 
	        {
	            trigger_error(__FUNCTION__ .' encountered a non array argument', E_USER_WARNING);
	            return;
	        }
	        if(!$array){continue;}
	        foreach($array as $key => $value)
	        {
	            if(is_string($key) || is_numeric($key))
	            {
	                if(is_array($value) && array_key_exists($key, $merged) && is_array($merged[$key]))
	                {
	                    $merged[$key] = call_user_func(array($this, 'arrayMergeRecursiveSimple'), $merged[$key], $value);
	                }
	                else
	                {
	                    $merged[$key] = $value;
	                }
	            }
	            else
	            {
	            	$merged[] = $value;
	            }
	        }
	    }
	    return $merged;
	}
}