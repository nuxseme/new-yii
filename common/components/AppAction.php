<?php
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
namespace common\components;

use Yii;
use yii\base\Action;
use yii\base\ViewContextInterface;

/**
 * 新架构情况下 动作基础类.
 * @author caoxl
 */
class AppAction extends Action implements Mountpoint, ActionViewInterface, ViewContextInterface{
	/**
     * 构造函数.
     * @param string $id action的ID
     * @param Controller $controller 控制器
     * @param array $config 传入的配置 name-value 形式
     * @return void
     */
    public function __construct($id, $controller, $config = [])
    {
        parent::__construct($id, $controller, $config);
    }

    /**
    * 获取当前上下文类型
    * @param void
    * @return string $contextType
    */
    public function getContextType()
    {
        return 'AppAction';
    }

    /**
    * 渲染视图片段 (此处都是渲染的片段 不带layout)
    * 
    * @param void
    * @return string 渲染片段结果
    */
    public function renderPartial($view, $params = [])
    {
        return $this->controller->getView()->render($view, $params, $this);
    }

    /**
     * 设置动作的视图目录
     *
     * @return string 目录
     */
    public function getViewPath()
    {
        return SYS_COMMON_PATH . 'fragments';
    }

    /**
    * 获取当前视图的controller
    * @param void
    * @return Controller
    */
    public function getController()
    {
        return $this->controller;
    }
}
