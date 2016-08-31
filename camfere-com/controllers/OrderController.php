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
        $this->setAccountSeo();
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
            'orderAllStatus' => $orderStatus['data'],
            'page' => $pages,
        ]);
    }

    public function actionDetail()
    {
        if (Yii::$app->request->isPost)
        {
            $orderNumber = Yii::$app->request->get('orderNumber');
        }
        else
        {
            $orderNumber = Yii::$app->request->get('orderNumber');
        }
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

    /**
     * @desc 删除订单
     * @return string
     */
    public function actionDelorders()
    {
        $order_ids = trim(Yii::$app->request->post("order_ids"));
        $order_ids = explode(',', $order_ids);
        $ids = array();
        if (!empty($order_ids)) {
            foreach ($order_ids as $key => $value) {
                $ids[$key] = $value;
            }
        }

        $params = [
            'email' => $this->_email,
            'siteId' => Yii::$app->params['website'],
            'orderNumbers' => $order_ids
        ];

        $result = $this->_model->delOrders($params);
        return $this->resAjax($result);
    }



}
