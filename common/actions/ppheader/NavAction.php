<?php
/*
* 头部导航相关action
*
*/
namespace common\actions\ppheader;

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
		 return $this->renderPartial('ppheader/nav');
	}
}