<?php
namespace app\controllers;

use common\actions\wallet\PointAction;
use Yii;
use common\models\UserWallet;
use common\actions\wallet\CouponAction;

/**
 * Class AccountController
 * @desc 用户coupon、point控制器
 * @package app\controllers
 */
class WalletController extends BaseController
{
    /**
     * @var UserWallet
     */
    private $_model = null;
    private $_email = null;

    public function init()
    {
        parent::init();
        $this->_model = Yii::createObject('common\models\UserWallet');
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


    public function actionCoupon()
    {
        $page = Yii::$app->request->get('type');
        $page = intval($page) > 1 ? intval($page) : Yii::$app->params['page'];
        $type = Yii::$app->request->get('type');
        $type = $type == 'used' ? 'used' : 'unused';
        $uuid = $this->getUuid();
        $params = ['page' => $page, 'size' => Yii::$app->params['pageSize']];
        
        return $this->render('coupon', [
            'couponList' => (new CouponAction($this))->run($type,$uuid,$params,$this->_model),
        ]);
    }

    public function actionPoint()
    {
        $page = Yii::$app->request->get('page');
        $page = intval($page);
        $page = $page > 1 ? $page : Yii::$app->params['page'];
        $type = Yii::$app->request->get('type');
        $type = $type == 'used' ? 'used' : 'unused';
        $uuid = $this->getUuid();
        $params = ['page' => $page, 'size' => Yii::$app->params['pageSize']];
        
        return $this->render('point', [
            'pointsList' => (new PointAction($this))->run($type,$uuid,$this->_email,$params,$this->_model)
        ]);
    }


}
