<?php
/**
 * 配送运费相关model
 * @author caoxl
 */
namespace common\models;

use Yii;
use common\components\AppModel;
use common\components\AppCurl;
use yii\helpers\Json;

class Shipping extends AppModel
{
	/**
    * @var int $_cacheTime 缓存时间
    */
    private $_cacheTime = 604800;

    /**
     * 获取配送信息
     * @param array $data
     *        'country' => string|国家
     *        'currency' => string|货币
     *        'language' => string|语言
     *        'storageId' => int|仓库ID
     *        'totalPrice' => float|总价
     *        'shippingCalculateLessParamBase'  => array('listingId' => string|商品ID, 'qty' => int|数量)
     *
     * @return array
     */
    public function getShippingData($data)
    {
        $appCurl = new AppCurl;
        $appCurl->setHeader('token', Yii::$app->params['shippingToken']);
        $re = $appCurl->post(array('api' => 'getShipping'), $data);
        $re = $appCurl->convertResError($re);
        return Json::decode($re);
    }
}