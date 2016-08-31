<?php
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
namespace common\components;

use Yii;
use yii\caching\FileCache;
use yii\base\InvalidParamException;

/**
* 新架构下系统缓存基础类
* @author caoxl
*/
class AppFileCache extends FileCache
{
	/**
     * Stores a value identified by a key into cache.
     * If the cache already contains such a key, the existing value and
     * expiration time will be replaced with the new ones, respectively.
     *
     * @param mixed $key a key identifying the value to be cached. This can be a simple string or
     * a complex data structure consisting of factors representing the key.
     * @param mixed $value the value to be cached
     * @param integer $duration the number of seconds in which the cached value will expire. 0 means never expire.
     * @param Dependency $dependency dependency of the cached item. If the dependency changes,
     * the corresponding value in the cache will be invalidated when it is fetched via [[get()]].
     * This parameter is ignored if [[serializer]] is false.
     * @return boolean whether the value is successfully stored into cache
     */
    public function set($key, $value, $duration = 0, $dependency = null)
    {
        //取堆栈回溯中前2条信息 最后一条即为调用该功能的栈
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
        $trace = $trace[sizeof($trace) - 1];
    	if(isset($trace['class']) &&  (new \ReflectionClass($trace['class']))->implementsInterface('common\components\Mountpoint'))
    	{
    		if(!$dependency)
    		{
	    		throw new InvalidParamException('Error param `dependency`!');
    		}
    		if(is_string($dependency))
    		{//如果 $dependency 是字符串 则取配置中的信息
    			$dependency = Yii::createObject([
                                                    'class' => 'common\components\ConfigDependency',
                                                    'configKey' => $dependency,
                                                ]);
    		}
    	}
        return parent::set($key, $value, $duration, $dependency);
    }
}