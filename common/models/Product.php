<?php
/**
 * @desc 用户注册登录管理
 * @author wang
 */
namespace common\models;

use Yii;
use yii\helpers\Json;
use common\components\AppModel;
use common\components\AppCurl;

class Product extends AppModel
{
	/**
     * 根据现实列表类型获取产品列表
     *
     * @return mixed array|false
     */
    public function getProductsByType()
    {
        $cacheKey = __CLASS__ . __METHOD__ . 'getProductsByType';
        $re = Yii::$app->cache->get($cacheKey);
        $cacheTime = 3600;
        if($re === false)
        {
            $appCurl = new AppCurl;
        	$re = $appCurl->get(
        							['api' => 'getProductsByType']/*, 
        							['layoutcode' => null, 'modulecode' => null]*/
        						);
            $re = $appCurl->convertResError($re);
        	$re = Json::decode($re);
            if ($re['ret'] == 1)
            {
                Yii::$app->cache->set($cacheKey, $re, $cacheTime, 'productsType');
            }
        }
    	return $re;
    }

    /**
     * 获取面包屑
     * 
     * @param int $id
     * @param string $type 类型
     * @return array $data['data']
     */
    public function getBreadCrumbs($id, $type = 'category')
    {
        $appCurl = new AppCurl;
        $re = $appCurl->get(
                                ['api' => 'getBreadCrumbs', 'params' => ['id' => $id]], 
                                ['type' => $type]
                            );
        $re = $appCurl->convertResError($re);
        $re = Json::decode($re);
        return $re;
    }

    /**
     * 获取产品基本信息
     * 
     * @param string $listingId
     *
     * @return array $data['data']
     */
    public function getProductDetails($listingId)
    {
        $cacheKey = __CLASS__ . __METHOD__ . '_productDetails_' . $listingId;
        $cacheTime = 120;
       // $re = Yii::$app->cache->get($cacheKey);
        $re = false;
        if($re === false)
        {
            $appCurl = new AppCurl;
            $re = $appCurl->get(
                                    ['api' => 'getProductDetails'], 
                                    ['key' => $listingId]
                                );
            $re = $appCurl->convertResError($re);
            $re = Json::decode($re);
            if ($re['ret'] == 1)
            {
                Yii::$app->cache->set($cacheKey, $re, $cacheTime, 'productDetails');
            }
        }
        return $re;
    }


    /**
     * 详情页获取Shipping & Payment 和Warranty信息
     * 
     * @param string $type  类型 
     *               1:)Shipping&Payment = 'paymentexplain' 
     *               2:) Warranty = 'warrantyexplain'
     *
     * @return array $data['data']
     */
    public function getshippingPaymentOrWarranty($type)
    {
        $cacheKey = __CLASS__ . __METHOD__ . '_shippingPaymentOrWarranty_' . $type;
        $cacheTime = 3600;
        $re = Yii::$app->cache->get($cacheKey);
        if($re === false)
        {
            $appCurl = new AppCurl;
            $re = $appCurl->get(['api' => 'getArticleDetails'], ['url' => $type]);
            $re = $appCurl->convertResError($re);
            $re = Json::decode($re);
            if ($re['ret'] == 1)
            {
                Yii::$app->cache->set($cacheKey, $re, $cacheTime, 'shippingPaymentOrWarranty');
            }
        }
        return $re;
    }

    /**
     * 详情页获取Hot Event
     * 
     * @param string $type  类型 
     *               1:)Shipping&Payment = 'paymentexplain' 
     *               2:) Warranty = 'warrantyexplain'
     *
     * @return array $data['data']
     */
    public function getHotEvent()
    {
        $cacheKey = __CLASS__ . __METHOD__ . '_hotEvent';
        $cacheTime = 3600;
        $re = Yii::$app->cache->get($cacheKey);
        if($re === false)
        {
            $appCurl = new AppCurl;
            $re = $appCurl->get(
                                    ['api' => 'getProductTopic']
                                );
            $re = $appCurl->convertResError($re);
            $re = Json::decode($re);
            if ($re['ret'] == 1)
            {
                Yii::$app->cache->set($cacheKey, $re, $cacheTime, 'detailHotEvent');
            }
        }
        return $re;
    }

