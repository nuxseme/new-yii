<?php
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
namespace common\components;
use yii\base\Module;

/**
 * 新架构情况下 模块基础类.
 * @author caoxl
 */
class AppModule extends Module implements Mountpoint{
    /**
    * 初始化
    * @param void
    */
    public function init(){
        parent::init();
    }

    /**
	* 获取当前上下文类型
	* @param void
	* @return string $contextType
	*/
	public function getContextType()
	{
		return 'AppModule';
	}
}
