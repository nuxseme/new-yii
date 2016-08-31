<?php
/*
* 频道顶部 面包屑
*/
namespace common\actions\ppchannel;
use Yii;
use common\components\AppAction;

class BreadCrumbsAction extends AppAction
{
	
	public function run($params)
	{
		return $this->renderPartial(
					'ppchannel/breadCrumbs',
					[
						'channelName' => $params['channelName']
					]
				);
	}
}