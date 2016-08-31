<?php
namespace plugins\facebookLogin\controllers;

use Yii;
use common\components\AppController;
use plugins\facebookLogin\models\FacebookLogin;

/**
 * Default controller
 */
class LoginController extends AppController
{
    /**
     * Displays homepage.
     *
     * @param Event $event
     * @return mixed
     */
    public function actionIndex($event)
    {
      echo $this->renderPartial('index');
    }
    
    /**
     * @desc Facebook登录
     * @date 2017-7-11
     */
    public function actionSignFacebook()
    {
        $responseCode = Yii::$app->request->get("code");
        $responseCode = str_replace('>','',str_replace('<','',$responseCode));
        $code = $responseCode.'#_=_';
        $param=array(
            'code'=> urlencode($code),
            'webSite'=>13
        );
        $member=new FacebookLogin();
        $res = $member->getFaceBookSignInfo($param);
        if(1 == $res['ret'])
        {
            $cookieAction= $this->createAppAction('\common\actions\CookieAction');
            $cookieAction->setLoginCookie($res['data']['uuid'],$res['data']['token']);
            $this->redirect(['member/home']);
        }

    }


}
