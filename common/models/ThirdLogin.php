<?php
/**
 * @desc 第三方登录
 * @author wang
 */
namespace common\models;

use Yii;
use common\components\AppModel;
use yii\helpers\Json;
use common\components\AppCurl;

class ThirdLogin extends AppModel
{

    /**
     * @desc 获取FaceBook用户登录接口
     * @author wang
     * @date 2016-7-11
     * @param $param
     * @return mixed
     */
    public function getFaceBookSignInfo($param)
    {
        $appCurl=new AppCurl();
        $res = $appCurl->get(['api'=>'faceBookSign'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }


    /**
     * @desc 获取Google用户登录接口
     * @author wang
     * @date 2016-7-11
     * @param $param
     * @return mixed
     */
    public function getGoogleSignInfo($param)
    {
        $appCurl=new AppCurl();
        $res = $appCurl->get(['api'=>'googleSign'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * @desc 获取Vk用户登录接口
     * @author wang
     * @date 2016-7-11
     * @param $param
     * @return mixed
     */
    public function getVkSignInfo($param)
    {
        $appCurl=new AppCurl();
        $res = $appCurl->get(['api'=>'vkSign'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * @desc 获取Vk用户登录接口
     * @author wang
     * @date 2016-7-11
     * @param $param
     * @return mixed
     */
    public function getTwitterSignInfo($param)
    {
        $appCurl=new AppCurl();
        $res = $appCurl->get(['api'=>'twitterSign'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * @desc 获取Twitter登录Url接口
     * @author wang
     * @date 2016-7-11
     * @return mixed
     */
    public function  getTwitterUrl()
    {
        $appCurl=new AppCurl();
        $res = $appCurl->get(['api'=>'twitterUrl']);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }




}
