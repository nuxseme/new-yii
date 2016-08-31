<?php
/**
* @author hyd
* @date 2016-08-16 09:21:38
* @todo 品牌网站 显示个人资料action
*/

namespace common\actions\ppaccount;
use Yii;
use common\components\AppAction;
use common\models\Account;

class ProfileAction extends AppAction
{

       /**
        * [run 运行]
        * @param  [type] $params [description]
        *                 email   电子邮箱
        *                 uuid     用户id
        * @return [string]         [description]
        */
     public function run($params = [])
     {
         $accountModel = new Account; 
         $userBasicInfo = $accountModel->getUserBasicInfo([
                                                        'email' =>$params['email'],
                                                        'uuid'=>$params['uuid']
                                                        ])['data'];
         //print_r($userBasicInfo);
         return $this->renderPartial(
                'ppaccount/profileEdit',
                ['userBasicInfo' => $userBasicInfo]
            );
     }

}
