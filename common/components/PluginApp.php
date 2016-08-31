<?php
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
namespace common\components;

use Yii;
/**
 * 调用plugin中的action
 *
 * @author caoxl
 */
class PluginApp{
	public $route = '';
	public $params = array();

	public function __construct($route, $params = array())
	{
		$this->route = $route;
		$this->params = (array)$params;
	}

	public function runAction($event)
	{
		$this->params['event'] = $event;
		return Yii::$app->runAction($this->route, $this->params);
	}
}