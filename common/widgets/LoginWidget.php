<?php

namespace common\widgets;

use common\components\AppWidget;
use yii\helpers\Url;

class LoginWidget extends AppWidget
{
    public $language; //语言包

    public function init()
    {

    }

    public function run()
    {
       //第三方登录链接
        $result = \Yii::createObject('common\models\Member')->getThirdUrl()['data'];
        $urlArr = array();
        if($result)
        {
            foreach ($result as $key => $data)
            {
                if($data['type'] == 'facebook'){
                    $urlArr[1] = $data;
                }elseif($data['type'] == 'google'){
                    $urlArr[2] = $data;
                }elseif($data['type'] == 'vk'){
                     continue;
                   // $urlArr[4] = $data;
                }
            }
            $urlArr[3] = array('url'=>Url::toRoute('login/twitter-url'),'type'=>'twitter');
            ksort($urlArr);
        }
        return $this->render('login',[
            'thirdPartyLoginUrl'=>$urlArr,
        ]);
    }
}
