<?php
/*
* 频道页deals相关action
*
*/
namespace common\actions\channel;

use Yii;
use common\components\AppAction;
use common\models\Channel;

class RightFilteringAction extends AppAction
{
	/**
	* 运行action
	*
	* @param array $params
	* $params['channelModel']
	*
	* @return string
	*/
	public function run($params)
	{
		return $this->renderPartial(
					'channel/rightFiltering',
					[
						'displayNumber' => $params['displayNumber'],
						'pages' => $params['pages'],
						'breadcrumbName' => $params['breadcrumbName'],
						'breadcrumbUrl' => $params['breadcrumbUrl'],
					]
				);
	}
}