    /**
     * 详情页获取Top Sellers
     * 
     * @param string $listingId
     *
     * @return array $data['data']
     */
    public function getDetailTopSellers()
    {
        $cacheKey = __CLASS__ . __METHOD__ . '_topSellers';
        $cacheTime = 3600;
        $re = Yii::$app->cache->get($cacheKey);
        if($re === false)
        {
            $appCurl = new AppCurl;
            $re = $appCurl->get(
                                    ['api' => 'getProductHot']
                                );
            $re = $appCurl->convertResError($re);
            $re = Json::decode($re);
            if ($re['ret'] == 1)
            {
                Yii::$app->cache->set($cacheKey, $re, $cacheTime, 'detailTopSellers');
            }
        }
        
        return $re;
    }


    /**
     * 不同的图片显示不同的图片尺寸
     * 
     *
     * @return array $data['data']
     */
    public function getImagesDisplayType()
    {
        $appCurl = new AppCurl;
        $re = $appCurl->get(
                                ['api' => 'getShape']
                            );
        $re = $appCurl->convertResError($re);
        $re = Json::decode($re);
        return $re;
    }

    /**
     * 详情页获取评论列表
     * 
     * @param string $listingId
     * @return array $data['data']
     */
    public function getReview($listingId)
    { 
        $cacheKey = __CLASS__ . __METHOD__ . '_reviews_' . $listingId;
        $cacheTime = 1800;
        $re = Yii::$app->cache->get($cacheKey);
        if($re === false)
        {
            $appCurl = new AppCurl;
            $re = $appCurl->get(
                                    ['api' => 'getReview', 'params' => ['listingId' => $listingId]]
                                );
            $re = $appCurl->convertResError($re);
            $re = Json::decode($re);
            if ($re['ret'] == 1)
            {
                Yii::$app->cache->set($cacheKey, $re, $cacheTime, 'reviews');
            }
        }
        
        return $re;
    }

    /**
     * 获取Daily Deals数据
     * 
     * @return array $data['data']
     */
    public function getDailyDeals()
    {
        date_default_timezone_set('UTC');
        $date = date("Y/m/d");

        $cacheKey = __CLASS__ . __METHOD__ . '_dailyDeals_' . $date;
        $cacheTime = 1800;
        $re = Yii::$app->cache->get($cacheKey);
        if($re === false)
        {
            $appCurl = new AppCurl;
            $re = $appCurl->get(
                                    ['api' => 'getDailyDeals'],
                                    ['date' => $date]
                                );
            $re = $appCurl->convertResError($re);
            $re = Json::decode($re);
            if ($re['ret'] == 1)
            {
                Yii::$app->cache->set($cacheKey, $re, $cacheTime, 'dailyDeals');
            }
        }
        return $re;
    }


    /**
     * 获取商品价格
     * 
     * @param string $listingId 商品ID
     * @return array $data['data']
     */
    public function getProductPrice($listingId)
    {
        $appCurl = new AppCurl;
        $re = $appCurl->get(
                                ['api' => 'getProductPrice', 'params' => ['listingId' => $listingId]]
                            );
        $re = $appCurl->convertResError($re);
        $re = Json::decode($re);
        return $re;
    }

    /**
     * 获取商品收藏数
     * 
     * @param string $listingId 商品ID
     * @return array $data['data']
     */
    public function getFavoritesNumber($listingId)
    {
        $appCurl = new AppCurl;
        $re = $appCurl->get(
                                ['api' => 'getFavoritesNumber', 'params' => ['listingId' => $listingId]]
                            );
        $re = $appCurl->convertResError($re);
        $re = Json::decode($re);
        return $re;
    }

