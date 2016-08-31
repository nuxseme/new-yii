<?php
/*
* 获取和设置COOKIE相关操作的action
*
*/
namespace common\actions;

use Yii;
use common\components\AppAction;

class CookieAction extends AppAction{

    public function run()
    {
    }

    /**
     * @desc 登录后设置cookie
     * @param $uuid
     * @param $token
     * @throws \yii\base\InvalidConfigException
     */
    public function setLoginCookie($uuid,$token)
    {
        Yii::$container->get('TTHelper')->setcookie(Yii::$app->params['uuid'], $uuid);
        Yii::$container->get('TTHelper')->setcookie(Yii::$app->params['token'], $token);
    }

    /**
     * @desc unset登录cookie
     * @throws \yii\base\InvalidConfigException
     */
    public function unsetLoginCookie()
    {
        Yii::$container->get('TTHelper')->unsetCookie(Yii::$app->params['uuid']);
        Yii::$container->get('TTHelper')->unsetCookie(Yii::$app->params['token']);
    }

    /**
     * @desc 设置oauth cookie
     * @param $oauthToken
     * @param $oauthTokenSecret
     * @throws \yii\base\InvalidConfigException
     */
    public function setOauthCookie($oauthToken,$oauthTokenSecret)
    {
        Yii::$container->get('TTHelper')->setcookie('TT_OAUTH_TOKEN', $oauthToken);
        Yii::$container->get('TTHelper')->setcookie('TT_OAUTH_TOKEN_SECRET', $oauthTokenSecret);
    }

    /**
     * @desc unset oauth cookie
     * @throws \yii\base\InvalidConfigException
     */
    public function unsetOauthCookie()
    {
        Yii::$container->get('TTHelper')->unsetCookie('TT_OAUTH_TOKEN');
        Yii::$container->get('TTHelper')->unsetCookie('TT_OAUTH_TOKEN_SECRET');
    }


}
