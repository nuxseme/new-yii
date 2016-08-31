<?php
/*
* 详情页面 面包屑
*
*/
namespace common\actions\ppdetail;

use Yii;
use common\components\AppAction;

class BreadCrumbsAction extends AppAction
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
		$listingId = $params['listingId'];
		$breadCrumbs = Yii::$container->get('TTHelper')->breadCrumbs($listingId, 'detail');
		return $this->renderPartial(
									'ppdetail/breadCrumbs',
									['breadCrumbs' => $breadCrumbs]);
	}
}