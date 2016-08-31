<?php
/*
* 详情页shipping相关action
*
*/
namespace common\actions\shipping;

use Yii;
use common\components\AppAction;
use common\models\Shipping;

class DisplayShippingAction extends AppAction
{
	/**
	* 运行action
	*
	* @param array $params
	*
	*
	* @return string
	*/
	public function run($params = [])
	{
		return 	$this->renderPartial(
								'shipping/display'
							);
	}
}
