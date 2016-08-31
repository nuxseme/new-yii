<?php

namespace common\actions\wallet;

use Yii;
use common\components\AppAction;
use common\helpers\TTPageHelper;
use common\models\UserWallet;

class CouponAction extends AppAction
{

    /**
     * @param $type
     * @param $uuid
     * @param $params
     * @param $model UserWallet
     * @return string
     */
    public function run($type,$uuid,$params,$model)
    {
        $res = $model->getCouponList($type, $uuid, $params);
        $couponList = $res['data'];
        $pages = new TTPageHelper($res['page']['totalRecord'], $res['pageSize'], $params['page']);
        return $this->renderPartial('wallet/couponList',[
            'couponList' => $couponList,
            'page' => $pages,
        ]);
    }

}
