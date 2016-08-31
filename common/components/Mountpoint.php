<?php
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
namespace common\components;

/**
 * 新架构下 应用所有事件挂载点.
 *
 * @author caoxl
 */
interface Mountpoint{
	/**
	*@var string 挂载的类的名称
	*/
	const MOUNT_CLASS = 'Mountpoint';//事件挂载类的名称

	/**
	*@var string 事件名称 所有事件均以'E_'开头
	*/
	const E_BEFORE_HEADER = 'appBeforeHeader';//事件名称

	const E_THIRD_LOGIN = 'appThirdLogin';//事件名称

	const E_BEFORE_PLUGIN_LOAD = 'appBeforePluginLoad';//插件加载之前

	const E_AFTER_PLUGIN_LOAD = 'appAfterPluginLoad';//插件加载之后

	const E_PLUGIN_LOAD_FAILED = 'appPluginLoadFailed';//插件加载失败

	const E_LOGIN_SUCCESS = 'appLoginSuccess';//登录成功

	const E_LOGIN_FAILED = 'appLoginFailed';//登录失败

	const E_REGISTER_SUCCESS = 'appRegisterSuccess';//注册成功

	const E_REGISTER_FAILED = 'appRegisterFailed';//注册失败


	/**
	* 获取当前上下文类型
	* @param void
	* @return string $contextType
	*/
	public function getContextType();
}