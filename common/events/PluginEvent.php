<?php
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */

namespace common\events;

use Yii;
use common\components\AppEvent;

/**
 * 插件加载事件对象
 *
 * @author caoxl
 */
class PluginEvent extends AppEvent{
	/**
	* @var int $code 错误代码
	*/
	public $code;

	/**
	* @var int $message 错误信息
	*/
	public $message;
}