    /**
     * 获取用户收藏产品listingID集合
     * 
     * @param string $email
     * @return array $data['data']
     */
    public function getProductCollectList($email)
    { 
        $appCurl = new AppCurl;
        $re = $appCurl->get(
                                ['api' => 'getCollectIdLists'],
                                ['email' => $email]
                            );
        $re = $appCurl->convertResError($re);
        $re = Json::decode($re);
        return $re;
    }

    /**
     * 详情页通常购买的商品推荐
     * 
     * @param string $listingId 产品ID
     * @return array $data['data']
     */
    public function getAlsoBought($listingId)
    {
        $cacheKey = __CLASS__ . __METHOD__ . '_alsoBought_' . $listingId;
        $cacheTime = 1800;
        $re = Yii::$app->cache->get($cacheKey);
        if($re === false)
        {
            $appCurl = new AppCurl;
            $re = $appCurl->get(
                                    ['api' => 'getAlsoBought'],
                                    ['listingId' => $listingId]
                                );
            $re = $appCurl->convertResError($re);
            $re = Json::decode($re);
            if ($re['ret'] == 1)
            {
                Yii::$app->cache->set($cacheKey, $re, $cacheTime, 'dailyDeals');
            }
        }
        return $re;
    } 

    /**
     * 添加Wholesale Inquiry
     * 
     * @param array $param
     * @return array $data['data']
     */
    public function addWholesaleInquiry($param)
    {
        $data = [
                    'listingId' => $param['listingId'],
                    'sku' => $param['sku'],
                    'name' => $param['name'],
                    'mobilePhone' => $param['mobilePhone'],
                    'emailAddress' => $param['emailAddress'],
                    'targetPrice' => $param['targetPrice'],
                    'orderQuantity' => intval($param['orderQuantity']),
                    'countryState' => $param['countryState'],
                    'companyName' => $param['companyName'],
                    'writeInquiry' => $param['writeInquiry'],
        ];

        $appCurl = new AppCurl;
        $re = $appCurl->put(
                                ['api' => 'addWholesaleInquiry'],
                                $data
                            );
        $re = $appCurl->convertResError($re);
        $re = Json::decode($re);
        return $re;
    }

    /**
     * 添加产品收藏
     * 
     * @param array $param
     *        'listingId' string
     *        'email' string      
     *
     * @return array $data['data']
     */
    public function addProductCollect($param)
    { 
        if(!isset($param['email']) || !isset($param['listingId']) || !$param['email'] || !$param['listingId'])
        {
            return ['ret' => -1, 'data' => '', 'msg' => 'Miss params!'];
        }

        $appCurl = new AppCurl;
        $data = [
            'listingId' => $param['listingId'],
            'email' => $param['email']
        ];
        $params =  $appCurl->asignDefaultParams($data);

        $re = $appCurl->put(['api' => 'addProCollect'], $params);
        $re = $appCurl->convertResError($re);
        $re = Json::decode($re);
        return $re;
    }

    /**
     * 添加产品收藏
     * 
     * @param array $param
     * @return array $data['data']
     */
    public function addProductDropship($param)
    { 
        $userInfo = Yii::$container->get('TTHelper')->getUserEmail($param['TT_UUID']);
        if(!$userInfo)
        {
            return ['ret' => -1, 'data' => ''];
        }

        $appCurl = new AppCurl;
        $data = ['sku' => $param['sku'], 'email' => $userInfo['email']];
        $re = $appCurl->put(
                                ['api' => 'addProductDropship'],
                                $data
                            );
        $re = $appCurl->convertResError($re);
        $re = Json::decode($re);
        return $re;
    }


