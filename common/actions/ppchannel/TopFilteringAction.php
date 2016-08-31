<?php
/*
* 频道页面顶部 过滤栏 
*/
namespace common\actions\ppchannel;
use Yii;
use common\components\AppAction;

class TopFilteringAction extends AppAction
{
	public function run($params)
	{
		return $this->renderPartial(
					'ppchannel/topFiltering',
					[
						'allCates' => $params['allCates'],
						'route' => $params['route']
					]
				);
	}
}