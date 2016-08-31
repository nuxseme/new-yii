<?php
/**
 * @desc 第三方登录model
 * @author wang
 */
namespace plugins\facebookLogin\models;

use Yii;
use common\components\AppModel;
use common\components\AppCurl;
use yii\helpers\Json;

class FacebookLogin extends AppModel
{

    /**
     * @desc 获取FaceBook用户登录接口
     * @author wang
     * @date 2016-7-11
     * @param $param
     * @return mixed
     */
    public function getFaceBookSignInfo($param)
    {
        $appCurl=new AppCurl();
        $res = $appCurl->get(['api'=>'faceBookSign'], $param);
        return Json::decode($res);
    }
    
}

