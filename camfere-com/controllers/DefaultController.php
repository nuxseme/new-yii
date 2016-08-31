<?php
namespace app\controllers;

use Yii;
use yii\helpers\Url;

/**
 * 默认控制器 首页入口
 */
class DefaultController extends BaseController
{
    /**
     * @var TTHelper $TTHelper 公用助手类
     */
    protected $TTHelper;

    /**
     * @var RroductModel $ProductModel 商品模型
     */
    protected $ProductModel;

    /**
     * 初始化操作
     *
     */
    public function init()
    {
        $this->TTHelper = Yii::$container->get('TTHelper');
        $this->ProductModel = Yii::$container->get('ProductModel');;
    }


    /**
     * 首页.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        //seo信息
        $this->seoMeta(
            [
                'title' => 'Action Camera,360 Panorama Camera, Flashes, Tripod and Photography Acc | Camfere.com',
                'description' => 'Shop for Action Camera,360 Degree Camera, Camcorders, Flashes, Tripod, and Camera Accessories at Bargain Price | Camfere.com',
                'keywords' => 'action camera,360 degree camera,360 panorama camera,VR camera,digital camcorder,flashes,speedlite,ringlight,tripod,monopod,digital photo frame,Binoculars,Telescopes,Mobile Photography Accessories'
            ]
        );
        return $this->render(
                                'index',
                                [
                                    'sliderBanners' => $this->runAppAction('\common\actions\index\SliderBannerAction'),
                                    'rightBanners' => $this->runAppAction('\common\actions\index\RightBannerAction'),
                                    'newArrivals' => $this->runAppAction('\common\actions\index\NewArrivalsAction'),
                                    'featured' => $this->runAppAction('\common\actions\index\FeaturedAction', [['cpath' => '', 'depotName' => 1]])
                                ]
                            );
    }

    /**
     * 获取首页最近浏览历史
     *
     * @return string json
     */
    public function actionAjaxrview()
    { 
        $re = $this->TTHelper->getViewHistory();
        $data = ['ret' => 1, 'data' => ''];
        $data['data'] = $this->renderPartial(
                                                '_RecentlyViewed',
                                                [
                                                    'viewHistory' => $re
                                                ]
                                            );
        return $this->resAjax($data);
    }

    /**
     * 根据客户端IP默认选中国家
     *
     * @return string json
     */
    public function actionAjaxshipto()
    { 
        //根据IP选中默认国家
        $shipTo = $this->TTHelper->getCookie('TT_SHIPTO');
        $re = ['ret' => 1, 'data' => ''];

        if(empty($shipTo))
        { 
            require("GeoIP/geoipregionvars.php");
            require("GeoIP/geoip-geoipcity.inc.php");
            $gi = geoip_open("GeoIP/GeoLiteCity.dat", GEOIP_STANDARD);
            $record = geoip_record_by_addr($gi, Yii::$app->request->userIP);
            if($record)
            {
                $code = ($record->country_code == '') ? 'US' : $record->country_code;
                $countryName = ($record->country_name == '') ? 'United States' : $record->country_name;
                $re['data'] = ['code' => $code, 'countryName' => $countryName];
            }
            geoip_close($gi);
        }
        else
        { 
            $slip = explode('|', $shipTo);
            $re['data'] = ['code' => $slip[1], 'countryName' => $slip[0]];
        }

        return $this->resAjax($re);
    }

    /**
     * 获取首页Daily Deals
     *
     * @return string json
     */
    public function actionAjaxdeals()
    { 
        $dailyDeals = $this->ProductModel->getDailyDeals();
        $promotionDeals = $this->ProductModel->getPromotionDeals(['page' => 1, 'size' => 6]);

        $data = ['ret' => 1, 'data' => ''];
        if($dailyDeals['ret'] == -1 || $promotionDeals['ret'] == -1)
        {
            $data['ret'] = -1;
            return $this->resAjax($data);
        }

        $serverTime = (new \common\models\System)->getSystemTime();
        $serverTime = $serverTime['ret'] == 1 ? $serverTime['data'] : date('y/m/d');

        !empty($dailyDeals['data']) && $dailyDeal = $dailyDeals['data'][0];
        !empty($promotionDeals['data']) && $promotionDeals = $promotionDeals['data']['pblist'];
        !empty($promotionDeals) && $promotionDeals = array_slice($promotionDeals, 0, 6);
        $data['data'] = $this->renderPartial(
                                        '_deals',
                                        [
                                            'dailyDeal' => $dailyDeal,
                                            'promotionDeals' => $promotionDeals,
                                            'serverTime' => $serverTime
                                        ]
                                    );
        return $this->resAjax($data);
    }

    /**
     * 异步调用Your Recently Viewed Items and Featured Recommendations
     *
     * @return string json
     */
    public function actionAjaxvf()
    {
        $re = ['ret' => 1, 'data' => ''];
        $re['data'] = $this->renderPartial('_ViewedFeatured');
        return $this->resAjax($re);
    }
}
