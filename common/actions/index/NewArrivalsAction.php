<?php
/*
* 首页 new arrivals 模块相关Action
*
*/
namespace common\actions\index;

use Yii;
use common\components\AppAction;

class NewArrivalsAction extends AppAction
{
	/**
	* 运行action
	*
	* @param array $params
	* @return string
	*/
	public function run($params = array())
	{
		$productModel = Yii::$container->get('ProductModel');
		$arrivals = $productModel->getProductsByType();
		$arrivals = $arrivals['ret'] == 1 ? $arrivals['data']['NEW-ARRIVALS'] : [];
		return $this->renderPartial(
									'newArrivals', 
									['arrivals' => $arrivals]
								);
	}
}