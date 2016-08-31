<?php
/**
 * @desc 用户coupon、point 信息
 * @author wang
 */
namespace common\models;

use Yii;
use common\components\AppModel;
use common\components\AppCurl;
use yii\helpers\Json;

class UserWallet extends AppModel
{

    /**
     * @desc user coupon
     * @param $type
     * @param $uuid
     * @param $param [page,size]
     * @return mixed
     */
    public function getCouponList($type, $uuid, $param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->get(['api'=>'getMyCouponLists', 'params'=>['type'=>$type, 'uuid'=>$uuid]], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * @desc user point
     * @param $type
     * @param $uuid
     * @param $param [page,size]
     * @return mixed
     */
    public function getPointsList($type, $uuid, $param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->get(['api'=>'getMyPointsLists', 'params'=>['type'=>$type, 'uuid'=>$uuid]], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * @desc user count
     * @param $param [email]
     * @return mixed
     */
    public function getPointsCount($param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->get(['api'=>'getPointsCount'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }


    /**
     * @desc 获取用户积分等信息
     * @param $param
     * @return mixed
     */
    public function getPointsInfo($param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->get(['api'=>'getPointsInfo'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }
    

}

