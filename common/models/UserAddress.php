<?php
/**
 * @desc 用户地址管理
 * @author wang
 */
namespace common\models;

use Yii;
use common\components\AppModel;
use common\components\AppCurl;
use yii\helpers\Json;

class UserAddress extends AppModel
{

    /**
     * @desc 用户站内信列表
     * @param $param [email,atype,page,size]
     * @return mixed
     */
    public function getAddressList($param)
    {
        $appCurl=new AppCurl();
        $res = $appCurl->get(['api'=>'getAddressLists'], $param);
        $res = $appCurl->convertResError($res);
        $res = Json::decode($res);
        return $res;
    }


    /**
     * @desc 新增or编辑地址
     * @param $param [email,atype,fname',lname,street,city,country,province,postalcode,tel,website,company,isDef'] [id] =>传递id为修改,不传递为增加
     * @return mixed
     */
    public function write($param)
    {
        $appCurl = new AppCurl();
        $add = ['api' => 'addAddress'];
        $edit = ['api' => 'editAddress'];
        $request = isset($param['id']) ? $edit : $add;
        $res = $appCurl->post($request, $param);
        $res = $appCurl->convertResError($res);
        $res = Json::decode($res);
        return $res;
    }

    /**
     * @desc 删除地址
     * @param $param [ids,email,website]
     * @return mixed
     */
    public function delete($param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->post(['api'=>'deleteAddress'], $param,false);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * @desc 设为默认地址
     * @param $param
     * @return mixed
     */
    public function setDefAddress($param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->post(['api'=>'setDefaultAddress'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * @desc 获取地址信息
     * @param $param [id,email,atype,website]
     * @return mixed
     */
    public function getAddressDetail($param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->get(['api'=>'getAddressDetail'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

}

