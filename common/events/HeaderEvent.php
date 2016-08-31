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
class HeaderEvent extends AppEvent{
	/**
	* @var int $headername
	*/
	public $headername;
}