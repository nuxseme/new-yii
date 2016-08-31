<?php
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
namespace common\components;

use Yii;
use yii\caching\Dependency;
use yii\base\InvalidConfigException;

/**
 * 缓存配置依赖
 *
 * @author caoxl
 */
class ConfigDependency extends Dependency
{
	/**
	* @var string $configKey 依赖的配置键名
	*/
	public $configKey;

	/**
     * 生成数据用于辨别依赖是否发生改变.
     * 
     * @param Cache $cache 使用该依赖的cache对象
     * @return mixed 依赖数据.
     * @throws InvalidConfigException 如果 configKey 未指定将会抛出异常
     */
    protected function generateDependencyData($cache)
    {
        if ($this->configKey === null) 
        {
            throw new InvalidConfigException('ConfigDependency::configKey must be set');
        }

        if (!Yii::$app->cacheCleaner->versionExist($this->configKey)) 
        {
            throw new InvalidConfigException('ConfigDependency::unknow configKey:`' . $this->configKey . '`' );
        }

        return Yii::$app->cacheCleaner->getVersion($this->configKey);
    }
}