<?php
/**
 * 频道页model
 * @author caoxl
 */
namespace common\models;

use Yii;
use common\components\AppModel;
use common\components\AppCurl;
use yii\helpers\Json;

class Channel extends AppModel
{
    /**
    * @var array 频道页对应的依赖名称
    */
    static public $channelDependNames = [
        'topsellers/home' => 'channelTopsellersHome',
        'topsellers' => 'channelTopsellers',
        'new' => 'channelNew',
        'freeshipping' => 'channelFreeshipping',
        'deals' => 'channelDeals',
        'presale' => 'channelPresale',
        'clearance' => 'channelClearance',
    ];
    /**
     * 获取频道页新品列表
     * @param array $params 查询参数
     *  $params['cpath'] $params['sort']  $params['page'] $params['size'] 
     *
     * @param string $channelName 频道名称
     * new freeshipping clearance  topsellers/home topsellers deals presale
     *
     * @return array
     */
    public function getChannelProducts($params, $channelName)
    {
        $cacheTime = 15 * 60;
        $cacheKey = __CLASS__ . __METHOD__ . '_' . md5($channelName . json_encode($params));
        $products = Yii::$app->cache->get($cacheKey);
        if($products === false)
        {
            $appCurl = new AppCurl;
            $re = $appCurl->get(
                                    array('api' => 'getChannelProducts', 'params' => ['channel' => $channelName]),
                                    $params
                                );
            $re = $appCurl->convertResError($re);
            $products = Json::decode($re);
            if($products['ret'] == 1)
            {
                $dependName = $channelName;
                array_key_exists($channelName, self::$channelDependNames) && $dependName = self::$channelDependNames[$channelName];
                Yii::$app->cache->set($cacheKey, $products, $cacheTime, $dependName);
            }
        }
        return $products;
    }


    /**
     *  获取频道页所有分类
     *  @param string $channelName
     *
     * @return array
     */
    public function getChannelAllCates($channelName)
    {
        $cacheTime = 3600;
        $cacheKey = __CLASS__ . __METHOD__ . '_allcates';
        $re = Yii::$app->cache->get($cacheKey);
        if($re === false)
        {
            $products = $this->getChannelProducts([], $channelName);
            if($products['ret'] != 1)
            {//如果发生错误 直接返回错误结果
                return $products;
            }
            $re = ['ret' => 1, 'data' => []];
            $re['data'] = $products['data']['aggsMap']['mutil.productTypes.productTypeId'];
            Yii::$app->cache->set($cacheKey, $re, $cacheTime, 'channelAllCates');
        }
        return $re;
    }

    /**
     *  Deals分类
     *  @param array $params 查询参数
     *  $params['type']
     *
     * @return array
     */
    public function dealsCategory($params)
    { 
        $appCurl = new AppCurl;
        $re = $appCurl->get(
                                array('api' => 'getDealsCategory'),
                                $params
                            );
        $re = $appCurl->convertResError($re);
        return Json::decode($re);
    }

    /**
     *  新品频道页聚合时间属性
     *  @param array $params 查询参数
     *
     * @return array
     */
    public function newArrivalsReleaseDate($params = [])
    { 
        $appCurl = new AppCurl;
        $re = $appCurl->get(
                                array('api' => 'newArrivalsReleaseDate'),
                                $params
                            );
        $re = $appCurl->convertResError($re);
        return Json::decode($re);
    }

    /**
     *  品牌站获取hotdeals
     *  @param array $params 查询参数
     *  [pageSize] [pageNum]
     *
     * @return array
     */
    public function getPpHotDeals($params)
    {
        $jsonStr = '{"data":[{"amazonUrl":"3","country":"United States","coupon":"312","currency":"USD","currencySymbol":"US$","detailUrl":"2","endDate":"2016-08-16 07:20:20.0","imageUrl":"4","newPrice":"2","oldPrice":"12","sku":"C442","title":"Battery for TOSHIBA notebook - PA3465U 10.8V 4400mAh"}],"ret":1}';
        return Json::decode($jsonStr);
        $cacheTime = 5 * 60;
        $cacheKey = __CLASS__ . __METHOD__ . '_pphotdeals';
        $re = Yii::$app->cache->get($cacheKey);
        if($re === false)
        {
            $appCurl = new AppCurl;
            $re = $appCurl->get(
                                    array('api' => 'getPpHotDeals'),
                                    $params
                                );
            $re = $appCurl->convertResError($re);
            $re = Json::decode($re);
            if($re['ret'] == 1)
            {
                Yii::$app->cache->set($cacheKey, $re, $cacheTime, 'channelPpHotDeals');
            }
        }
        return $re; 
    }

}