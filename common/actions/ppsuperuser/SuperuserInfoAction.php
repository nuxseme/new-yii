<?php
/**
* @author hyd
* @date 2016-08-17 16:06:14
* @todo 品牌网站 超级用户数据
*/

namespace common\actions\ppsuperuser;
use Yii;
use common\components\AppAction;
use common\models\Account;

class SuperuserInfoAction extends AppAction
{

    /**
     * [run 运行]
     * @return string 渲染超级用户信息片段
     */
    public function run()
    {
        return $this->renderPartial(
                'ppsuperuser/superuserInfo',
                ['superuserInfo' => $this->getSuperuserInfo()]//超级用户基础信息
            );
    }


    /**
     * @desc 获取超级用户数据
     */
    public function getSuperuserInfo(){

        $accountModel = new Account;
        $res = $accountModel->getSuperuserInfo([
                    'memid' => $this->controller->getUuid(),
                    'iwebsiteid' => Yii::$app->params['website'],//站点id
                 ]);
        return $res['ret'] == 1 ? $res['data'] : [];
    }

}