    /**
     * 添加商品WholeSaleProduct
     * 
     * @param array $param
     * @return array $data['data']
     */
    public function addWholeSaleProduct($param)
    { 
        $userInfo = Yii::$container->get('TTHelper')->getUserEmail($param['TT_UUID']);
        if(!$userInfo)
        {
            return ['ret' => -1, 'data' => ''];
        }

        $appCurl = new AppCurl;
        $data = [
                    'sku' => $param['sku'], 
                    'email' => $userInfo['email'],
                    'qty' => 5
                ];
        $re = $appCurl->put(
                                ['api' => 'addWholeSaleProduct'],
                                $data
                            );
        $re = $appCurl->convertResError($re);
        $re = Json::decode($re);
        return $re;
    }

    /**
     * 获取商品浏览记录
     * 
     * @param array   $listingIds     产品IDS
     * @return array $data['data']
     */
    public function getViewHistory($listingIds)
    {
        $appCurl = new AppCurl;
        $data = ['listingIds' => $listingIds];
        $re = $appCurl->get(
                                ['api' => 'getViewHistory'],
                                $data
                            );
        $re = $appCurl->convertResError($re);
        $re = Json::decode($re);
        return $re;
    }

    /**
     * 详情页通常浏览的商品推荐
     * 
     * @param   $listingId     产品ID
     * @return array $data['data']
     */
    public function getAlsoViewed($listingId)
    {
        $cacheKey = __CLASS__ . __METHOD__ . '_alsoViewed_' . $listingId;
        $cacheTime = 1800;
        $re = Yii::$app->cache->get($cacheKey);
        if($re === false)
        {
            $appCurl = new AppCurl;
            $data = ['listingId' => $listingId];
            $re = $appCurl->get(
                                    ['api' => 'getAlsoViewed'],
                                    $data
                                );
            $re = $appCurl->convertResError($re);
            $re = Json::decode($re);
            if ($re['ret'] == 1)
            {
                Yii::$app->cache->set($cacheKey, $re, $cacheTime, 'alsoViewed');
            }
        }
        return $re;
    }

    /**
     * 根据keyword获取商品
     *
     * @param array $pageParam 请求参数
     * @return array
     */
    public function getProductsByKeyword($pageParam)
    {
        $appCurl = new AppCurl;
        $data = [];
        $data['cpath']     = $pageParam['cpath'];
        $data['page']      = $pageParam['page'];
        $data['size']      = $pageParam['size'];
        $data['sort']      = $pageParam['sort'];
        $data['tagName']   = $pageParam['tagName'];
        $data['depotName'] = $pageParam['depotName'];
        $data['brand']     = $pageParam['brand'];
        $data['yjPrice']   = $pageParam['yjPrice'];
        $data['type']      = $pageParam['type'];

        $re =  $appCurl->get(
                                ['api' => 'getProductsByKeyword', 'params' => ['keyword' => rawurlencode($pageParam['keyword'])]],
                                $data
                            );
        $re = $appCurl->convertResError($re);
        $re = Json::decode($re);
        return $re;
    }

    /**
     * 通过java获取HashCode
     *
     * @param string $listingId
     * @return array
     */
    public function getHashCodeByListingId($listingId)
    { 
        $appCurl = new AppCurl;

        $re = $appCurl->get(['api' => 'getHashCode','params'=>['listingId'=>$listingId]]);
        $re = $appCurl->convertResError($re);
        $re = Json::decode($re);
        return $re;
    }

    /**
     * 获取你可能喜欢的商品
     *
     * @param string $listingId 产品ID
     * @return array
     */
    public function getYouMayLike($listingId)
    { 
        $appCurl = new AppCurl;
        $data = ['listingId' => $listingId];
        $re = $appCurl->get(
                                ['api' => 'getYouMayLike'],
                                $data
                            );
        $re = $appCurl->convertResError($re);
        $re = Json::decode($re);
        return $re;
    }


    /**
     * 详情页获取评论列表
     *
     * @param string $listingId 产品ID
     * @return array
     */
    public function getProductReviews($listingId)
    { 
        $appCurl = new AppCurl;
        $data = ['listingId' => $listingId];
        $re = $appCurl->get(
                                ['api' => 'getProductReviews', 'params' => ['listingId' => $listingId]]
                            );
        $re = $appCurl->convertResError($re);
        $re = Json::decode($re);
        return $re;
    }


