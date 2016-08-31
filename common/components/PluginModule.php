<?php
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
namespace common\components;
use yii\base\Module;

/**
 * 新架构情况下 插件模块.
 * 注意 插件本质上还是一个模块
 *
 * @author caoxl
 */
class PluginModule extends AppModule{
	const ERROR_MISS_PROPERTY = 100;//缺少必要属性
	const ERROR_MISS_FUNCTION = 101;//缺少必要函数
	const ERROR_RETURN_VALUE = 102;//错误的返回值
	const ERROR_CONFIG = 103;//配置错误
	
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
		return 'PluginModule';
	}
}