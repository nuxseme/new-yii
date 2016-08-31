<?php
/*
* 头部导航相关action
*
*/
namespace common\actions\body;

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
		$adverModel = Yii::$container->get('AdvertModel');
		$categoryBg = $adverModel->getCategoryBg();
		$categoryBg = $categoryBg['ret'] == 1 ? $categoryBg['data'] : [];
		return $this->renderPartial(
									'//layouts/nav', 
									[
										'categoryBg' => $categoryBg
									]
								);
	}
}