    /**
     * 获取推荐商品数据
     *
     * @param array $params  键如下
     *              string depotName
     *              int     page   
     *              int     size
     *    
     * @return array
     */
    public function getRecProducts($params)
    {
        $appCurl = new AppCurl;
        $re = $appCurl->get(
                                ['api' => 'getRecProducts'],
                                $params
                            );
        $re = $appCurl->convertResError($re);
        $re = Json::decode($re);
        return $re;
    }

    /**
     * 获取促销deals商品
     *
     * @param array $params  键如下
     *              string  cpath
     *              int     sort
     *              int     page   
     *              int     size
     *    
     * @return array
     */
    public function getPromotionDeals($params)
    {
        $appCurl = new AppCurl;
        $re = $appCurl->get(
                                ['api' => 'getPromotionDeals'],
                                $params
                            );
        $re = $appCurl->convertResError($re);
        $re = Json::decode($re);
        return $re;
    }
    /**
     * [getProductDriverAndAmazonUrl 获取商品的驱动文档和亚马逊地址]
     * @param [array] $[param] [iwebsiteid,sku,language]
     * @return  [mixed]
     */
    public function getProductDriverAndAmazonUrl($params)
    {

        $cacheKey = __CLASS__ . __METHOD__ . md5('_products_' . Json::encode($params));
        $re = Yii::$app->cache->get($cacheKey);
        $cacheTime = 3600;
        if($re === false)
        {
            $appCurl = new AppCurl;
            $re = $appCurl->get(
                                    ['api' => 'getProductDriverAndAmazonUrl'], 
                                    $params
                                );
            $re = $appCurl->convertResError($re);
            $re = Json::decode($re);
            if ($re['ret'] == 1)
            {
                Yii::$app->cache->set($cacheKey, $re, $cacheTime, 'driverAndAmazon');
            }
        }
        return $re;
    }

    /**
     * [getReviewAndStart 根据listingId获取评论总数和星级]
     * @param  [type] $listingId [商品唯一标识]
     * @return [type]            [mixed]
     */
    public function getReviewAndStart($listingId)
    {
        $appCurl = new AppCurl;
        $re = $appCurl->get(['api' => 'getReviewAndStart','params' => $listingId]);
        $re = $appCurl->convertResError($re);
        $re = Json::decode($re);
        return $re;
    }

    /**
     * 获取有驱动的商品列表
     * @param  array $params
     * @return array
     */
    public function getDriverProducts($params)
    {
        $jsonStr = '{"ret":1,"data":[{"title":"Patenteado Dodocool magia inteligente limpeza pano Screen Cleaner para iMac iPhone iPad Macbook LCD Smartphone DSLR","url":"tablet-pc-cellphone/accessories-for-cell-phones/other-phone-accessories/p_66233","imageUrl":"p/tt/d/a/da01-23-b2cd.jpg","symbol":"US$","nowprice":"2.77","origprice":"3.65","listingId":"047c93cc-d914-1004-874c-d371c9ab96c0","sku":"DA01"}]}';
        return Json::decode($jsonStr);
        $cacheKey = __CLASS__ . __METHOD__ . md5('_driverproducts_' . Json::encode($params));
        $re = Yii::$app->cache->get($cacheKey);
        $cacheTime = 5 * 60;
        if($re === false)
        {
            $appCurl = new AppCurl;
            $re = $appCurl->get(
                                    ['api' => 'getDriverProducts'], 
                                    $params
                                );
            $re = $appCurl->convertResError($re);
            $re = Json::decode($re);
            if ($re['ret'] == 1)
            {
                Yii::$app->cache->set($cacheKey, $re, $cacheTime, 'driverProducts');
            }
        }
        return $re;
    }
}
        