<?php
/*
* 频道页deals相关action
*
*/
namespace common\actions\channel;

use Yii;
use common\components\AppAction;
use common\models\Channel;

class LeftFilteringAction extends AppAction
{
	/**
	* 运行action
	*
	* @param array $params
	* $params['releaseDate'] $params['aggsMap']
	*
	* @return string
	*/
	public function run($params)
	{
		return $this->renderPartial(
					'channel/leftFiltering',
					[
						'releaseDate' => $params['releaseDate'],
						'aggsMap' => $params['aggsMap']
					]
				);
	}
}