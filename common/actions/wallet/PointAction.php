<?php

namespace common\actions\wallet;

use common\helpers\TTPageHelper;
use Yii;
use common\components\AppAction;
use common\models\UserWallet;

class PointAction extends AppAction
{
    /**
     * @param $type
     * @param $uuid
     * @param $email
     * @param $params
     * @param $model UserWallet
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function run($type,$uuid,$email,$params,$model)
    {
        $res = $model->getPointsList($type, $uuid,$params);
        $userBasicInfo = Yii::createObject('common\models\Account')->getUserBasicInfo(['email' => $email,'uuid'=>$uuid])['data'];
        $totalPoint = $model->getPointsCount(['email' => $email]);
  
        $page = new TTPageHelper($res['page']['totalRecord'],$res['page']['pageSize'],$params['page']);

      return $this->renderPartial('wallet/pointList',[
          'pointsList' => $res['data'],
          'page' => $page,
          'totalPoint' => $totalPoint,
          'accountBaseInfo' => $userBasicInfo,
      ]);
    }

}
