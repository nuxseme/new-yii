<?php
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidParamException;

/**
 * 新架构下缓存清理管理类
 *
 * @author caoxl
 */
 class ComCacheCleaner extends Component
 {
 	/**
	* @var array $cacheVersions 缓存版本 key => ver
 	*/
 	public $cacheVersions = [];

 	/**
 	* 判断缓存版本是否存在
 	*
 	* @param string $key
 	*
 	* @return boolean
 	*/
 	public function versionExist($key)
 	{
 		return array_key_exists($key, $this->cacheVersions);
 	}

 	/**
 	* 获取缓存版本
 	*
 	* @param string $key
 	*
 	* @return mixed string|null
 	*/
 	public function getVersion($key)
 	{
 		return $this->versionExist($key) ? $this->cacheVersions[$key] : null;
 	}
 }