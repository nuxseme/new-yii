<?php
/*
* 详情页shipping相关action
*
*/
namespace common\actions\shipping;

use Yii;
use common\components\AppAction;
use common\models\Shipping;

class ListAction extends AppAction
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
		/*
		*				country
		*				currency
		*				language
		*				storageId
		*				totalPrice
		*				listingId
		*				qty
		*/
		$data = array(
                        'country' => Yii::$app->request->post("country"),
                        'currency' => 'USD',
                        'language' => Yii::$app->request->post("language"),
                        'storageId' => Yii::$app->request->post("storageId"),
                        'totalPrice' => Yii::$app->request->post("totalPrice"),
                        'shippingCalculateLessParamBase' => array(
                            array(
                                    'listingId' => Yii::$app->request->post("listingId"),
                                    'qty' => Yii::$app->request->post("qty")
                            )
                        )
                    );
		$shippingModel = new Shipping;
		$re = $shippingModel->getShippingData($data);
		if(!isset($re['ret']))
		{
			$re['ret'] = -1;
			isset($re['status']) && $re['status'] == 'Y' && $re['ret'] = 1;
		}
		return $this->controller->resAjax($re);
	}
}
