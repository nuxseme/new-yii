<?php
/**
 * 广告model类
 *
 * @author caoxl
 */
namespace common\models;

use Yii;
use common\components\AppModel;
use common\components\AppCurl;
use yii\helpers\Json;


class Advert  extends AppModel
{
	/**
    * @var int $_cacheTime 缓存时间
    */
    private $_cacheTime = 3600;

    /**
     * @param string $layoutCode   布局标识，例如：主页HOME 必须
     * @param string $bannerCode   广告位标识，主页:HOME 必须
     * @param int $categoryId 分类ID 非必须
	 *
     * @return mixed  array|boolean 如果成功返回数据 否则返回false
     */
    public function getAdvert($layoutCode, $bannerCode, $categoryId = 0)
    {
    	$cacheKey = __CLASS__ . $layoutCode . "_" . $bannerCode . "_" . $categoryId;
    	$advert = Yii::$app->cache->get($cacheKey);
    	if($advert === false)
        {
            $appCurl = new AppCurl;
            $re = $appCurl->get(
                                    array('api' => 'getAdvert'), 
                                    array(
                                            'layoutCode' => $layoutCode,
                                            'bannerCode' => $bannerCode,
                                            'categoryId' => $categoryId
                                        )
                                );
            $re = $appCurl->convertResError($re);
            $advert = Json::decode($re);
            if ($advert['ret'] == 1)
            {
                Yii::$app->cache->set($cacheKey, $advert, $this->_cacheTime, 'vdvert');
            }
        }
        return $advert;
    }

    /**
     * 获取分类的背景图片
     *
     * @param void
     *
     * @return array
     */
    public function getCategoryBg()
    {
        $cacheTime= 3600;
        $cacheKey = __CLASS__ . __METHOD__ . '_categoryBg';
        $bg = Yii::$app->cache->get($cacheKey);
        if($bg === false)
        {
            $appCurl = new AppCurl;
            $re = $appCurl->get(
                                    ['api' => 'getCategoryBg'], 
                                    [
                                        'categoryId' => 0,
                                        'layoutCode' => null,
                                        'bannerCode' => null,
                                    ]
                                );
            $re = $appCurl->convertResError($re);
            $bg = Json::decode($re);
            if ($bg['ret'] == 1)
            {
                Yii::$app->cache->set($cacheKey, $bg, $cacheTime, 'categoryBg');
            }
        }
        return $bg;
    }
}