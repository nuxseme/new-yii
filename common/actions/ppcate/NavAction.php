<?php
/*
* 分类导航相关action
*
*/
namespace common\actions\ppcate;

use Yii;
use common\components\AppAction;

class NavAction extends AppAction
{
	/**
	* 运行action
	*
	* @param array $params
	*
	* @return string
	*/
	public function run($params = [])
	{
		 return $this->renderPartial('ppcate/nav');
	}
}