<?php
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
namespace common\components;

use Yii;
use yii\base\Event;

/**
 * 新架构下的事件
 *
 * @author caoxl
 */
class AppEvent extends Event{
	public $context = null;
}