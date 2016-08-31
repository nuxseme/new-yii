<?php
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
namespace common\components;

/**
 * 新架构下 action 视图接口
 *
 * @author caoxl
 */
interface ActionViewInterface
{
	/**
	* 获取当前视图的controller
	* @param void
	* @return Controller
	*/
	public function getController();
}