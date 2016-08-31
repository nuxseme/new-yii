<?php
/**
* @author hyd
* @date 2016-08-16 10:42:05
* @todo 品牌网站用户主页控制器
*/

namespace app\controllers;

use common\helpers\TTAmazonHelper;
use Yii;
use common\models\Account;
use yii\helpers\Url;

class AccountController extends BaseController
{
    
    /**
     * @var _email
     */
    private $_email = null;
    private $_model = null;
    public function init()
    {
        parent::init();
        $this->enableCsrfValidation=false;
        $this->_email = $this->isLogin();
        $this->_model = Yii::createObject('common\models\Account');

    }

    public function beforeAction($action)
    {
        if (!$this->_email)
        {
            //测试
            $this->redirectLogin();
        }
        $this->setAccountSeo();
       return parent::beforeAction($action);
    }


    /**
     * [actionIndex 用户中心首页]
     * @desc  index + breadCrumbs
     * @return [string] 
     */
    public function actionIndex()
    {
        return $this->render(
                'index',
                [
                    //用户基础信息
                    'userBaseInfo' => $this->runAppAction(
                            '\common\actions\ppaccount\UserInfoAction',
                            [['email' => $this->_email, 'uuid' => $this->getUuid()]]
                        ),
                    //用户主页面包屑
                    'breadCrumbs' => $this->runAppAction(
                            '\common\actions\ppaccount\BreadCrumbsAction',
                            [['name' => 'Member Center']]
                        )
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
        return $this->render(
                            'profile',
                            [
                                //个人资料页面面包屑
                                'breadCrumbs' => $this->runAppAction(
                                        '\common\actions\ppaccount\BreadCrumbsAction',
                                        [['name' => 'change your profile']]
                                    ),
                                //个人资料
                                'profile' => $this->runAppAction(
                                    '\common\actions\ppaccount\ProfileAction',
                                    [['email' => $this->_email,'uuid' => $this->getUuid()]]
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

    /**
     * @author hyd
     * @date 2016年8月17日
     * @desc 显示 修改密码
     */
    public function actionPassword(){
        
        return $this->render(
                            'editPassword',
                            [
                                'email' => $this->_email,
                                //面包屑导航
                                'breadCrumbs' => $this->runAppAction(
                                       '\common\actions\ppaccount\BreadCrumbsAction',
                                        [['name' => 'change password']]
                                    )

                            ]);
    }
    /**
     * @author hyd
     * @date 2016年8月17日
     * @desc 用户中心超级会员信息显示
     */
    public function actionSuperuserinfo(){

        return $this->render(
                'superuserInfo',
                [
                     'breadCrumbs' => $this->runAppAction(
                                       '\common\actions\ppaccount\BreadCrumbsAction',
                                        [['name' => 'superuser information']]
                                    ),
                     //超级用户信息
                     'superuserInfo' => $this->runAppAction(
                                        '\common\actions\ppsuperuser\SuperuserInfoAction'
                                    )
                ]
            );
    }
}
