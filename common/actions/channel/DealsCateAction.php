<?php
/*
* 频道页deals相关action
*
*/
namespace common\actions\channel;

use Yii;
use common\components\AppAction;
use common\models\Channel;

class DealsCateAction extends AppAction
{
	/**
	* @var Channel
	*/
	protected $channelModel;

	/**
	* 运行action
	*
	* @param array $params
	* $params['channelModel']
	*
	* @return string
	*/
	public function run($params = [])
	{
		if(!empty($params) && isset($params['channelModel']))
		{
			$channelModel = $params['channelModel'];
		}
		else
		{
			$channelModel = new \common\models\Channel;
		}
		$dealsCategory = $channelModel->dealsCategory(array('type' => 1));
		$dealsCategory = $dealsCategory['ret'] == 1 ? $dealsCategory['data'] : [];
		return $this->renderPartial(
			'channel/dealsCate',
			[
				'dealsCategory' => $dealsCategory
			]
		);
	}
}