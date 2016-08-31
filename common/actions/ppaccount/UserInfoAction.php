<?php
/**
* @author hyd
* @date 2016-08-16 10:23:10
* @todo 品牌网站 个人中心 首页个人信息展示action
*/

namespace common\actions\ppaccount;
use Yii;
use common\components\AppAction;
use common\models\Account;

class UserInfoAction extends AppAction
{
    /**
     * [run 运行]
     * @param  array  $params [description]
     *                email   电子邮件
     *                uuid    用户id                 
     * @return [type]         [description]
     */
    public function run($params = [])
    {
        $accountModel = new Account;
        //获取用户基础信息
        $userBaseInfo = $accountModel->getUserBasicInfo(['email' => $params['email'],'uuid'=>$params['uuid']])['data'];
        //print_r($userBaseInfo);
        return $this->renderPartial(
                'ppaccount/userBaseInfo',
                ['userBaseInfo' => $userBaseInfo ]//用户基础信息
            );
    }

}
