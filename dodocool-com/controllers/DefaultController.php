<?php
/**
* @author hyd
* @date 2016-08-13 17:57:44
* @todo 首页入口
*/
namespace app\controllers;

use Yii;
use yii\helpers\Url;
class DefaultController extends BaseController
{
    /**
     * 首页
     *
     * @return mixed
     */
    public function actionIndex()
    {
        //seo信息
        $this->seoMeta(
            [
                'title' => 'dodocool',
                'description' => 'dodocool',
                'keywords' => 'dodocool'
            ]
        );
        //banner + 活动区数据
        return $this->render(
                                'index',
                                [
                                    'sliderBanner' => $this->runAppAction('\common\actions\ppindex\SliderBannerAction'),
                                    'downBanner' => $this->runAppAction('\common\actions\ppindex\DownBannerAction'),
                                ]
                            );
    }

}
