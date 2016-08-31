<?php

namespace common\actions\account;

use common\models\Account;
use Yii;
use common\components\AppAction;

class ProfileAction extends AppAction
{

    /**
     * @param $params
     * @param $model Account
     * @return string
     */
 public function run($params,$model)
 {
     $userBasicInfo = $model->getUserBasicInfo(['email' =>$params['email'],'uuid'=>$params['uuid']])['data'];
     $hobby_years = $model->getAccountAttache(['type' => '1']);
     $experience_level = $model->getAccountAttache(['type' => '2']);
     return $this->renderPartial('account/profileEdit',[
         'userBasicInfo' => $userBasicInfo,
         'hobby_years' => $hobby_years,
         'experience_level' => $experience_level
     ]);
 }

}
