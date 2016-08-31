<?php
/*
* 详情页底部Tab选项卡相关action
*
*/
namespace common\actions\detail;

use Yii;
use common\components\AppAction;

class TabsAction extends AppAction
{
	/**
	* 运行action
	*
	* @param array $params
	* $params['desc'] 商品描述
	*
	* @return string
	*/
	public function run($params)
	{
		return $this->renderPartial(
									'detail/tabs',
									[
										'description' => $params['description'],
                                        'shippingPayment' => $this->shippingPaymentOrWarranty('shipping-payment'),
                                        /*'warranty' => $this->shippingPaymentOrWarranty('warrantyexplain')*/
                                    ]
								);
	}

	/**
     * 详情页获取Shipping & Payment 和Warranty信息
     * 
     * @param   $type  类型   
     *                      1:)Shipping&Payment = 'paymentexplain' 
     *                      2:) Warranty = 'warrantyexplain'
     *
     * @return array
     */
    public function shippingPaymentOrWarranty($type)
    { 
        $re = Yii::$container->get('ProductModel')->getshippingPaymentOrWarranty($type);

        return $re['ret'] == 1 ? $re['data'][0]['content'] : '';
    }
}
