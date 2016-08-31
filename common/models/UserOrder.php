<?php
/**
 * @desc 用户订单信息
 * @author wang
 */
namespace common\models;

use Yii;
use common\components\AppModel;
use common\components\AppCurl;
use yii\helpers\Json;

class UserOrder extends AppModel
{

    /**
     * @desc 获取订单列表
     * @param $param [page,size,email,status,interval,productName,siteId]
     * @return mixed
     */
    public function getOrderLists($param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->get(['api'=>'getOrderLists'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }


    /**
     * @desc 获取订单详情
     * @param $param [orderNumber,email,lang,siteId]
     * @return mixed
     */
    public function getOrderDetail($param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->get(['api'=>'getOrderDetail'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }


    /**
     * @desc 我的订单数量统计
     * @param $param [email,site]
     * @return mixed
     */
    public function getOrderStatus($param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->get(['api'=>'getMyOrderStatus'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * @desc 删除订单
     * @param $param
     * @return mixed
     */
    public function delOrders($param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->put(['api'=>'delOrder'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }


}

