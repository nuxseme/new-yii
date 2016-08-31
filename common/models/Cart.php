<?php
/**
 * 购物车类
 *
 * @author caoxl
 */
namespace common\models;

use Yii;
use common\components\AppModel;
use common\components\AppCurl;
use yii\helpers\Json;

class Cart  extends AppModel
{
    /**
     * 获取购物车基本信息
     *
     * @param array $listingIds
     * @return array 
     */
    public function getShoppingCartInfo($listingIds)
    {
        $appCurl = new AppCurl;
        $re = $appCurl->get(array('api' => 'getShoppingCart'), ['listings' => $listingIds]);
        $re = $appCurl->convertResError($re);
        $re = Json::decode($re);
        return $re;
    }


    /**
     * 获取购物车总共商品的数量
     *
     * @return array 
     */
    public function getShoppingCartTotalNumber()
    { 
        $shoppingCartHistory = Yii::$container->get('TTHelper')->getCookie(Yii::$app->params['cartCookiesName']);
        $cartProductNumber = 0;
        if(!empty($shoppingCartHistory))
        { 
            $shoppingCart = Json::decode($shoppingCartHistory);
            foreach($shoppingCart as $key => $value)
            { 
                $cartProductNumber += count($value);
            }
        }
        return ['ret' => 1, 'data' => $cartProductNumber];
    }
}