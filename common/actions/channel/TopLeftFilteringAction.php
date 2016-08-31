<?php
/*
* 频道页topsellers相关action
*
*/
namespace common\actions\channel;

use Yii;
use common\components\AppAction;
use common\models\Channel;

class TopLeftFilteringAction extends AppAction
{
	/**
	* 运行action
	*
	* @param array $params
	* $params['categoryToProduct'] $params['whatHot']
	*
	* @return string
	*/
	public function run($params)
	{
		return $this->renderPartial(
					'channel/topLeftFiltering',
					[
						'categoryToProduct' => $params['categoryToProduct'],
						'whatHot' => $params['whatHot']
					]
				);
	}
}