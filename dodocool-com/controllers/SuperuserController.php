<?php
/**
* @author hyd
* @date 2016-08-17 11:16:51
* @todo 品牌网站超级用户控制器
*/
namespace app\controllers;

use Yii;
use yii\helpers\Url;
use common\models\Account;
use common\models\Member;
use common\helpers\TTHelper;
use yii\base\Event;
use yii\helpers\Json;

class SuperuserController extends BaseController
{
	/**
     * @var Member
     */
    private $_model;

    /**
     * @var TTHelper $TTHelper
     */
    protected $TTHelper;
    /**
     * [init 初始化]
     */
    public function init()
    {
        parent::init();
        $this->_model=new Member();
        $this->TTHelper = Yii::$container->get('TTHelper');
    }
    /**
     * 超级用户页面显示
     *
     * @return mixed
     */
    public function actionIndex()
    {

       return $this->render(
       				'index',
       				[
                        'isLogin' => $this->isLogin(),//检测是否已经登录
       					'breadCrumbs' => $this->runAppAction(
                            '\common\actions\ppaccount\BreadCrumbsAction',
                            [['name' => 'Super User']]
                        ),
                        //超级用户数据
                        'superuserInfo' => $this->runAppAction(
                            '\common\actions\ppsuperuser\SuperuserInfoAction'
                        )
       				]
       			);
    }


    /**
     * [actionRegister 超级用户注册]
     */
    public function actionRegister()
    {
        $request = Yii::$app->request->post();
        $validate = $this->createAppAction('\common\actions\ppsuperuser\ValidateAction');
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
     * @author hyd
     * @date   2016年8月17日
     * @desc   保存超级用户资料
     */
    public function actionSaveprofile(){

        $post = Yii::$app->request->post();
        unset($post['_csrf']);
        $post['memid'] = $this->getUuid();
        $post['iwebsiteid'] = Yii::$app->params['website'];
        //print_r($post);
        $accountModel = new Account;
        $getSuperuserInfo = $accountModel->getSuperuserInfo([
                                                        'memid' => $this->getUuid(),
                                                        'iwebsiteid' => Yii::$app->params['website']
                                                    ]);

        if($getSuperuserInfo['ret'])
        {
            //更新
            $res = $accountModel->updateSuperuserProfile($post);
        }else{
            //保存
            $res = $accountModel->addSuperuserProfile($post);
        }

        if ( 1 == $res['ret'] ) 
        {
           $this->redirect(['superuser/index']);
        }
        else
        {
            return $this->resAjax($res);
        }
    }

}
