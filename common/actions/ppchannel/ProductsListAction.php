<?php
/*
* 频道 商品列表
*/
namespace common\actions\ppchannel;
use Yii;
use common\components\AppAction;

class ProductsListAction extends AppAction
{
	
	public function run($params)
	{
		return $this->renderPartial(
					'ppchannel/productsContainer',
					[
						'products' => $params['products']
					]
				);
	}
}