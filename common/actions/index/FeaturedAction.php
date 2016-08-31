<?php
/*
* 首页Featured模块相关Action
*
*/
namespace common\actions\index;

use Yii;
use common\components\AppAction;

class FeaturedAction extends AppAction
{
	/**
	* 运行action
	*
	* @param array $params
	* 			   ['cpath'] string 
	* 			   ['depotName'] string
	* 			   ['page'] int
 	*			   ['size'] int
	*
	* @return string
	*/
	public function run($params)
	{
		$productModel = Yii::$container->get('ProductModel');
		$reqData = [];
		$reqData['cpath'] = $params['cpath'];
		$reqData['depotName'] = $params['depotName'];
		$reqData['page'] = isset($params['page']) ? $params['page'] : 1;
		$reqData['size'] = isset($params['size']) ? $params['size'] : 10;
		$data = $productModel->getRecProducts($reqData);
		$products = $data['ret'] == 1 ? $data['data'] : [];
		return $this->renderPartial('featureProducts', ['featuredProducts' => $products]);
	}
}