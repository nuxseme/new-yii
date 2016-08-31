<?php
namespace app\controllers;

use Yii;
use common\models\UserMessage;
use common\actions\message\MessageAction;

/**
 * Class AccountController
 * @desc 用户消息控制器
 * @package app\controllers
 */
class MessageController extends BaseController
{
    /**
     * @var UserMessage
     */
    private $_model = null;
    private $_email = null;

    public function init()
    {
        parent::init();
        $this->_model = Yii::createObject('common\models\UserMessage');
        $this->_email = $this->isLogin();
    }

    public function beforeAction($action)
    {
        if (!$this->_email)
        {
            $this->redirectLogin();
        }
        return parent::beforeAction($action);
    }


    /**
     * @desc message list
     */
    public function actionIndex()
    {
        $page = Yii::$app->request->get('p', Yii::$app->params['page']);
        $params = ['email' => $this->_email, 'page' => $page, 'size' =>Yii::$app->params['pageSize']];

        return $this->render('index',[
            'messageList' => (new MessageAction($this))->run($params,$this->_model),
        ]);
    }

    /**
     * @desc 操作message
     */
    public function actionHandler()
    {
        $request = Yii::$app->request;
        $action = $request->post('action');
        $ids = $request->post('ids');
        $ids = explode(',', $ids);
    //    $tmp1 = array();
        $tmp2 = array();
        if (!empty($ids)) 
        {
            foreach ($ids as $key => $value) 
            {
                if ($value) 
                {
                    $tmp1 = explode('&', $value);
                    $tmp_id = explode('=', $tmp1[0]);
                    $tmp_t = explode('=', $tmp1[1]);
                    $tmp2[] = [
                        'id' => $tmp_id[1],
                        't'  => 'i',
                        // 't'  => $tmp_t[1],
                    ];
                }
            }
        }
        
        $ids = '';
        foreach ($tmp2 as $key => $value){ 
            $ids .= $value['id'].':'.$value['t'].',';
        }
        $ids = substr($ids,0,-1);
        
        $params = [
            'email'     => $this->_email,
            'website'   => Yii::$app->params['website'],
            'ids'       => $ids,
        ];

        $res = $this->_model->handlerMessage($action,$params);
        return $this->resAjax($res);
    }

}
