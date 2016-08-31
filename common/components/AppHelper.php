<?php
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
namespace common\components;

use Yii;
use common\components\Mountpoint;

/**
* 助手类基础类
* @author caoxl
*/
class AppHelper implements Mountpoint
{
	/**
	* 获取当前上下文类型
	* @param void
	* @return string $contextType
	*/
	public function getContextType()
	{
		return 'AppHelper';
	}
}