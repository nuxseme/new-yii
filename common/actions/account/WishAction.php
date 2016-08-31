<?php
/*
*用户中心首页action
*
*/
namespace common\actions\account;

use Yii;
use common\components\AppAction;

class WishAction extends AppAction
{

    /**
     * @desc 用户wish列表
     * @param $params
     * @return string
     */
    public function  run($params)
    {
        //获取用户收藏列表
        $wishList = Yii::createObject('common\models\UserWish')->getProCollectList($params)['data'];

        return $this->renderPartial('account/wishList',[
            'wishList' => $wishList,
        ]);
    }
}
