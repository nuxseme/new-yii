<?php
/**
 * @desc 用户注册登录管理
 * @author wang
 */
namespace common\models;

use Yii;
use common\components\AppModel;
use common\components\AppCurl;
use yii\helpers\Json;

class Member extends AppModel
{

    /**
     * @desc  用户注册接口
     * @author wang
     * @date  2016-7-11
     * @param $param
     * @return mixed
     */
    public function userRegister($param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->put(['api' => 'userRegister'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }


    /**
     * @desc 用户登录接口
     * @author wang
     * @date 2016-7-11
     * @param $param
     * @return mixed
     */
    public function userLogin($param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->post(['api' => 'userLogin'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }


    /**
     * @desc 忘记密码(发送邮件)接口
     * @author wang
     * @date 2016-7-11
     * @param $param
     * @return mixed
     */
    public function forgetPassword($param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->post(['api' => 'forgetPassword'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }


    /**
     * @desc 忘记密码(修改密码)接口
     * @author wang
     * @date 2016-7-11
     * @param $param
     * @return mixed
     */
    public function changePassword($param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->post(['api' => 'changePassword'],$param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * @desc 邮件订阅接口
     * @author wang
     * @date 2016-7-11
     * @param $param
     * @return mixed
     */
    public function mailSubscribe($param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->post(['api' => 'mailSubscribe'], $param, false);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }



    /**
     * @desc 用户通过邮件URL链接激活接口
     * @author wang
     * @date 2016-7-11
     * @param $param
     * @return mixed
     */
    public function mailActivate($param)
    {
        $appCurl = new AppCurl();
        $res=$appCurl->get(['api' => 'mailActivate'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * 根据UUID获取会员邮箱
     * 
     * 
     * @param string $UUID
     * @return array
     */
    public function getUserEmailByUUID($UUID)
    {
        $res = ['ret' => -1, 'data' => ''];
        if(!empty($UUID))
        { 
            $appCurl = new AppCurl();
            $res = $appCurl->get(
                                ['api' => 'getUserEmail', 'params' => ['UUID' => $UUID]]
                            );
            $res = $appCurl->convertResError($res);
            $res = Json::decode($res);
        }
        return $res;
    }

    /**
     * 获取第三方登录地址
     * 
     * @return array
     */
    public function getThirdUrl()
    {
        $appCurl = new AppCurl();
        $res=$appCurl->get(['api' => 'thirdLoginUrl']);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * 品牌站发送contact信息
     *
     * @param array $params
     * [email], [subject], [attachment],[detail]
     *
     * @return array
     */
    public function sendContactMsg($params)
    {
        $appCurl = new AppCurl();
        $res=$appCurl->get(['api' => 'sendContactMsg'], $params);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * 品牌站获取contact主题
     *
     * @return array
     */
    public function getContactSubjects()
    {
        $cacheTime = 3600;
        $cacheKey = __CLASS__ . __METHOD__ . '_contactSubjects';
        $re = Yii::$app->cache->get($cacheKey);
        if($re === false)
        {
            $appCurl = new AppCurl();
            $re = $appCurl->get(['api' => 'getContactSubjects']);
            $re = $appCurl->convertResError($re);
            $re = Json::decode($re);
            if($re['ret'] == 1)
            {
                Yii::$app->cache->set($cacheKey, $re, $cacheTime, 'contactSubjects');
            }
        }
        return $re;
    }
}

