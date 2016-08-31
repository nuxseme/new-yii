<?php
namespace app\controllers;

use Yii;
use common\models\UserOrder;
use common\helpers\TTPageHelper;

/**
 * Class AccountController
 * @desc 用户订单控制器
 * @package app\controllers
 */
class OrderController extends BaseController
{
    /**
     * @var UserOrder
     */
    private $_model = null;
    private $_email = null;

    public function init()
    {
        parent::init();
        $this->_model = Yii::createObject('common\models\UserOrder');
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


    public function actionIndex()
    {
        $page = Yii::$app->request->get('p', Yii::$app->params['page']);
        $productName = urlencode(trim(Yii::$app->request->get("productName")));
        $status = Yii::$app->request->get("status");
        $interval = Yii::$app->request->get("interval");
        $param = [
            'page' => $page,
            'size' => Yii::$app->params['pageSize'],
            'email' => $this->_email,
            'status' => $status,
            'interval' => $interval,
            'productName' => $productName,
            'siteId' => Yii::$app->params['website'],
        ];
        $res = $this->_model->getOrderLists($param);
        $orderStatus = $this->_model->getOrderStatus(['email' => $this->_email, 'site' => Yii::$app->params['website']]);
        $pages = new TTPageHelper($res['page']['totalRecord'], $res['page']['pageSize'], $page);

        return $this->render('index', [
            'orderList' => $res['data'],
            'orderAllStatus' => $orderStatus,
            'page' => $pages,
        ]);
    }

    public function actionDetail()
    {
        $orderNumber = \YII::$app->request->get('orderNumber');
        $param = [
            'orderNumber'   => $orderNumber,
            'email'         => $this->_email,
            'lang'          => 1,
            'siteId'        => Yii::$app->params['website'],
        ];
        $res = $this->_model->getOrderDetail($param);
        $data = $res['ret'] == 1 ? $res['data'] : [];
        return $this->render('detail', $data);        
    }

}
