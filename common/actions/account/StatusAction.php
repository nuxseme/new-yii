<?php
/*
*用户中心首页action
*
*/
namespace common\actions\account;

use common\models\Account;
use Yii;
use common\components\AppAction;

class StatusAction extends AppAction
{
    
    
    /**
     * @desc  用户中心状态
     * @param $params  [email]
     * @param $model Account
     * @return string
     */
    public function run($params,$model)
    {
        //积分，优惠券，收藏，评论统计
        $userStatusArr = $model->getUserStatus(['email' => $params['email']])['data'];

        //订单状态统计
        $param = ['email' => $params['email'], 'site' => Yii::$app->params['website']];
        $orderStatus= Yii::createObject('common\models\UserOrder')->getOrderStatus($param)['data'];
        $userStatus = array();

        foreach ($userStatusArr as $value)
        {
            $userStatus[$value['name']] = $value['qty'];
        }
        
        //会员基本信息
        $userBaseInfo = $model->getUserBasicInfo(['email' => $params['email'],'uuid'=>$params['uuid']])['data'];
        
      return  $this->renderPartial('account/allStatus',[
            'userBaseInfo' => $userBaseInfo,
            'userStatus' => $userStatus,
            'orderStatus' => $orderStatus,
        ]);
    }
    
}
