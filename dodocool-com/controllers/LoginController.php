<?php
namespace app\controllers;

use Yii;
use common\actions\CookieAction;
use common\models\ThirdLogin;
use yii\helpers\Url;

/**
 * @desc 第三方登录控制器
 * Class LoginController
 * @package app\controllers
 */
class LoginController extends BaseController
{


    /**
     * @desc 谷歌登录回调地址
     */
    public function  actionGoogle()
    {
        $responseCode = Yii::$app->request->get("code");
        $param=array(
            'code'=> urlencode($responseCode),
        );
        $member=new ThirdLogin();
        $res = $member->getGoogleSignInfo($param);
        if(1 == $res['ret'])
        {
            $cookieAction=new CookieAction($this);
            $cookieAction->setLoginCookie($res['data']['uuid'],$res['data']['token']);
            $this->redirect(Url::toRoute('account/index'));
        }

    }

    /**
     * @desc faceBook登录回调地址
     */
    public function  actionFacebook()
    {
        $responseCode = Yii::$app->request->get("code");
        $responseCode = str_replace('>','',str_replace('<','',$responseCode));
       // $code = $responseCode.'#_=_';
        $code = $responseCode;
        $param=array(
            'code'=> urlencode($code),
        );
        $member=new ThirdLogin();
        $res = $member->getFaceBookSignInfo($param);
        if(1 == $res['ret'])
        {
            $cookieAction=new CookieAction($this);
            $cookieAction->setLoginCookie($res['data']['uuid'],$res['data']['token']);
            $this->redirect(Url::toRoute('account/index'));
        }
    }

    /**
     * @desc Vk登录回调地址
     */
    public function  actionVk()
    {
        $responseCode = Yii::$app->request->get("code");
        $param = array(
            'code' => urlencode($responseCode),
        );
        $member=new ThirdLogin();
        $res = $member->getVkSignInfo($param);
        if($res['ret'] == 1)
        {
            $cookieAction=new CookieAction($this);
            $cookieAction->setLoginCookie($res['data']['uuid'],$res['data']['token']);
            $this->redirect(Url::toRoute('account/index'));
        }
    }

    /**
     * @desc twitter 登录回调地址
     */
    public function actionTwitter()
    {
        $oauthVerifier = Yii::$app->request->get("oauth_verifier");
        $TTHelp = Yii::$container->get('TTHelper');
        
        $param['oauth_verifier']        = $oauthVerifier;
        $param['oauth_token']           = $TTHelp->getCookie('TT_OAUTH_TOKEN');
        $param['oauth_token_secret']    = $TTHelp->getCookie('TT_OAUTH_TOKEN_SECRET');

        $member=new ThirdLogin();
        $res = $member->getTwitterSignInfo($param);

        $url = Url::home();
        if(isset($res['ret']) && $res['ret'] == 1)
        {
            $cookieAction=new CookieAction($this);
            $cookieAction->unsetLoginCookie();
            //删除twitter验证登陆
            $cookieAction->unsetOauthCookie();
        }
        $this->redirect($url);
    }

    /**
     * @desc 生成twitter Url
     */
    public function actionTwitterUrl()
    {
        $member=new ThirdLogin();
        $res = $member->getTwitterUrl();

        $url = Url::home();
        if(isset($res['ret']) && $res['ret'] == 1)
        {
            $url = $res['data']['url'];
            $oauthToken = $res['data']['oauthToken'];
            $oauthTokenSecret = $res['data']['oauthTokenSecret'];
            $cookieAction=new CookieAction($this);
            $cookieAction->setOauthCookie($oauthToken,$oauthTokenSecret);
        }
        $this->redirect($url);
    }

}