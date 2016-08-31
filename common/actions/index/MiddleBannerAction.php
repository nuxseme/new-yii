<?php
/*
* 首页 中间并列 banner 模块相关Action
*
*/
namespace common\actions\index;

use Yii;
use common\components\AppAction;

class MiddleBannerAction extends AppAction
{
    /**
     * 运行action
     *
     * @param array $params
     * @return string
     */
    public function run($params = array())
    {
        $adModel = Yii::$container->get('AdvertModel');
        $banners = $adModel->getAdvert('HOME', 'BANNER-MIDDLE-TOPIC');
        $banners = $banners['ret'] == 1 ? $banners['data'] : [];
        return $this->renderPartial(
            'middleBanners',
            ['banners' => $banners]
        );
    }
}