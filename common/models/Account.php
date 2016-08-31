<?php
/**
 * @desc 用户信息管理
 * @author wang
 */
namespace common\models;

use Yii;
use common\components\AppModel;
use common\components\AppCurl;
use yii\helpers\Json;

class Account extends AppModel
{
    /**
     * @var int $_cacheTime 缓存时间
     */
    private $_cacheTime = 3600;

    /**
     * @desc  根据必要参数获取会员附属信息（如：爱好时长，经验水平）
     * @author wang
     * @date  2016-7-13
     * @param $param [type]
     * @return mixed
     */
    public function getAccountAttache($param=array())
    {
        $cacheKey = __CLASS__ .'accountAttache';
        $res = Yii::$app->cache->get($cacheKey);
        if ($res === false)
        {
            $appCurl = new AppCurl();
            $res = $appCurl->get(['api' => 'accountAttache'], $param);
            $res = $appCurl->convertResError($res);
            $res = Json::decode($res);
            if( $res['ret'] == 1)
            {
                Yii::$app->cache->set($cacheKey, $res, $this->_cacheTime, 'user');
            }
        }
        return $res;
    }

    /**
     * @desc 上传用户头像去CDN
     * @param $param [file,type,uuid,client]
     * @return mixed
     */
    public function pushUserPhoto($param)
    {
        $appCurl = new  AppCurl();
        $res = $appCurl->post(['api' => 'pushUserPhoto'], $param, false);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * @desc 编辑会员信息
     * @param $param [dbirth,email,uuid,client,website,bactivated]
     * @return mixed
     */
    public function editMyProfile($param)
    {
        $appCurl = new  AppCurl();
        $res = $appCurl->post(['api' => 'editProfile'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * @desc 获取会员基础信息
     * @param $param  [email]
     * @return mixed
     */
    public function getUserBasicInfo($param = array())
    {
        $appCurl = new  AppCurl();
        $res = $appCurl->get(['api' => 'userBasicInfo'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * @desc 用户评论统计
     * @param $param [email]
     * @return mixed
     */
    public function getUserStatus($param)
    {
        $appCurl = new  AppCurl();
        $res = $appCurl->get(['api' => 'getUserStatus'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * @desc 修改密码
     * @param $param [cpassword,cnewpassword,cnewpassword,client,website,cemail,cuuid]
     * @return mixed
     */
    public function editPassword($param)
    {
        $appCurl = new  AppCurl();
        $res = $appCurl->post(['api' => 'editPassword'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * @desc 图片同步至服务器
     * @param $param
     * @return mixed
     */
    public function synchronizeToServer($param)
    {
        $appCurl = new  AppCurl();
        $res = $appCurl->put(['api' => 'synchronizeToServer'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * @author  hyd
     * @date    2016年8月17日
     * @desc    获取超级用户基础数据
     * @param   [type] $params [description]
     *                  memid  用户id
     *                  iwebsite 站点id
     */
    public function getSuperuserInfo($params){
        $appCurl = new AppCurl;
        $res = $appCurl->get(
                             ['api' => 'getSuperuserInfo'], 
                             $params
                            );
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }
    /**
     * @author hyd
     * @desc [updateSuperuserProfile 更新超级用户数据]
     * @date 2016年8月17日
     * @param  [type] $params [description]
     *                   memid    用户id
     *                   iwebsiteid 站点id
     *                   name     名字
     *                   gender   性别
     *                   country  国家
     *                   state    州
     *                   city      市
     *                   address    地址
     *                   zipcode    邮编
     *                   phone      电话
     *                   iam        角色
     *                   role       角色
     *                   amazonCountryDomain    亚马逊国家域 
     *                   amazonProfileLink      亚马逊link
     */
    public function updateSuperuserProfile($params){

        $appCurl = new AppCurl;
        $res = $appCurl->post(
                             ['api' => 'updateSuperuserProfile'], 
                             $params
                            );
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * @author hyd
     * @desc [addSuperuserProfile 添加超级用户数据]
     * @date 2016年8月17日
     * @param  [type] $params [description]
     *                   memid    用户id
     *                   iwebsiteid 站点id
     *                   name     名字
     *                   gender   性别
     *                   country  国家
     *                   state    州
     *                   city      市
     *                   address    地址
     *                   zipcode    邮编
     *                   phone      电话
     *                   iam        角色
     *                   role       角色
     *                   amazonCountryDomain    亚马逊国家域 
     *                   amazonProfileLink      亚马逊link
     */
    public function addSuperuserProfile($params){

        $appCurl = new AppCurl;
        $res = $appCurl->post(
                             ['api' => 'addSuperuserProfile'], 
                             $params
                            );
        $res = $appCurl->convertResError($res);
        return Json::decode($res);

    }

}

