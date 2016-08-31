<?php
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
namespace common\components;

use Yii;
use yii\base\Component;

/**
 * 新架构下依赖注入容器管理类
 *
 * @author caoxl
 */
 class ComDiBox extends Component{
 	/**
	* @var array $box = ['name' => ['def' => [], 'params' => []]]
 	*/
 	public $box = array();//容器

 	public function init()
 	{
 		foreach((array)$this->box as $name => $conf) 
 		{
 			Yii::$container->set($name, isset($conf['def']) ? $conf['def'] : [], isset($conf['params']) ? $conf['params'] : []);
 		}
 	}

 	/**
 	* @param string $class 类的名称或者别名 例如'foo'
 	* @param array $params 将要传递给constructor的参数
 	* @param array $config 类的相关配置
 	*
 	* @return object 类的实例
 	* @throws InvalidConfigException
 	* @see yii\di\Container::get
 	*/
 	public function get($class, $params = [], $config = [])
 	{
 		return Yii::$container->get($class, $params, $config);
 	}

 	/**
 	* @param string $class 类名 接口名 别名
 	* @param mixed $definition 类的相关定义
 	* @param array $params 将要传递给constructor的参数
 	*
 	* @return object DI容器自身 可以支持链式调用
 	* @see yii\di\Container::set
 	*/
 	public function set($class, $definition = [], array $params = [])
 	{
 		return Yii::$container->set($class, $definition, $params);
 	}
 }