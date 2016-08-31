<?php
namespace app\controllers;


use Yii;
use common\models\Member;
use yii\base\Event;
use yii\helpers\Json;
use common\helpers\TTCaptcha;
use yii\helpers\Url;
use common\helpers\TTHelper;

class MemberController extends BaseController
{
    /**
     * @var Member
     */
    private $_model;

    /**
     * @var TTHelper $TTHelper
     */
    protected $TTHelper;

    public function init()
    {
        parent::init();
        $this->enableCsrfValidation =false ;
        $this->_model=new Member();
        $this->TTHelper = Yii::$container->get('TTHelper');
    }

    /**
     * @desc 注册首页
     * @return string
     */
    public function actionIndex()
    {
        if($this->isLogin()){

           $this->redirect(Url::toRoute('account/index'));
        }
        return $this->render('register');
    }

    /**
     * @desc 忘记密码
     * @return string
     */
    public function actionForgetpass()
    {
        $request = Yii::$app->request;
        if ($request->isPost)
        {
            $param = [
                'email'   => $request->post('email'),
                'client'  => Yii::$app->params['client'],
                'website' =>Yii::$app->params['website']
            ];
          $res = $this->_model->forgetPassword($param);
          return $this->resAjax($res);
        }
        else
        {
            return $this->render('forgetpass');
        }
    }

    /**
     * @desc 登录页面
     * @return string
     */
    public function actionUserlogin()
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
                    $urlArr[4] = $data;
                }
            }
            $urlArr[3] = array('url'=>Url::toRoute('login/twitter-url'),'type'=>'twitter');
            ksort($urlArr);
        }
        $backUrl = Yii::$app->request->get('backUrl');
        return $this->render('login',[
            'backUrl'	=> urlencode($backUrl),
            'thirdPartyLoginUrl'=>$urlArr,
        ]);
    }

    /**
     * @desc 验证码
     */
    public function actionCode()
    {
        $captcha = new TTCaptcha();
        $captcha->width = 80;
        $captcha->height = 32;
        $captcha->fontsize = 16;
        $code = $captcha->getCode();
        $did = Yii::$container->get('TTHelper')->getCookie(Yii::$app->params['device']);
        if (!$did)
        {
            $did = TTHelper::createUniqueId();
            Yii::$container->get('TTHelper')->setcookie(Yii::$app->params['device'], $did);
        }

        $prefix = Yii::$app->params['code'];
        $key = TTHelper::createCacheKey($prefix, $did);
        $redis = Yii::$app->redis;
        $redis->set($key, $code, 3600);
        return $captcha->doimg();
    }
    
    /**
     * @desc 用户注册
     * @date 2016-7-11
     */
    public function actionRegister()
    {
        $request = Yii::$app->request->post();
        $validate = $this->createAppAction('\common\actions\ValidateAction');
        $result = $validate->registerVerify($request);
        if ($result['status'] == 0)
        {
            return Json::encode(['status' => 0, 'errorMessage' => $result['errMsg']]);
        }

        $requestParam = array(
            'email' => $request['email'],
            'pwd' => $request['pw'],
            'website'=>Yii::$app->params['website'],
            'countryShort' => 'US'
        );

        $res = $this->_model->userRegister($requestParam);
        if (1 == $res['ret'])
        {
            //注册成功事件
            Event::trigger($this::MOUNT_CLASS, $this::E_REGISTER_SUCCESS);
            return Json::encode(['status' => 1]);
        }
        else
        {
            //注册失败事件
            Event::trigger($this::MOUNT_CLASS, $this::E_REGISTER_FAILED);
            return Json::encode(['status' => 0, 'errorMessage' => $res['errMsg']]);
        }
    }


    /**
     * @desc 注册页面成功
     */
    public function actionSuccess()
    {
        return $this->render('success');
    }

    /**
     * @desc 用户登录
     * @date 2016-7-11
     */

    public function actionLogin()
    {
        $request = Yii::$app->request->post();
        $params = array(
            'email' => trim($request['email']),
            'pwd' => trim($request['pw']),
            'countryShort' => 'US',
            'website' => Yii::$app->params['website'],
        );
        $res=$this->_model->userLogin($params);
        if (1==$res['ret'])
        {
           //登录成功事件
            Event::trigger($this::MOUNT_CLASS, $this::E_LOGIN_SUCCESS);
            $cookieAction = $this->createAppAction('\common\actions\CookieAction');
            $cookieAction->setLoginCookie($res['data']['uuid'], $res['data']['token']);
        }
        else
        {
            //登录失败事件
            Event::trigger($this::MOUNT_CLASS, $this::E_LOGIN_FAILED);
        }
        return  $this->resAjax($res);
    }

    /**
     * @desc 用户退出登录
     * @date 2016-7-11
     */
    public function actionLogout()
    {
        $cookieAction = $this->createAppAction('\common\actions\CookieAction');
        $cookieAction->unsetLoginCookie();
        $this->redirect(Url::home());
    }

    /**
     * @desc 邮件订阅
     */
    public function actionSubscription()
    {
        $request = Yii::$app->request;
        if ($request->isPost)
        {
            $lang = Yii::$container->get('TTHelper')->getCookie('TT_LANG');
            $param = array(
                'lang' => $lang ? $lang : 1,
                'email' => $request->post('email'),
                'website' => Yii::$app->params['website'],
                'categoryArr' =>substr( $request->post('categoryArr'), 0,-1)
            );
            $result = $this->_model->mailSubscribe($param);
            if ($result['ret'] != 1)
            {
                $result['msg'] = isset($result['errMsg']) ? $result['errMsg'] : 'error';
            }
          return  $this->resAjax($result);

        }
        else
        {
            return $this->render('subscription');
        }
    }


    
}
