<?php
namespace app\controllers;

use common\helpers\TTAmazonHelper;
use Yii;
use common\models\Account;
use yii\helpers\Url;

/**
 * Class AccountController
 * @desc 用户中心控制器
 * @package app\controllers
 */
class AccountController extends BaseController
{
    /**
     * @var Account
     */
    private $_model = null;
    private $_email = null;

    public function init()
    {
        parent::init();
        $this->enableCsrfValidation=false;
        $this->_model = Yii::createObject('common\models\Account');
        $this->_email = $this->isLogin();

    }

    public function beforeAction($action)
    {
        if (!$this->_email)
        {
            $this->redirectLogin();
        }
        $this->setAccountSeo();
       return parent::beforeAction($action);
    }


    /**
     * @desc 用户中心首页
     *
     */
    public function actionIndex()
    {
        $uuid = $this->getUuid();
        return $this->render('index',[
            'allStatus' 	=>  $this->runAppAction(
                                    '\common\actions\account\StatusAction', 
                                    [
                                        ['email'=>$this->_email, 'uuid'=>$uuid],
                                        $this->_model
                                    ]
                                ),
            'reviewList'    =>  $this->runAppAction(
                                    '\common\actions\account\ReviewAction',
                                    [
                                        ['email' => $this->_email, 'status' => 1, 'page' => 1, 'limit' => 5],
                                        $this->_model
                                    ]
                                ),
            'wishList'      => $this->runAppAction(
                                    '\common\actions\account\WishAction',
                                    [
                                        ['email' => $this->_email, 'status' => 1, 'page' => 1, 'limit' => 5]
                                    ]
                                ),
        ]);
    }

    /**
     * @desc 上传头像
     * @date 2017-7-19
     */
    public function actionUploadimg()
    {
        $file = isset($_FILES['file']) ? $_FILES['file'] : '';
        //上传至s3
        $res = TTAmazonHelper::uploadFilesToS3($file,1024 * 200);

        //保存至服务器
        $params = [
            'email' => $this->_email,
            'website' => Yii::$app->params['website'],
            'imageurl' => $res['uploaedFile']
        ];

        $result =$this->_model->synchronizeToServer($params);

        if ($result['ret']==1)
        {
            return $this->resAjax($res);
        }
        else
        {
            return $this->resAjax(['ret'=>-1,'msg'=>'图片保存失败']);
        }

    }

    /**
     * @desc 头像推到CDN
     * @date 2017-7-19
     */
    public function actionPhotopush()
    {
        $dataInfo = Yii::$app->request->post();
        $params = array();
        $params['file'] = '@'.APP_PATH.'/web'.$dataInfo['filePath'];
        $params['type'] = 'memberHead';
        $params['email'] = $this->_email;
        $params['uuid'] = $this->getUuid();
        $params['client'] = Yii::$app->params['client'];

        $res = $this->_model->pushUserPhoto($params);
        return $this->resAjax($res);
    } 

    /**
     * @desc 个人资料
     * @date 2017-7-19
     */
    public function actionProfile()
    {
        $uuid = $this->getUuid();
        return $this->render(
                                'profile', 
                                [
                                    'profileEdit' => $this->runAppAction(
                                                                            '\common\actions\account\ProfileAction',
                                                                            [
                                                                                ['email'=>$this->_email,'uuid'=>$uuid],
                                                                                $this->_model
                                                                            ]
                                                                        ),
                                ]);
    }

    /**
     * @desc 编辑个人资料
     * @date 2017-7-19
     */
    public function actionEditprofile()
    {
        $param = Yii::$app->request->post();
        $param['birthday'] = intval(strtotime($param['year'].'-'.$param['month'].'-'.$param['day'])) * 1000;
        unset($param['year']);
        unset($param['month']);
        unset($param['day']);
        unset($param['country_filter']);
        unset($param['_csrf']);
        $param['email'] = $this->_email;
        $param['uuid'] = $this->getUuid();
        $param['client'] = Yii::$app->params['client'];
        $param['website'] = Yii::$app->params['website'];
        $param['bactivated'] = ($param['bactivated'] == 1)?true:false;
        $res = $this->_model->editMyProfile($param);
        
        if ($res['ret'] == 1) 
        {
            $this->redirect(['account/profile']);
        }
        else
        {
            return $this->resAjax($res);
        }
    }

    /**
     * @desc 修改密码
     * @date 2016-7-23
     */
    public function actionEditpassword()
    {
        $dataInfo = Yii::$app->request->post();
        $params = array(
            'cpassword' => trim($dataInfo['cpassword']),
            'cnewpassword' => trim($dataInfo['cnewpassword']),
            'ccnewpassword' => trim($dataInfo['ccnewpassword']),
            'client' => Yii::$app->params['client'],
            'website' => Yii::$app->params['website'],
            'cemail' => $this->_email,
            'cuuid' => $this->getUuid(),
        );
        if(strlen($params['cnewpassword'])<6 || strlen($params['ccnewpassword'])<6)
        {
            return  $this->resAjax(['ret'=>0,'errMsg'=>'New password Enter at least 6 characters']);

        }
        if($params['cnewpassword'] !== $params['ccnewpassword'])
        {
            return $this->resAjax(['ret'=>0, 'errMsg'=>'Confirm password is not consistent']);

        }
        $res = $this->_model->editPassword($params);
        if ($res['ret'] ==1)
        {
            return  $this->resAjax(['ret'=>1, 'redirectUrl'=>Url::toRoute('member/logout')]);
        }
        return  $this->resAjax($res);

    }

    /**
     * @desc 获取登录用户信息
     * @date 2017-7-11
     */
    public function actionGetUser()
    {
        $res = $this->_model->getUserEmail();

        if (1 == $res['ret'])
        {
            $displayAccountName = (empty($res['data']['account'])) ? $res['data']['email'] : $res['data']['account'];
            $href = Url::toRoute('member/logout');
            $result = 'Hello,<b>' . $displayAccountName . '</b> <a id="logout" aid="' . $res['aid'] . '" href="'.$href.'" class="color666">Sign out</a>';
            return  $this->resAjax(['ret' => 1,'data' => $result,'msg' => '']);
        }
        else
        {
            return $this->resAjax(['ret' => 0, 'data' => '', 'msg' => 'do not login']);
        }
    }


}
