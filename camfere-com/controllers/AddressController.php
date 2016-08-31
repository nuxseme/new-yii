<?php
namespace app\controllers;


use Yii;
use common\models\UserAddress;

/**
 * Class AccountController
 * @desc 用户地址管理控制器
 * @package app\controllers
 */
class AddressController extends BaseController
{
    /**
     * @var UserAddress
     */
    private $_model = null;
    private $_email = null;

    public function init()
    {
        parent::init();
        $this->enableCsrfValidation = false;
        $this->_model = Yii::createObject('common\models\UserAddress');
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
     * @desc shipping_address
     * @return string
     */
    public function actionShipping()
    {
        $addressOption = [
            'type' => 'shipaddress',
            'title' => 'Shipping Address'
        ];
        return  $this->addressHandle(1, $addressOption);
    }

    /**
     * @desc bill_address
     * @return string
     */
    public function actionBilling()
    {
        $addressOption = [
            'type' => 'billaddress',
            'title' => 'Billing Address'
        ];
        return  $this->addressHandle(2, $addressOption);
    }

    /**
     * @desc address 处理函数
     * @param $type
     * @param $addressOption
     * @return string
     */
    private function addressHandle($type,$addressOption)
    {
        $page = Yii::$app->request->get('p', Yii::$app->params['page']);
        $params = [
            'email' => $this->_email,
            'atype' => $type,
            'page' => $page,
            'size' => Yii::$app->params['pageSize']
        ];
        return $this->render(
                                'index',
                                [
                                    'addressList' => $this->runAppAction(
                                                                            '\common\actions\address\AddressAction',
                                                                            [
                                                                                $params,
                                                                                $addressOption,
                                                                                $this->_model
                                                                            ]
                                                                        ),
                                ]
                            );
    }

    /**
     * @desc address 弹出编辑框
     */
    public function actionPopedit()
    {
        $addressId = Yii::$app->request->get('id');
        $addressType = Yii::$app->request->get('type');
        $param = array(
            'id' => $addressId,
            'email' => $this->_email,
            'atype' => $addressType == 'shipaddress' ? 1 : 2,
            'website' => Yii::$app->params['website'],
        );

        $res = $this->_model->getAddressDetail($param);
        $info = $res['ret'] == 1 ? $res['data'] : [];
        // print_r($userInfo);exit();
        return $this->renderPartial('_ajax_address', [
            'info' => $info,
            'type' => $addressType,
        ]);
    }

    /**
     * @desc address 编辑或者新增一个地址
     */
    public function actionWrite()
    {
        $post = Yii::$app->request->post();
        $allowDressType = array('shipaddress','billaddress');
        if(!in_array($post['type'],$allowDressType))
        {
            $this->resAjax(['ret'=>-1, 'data'=>'', 'msg'=>'type not exist']);
        }
        $params = [
            'email'         => $this->_email,//String 会员邮箱
            'atype'         => $post['type'] == 'shipaddress' ? 1 : 2,//int 地址类型 1:收货地址 2:账单地址
            'fname'         => $post['cfirstname'],//String 姓名首
            'lname'         => $post['clastname'],//String  姓名尾
            'street'        => $post['cstreetaddress'],//String 街道地址
            'city'          => $post['ccity'],//String  城市
            'country'       => $post['icountry'],//int  国家id
            'province'      => $post['cprovince'],//String  洲(省)
            'postalcode'    => $post['cpostalcode'],//String    邮政编码,
            'tel'           => $post['ctelephone'],//电话
            'website'       => Yii::$app->params['website'],//String  城市
            'company'       => '',//String  公司
            'isDef'         => $post['isDefault'] ? 1 : 0,//int 是否为默认地址
        ];
        $post['address_id'] && $params['id'] = $post['address_id'];//int 地址id
        $res = $this->_model->write($params);
        if ($res['ret'] == 1) 
        {
           $url = $post['type'] == 'shipaddress' ? 'shipping' : 'billing';
            $this->redirect(['address/'.$url]);
        }
        else
        {
            return $this->resAjax($res);
        }
    }    

    /**
     * @desc delete 删除地址
     */
    public function actionDelete()
    {
        $delIds = Yii::$app->request->post();
        $params = array(
            'ids'       => $delIds['dataId'],
            'email'     => $this->_email,
            'website'   => Yii::$app->params['website'],
        );
        $res = $this->_model->delete($params);
        return $this->resAjax($res);       
    }


    /**
     * @desc 设为默认地址
     */
    public function actionDefaddress()
    {
        $addressId = intval(Yii::$app->request->get('id'));
        $addressType = Yii::$app->request->get('type');
        $param = array(
            'id' => $addressId,
            'email' => $this->_email,
            'atype' => $addressType == 'shipaddress' ? 1 : 2,
            'website' => Yii::$app->params['website'],
        );

        $res = $this->_model->setDefAddress($param);
        if ($res['ret'] == 1)
        {
           $action = $addressType == 'shipaddress' ? 'shipping' : 'billing';
            $this->redirect(['address/'.$action]);
        }
        else
        {
            return $this->resAjax($res);
        }
    }

}
