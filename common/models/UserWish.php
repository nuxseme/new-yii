<?php
/**
 * @desc 用户收藏信息
 * @author wang
 */
namespace common\models;

use Yii;
use common\components\AppModel;
use common\components\AppCurl;
use yii\helpers\Json;

class UserWish extends AppModel
{


    /**
     * @desc 增加产品收藏
     * @param $param
     * @return mixed
     */
    public function addProCollect($param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->put(['api'=>'addProCollect'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * @desc 获取用户产品收藏列表
     * @param $param [email,categoryId,sort,productKey,page,size]
     * @return mixed
     */
    public function getProCollectList($param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->get(['api'=>'getProCollectList'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * @desc  收藏产品的listingId列表
     * @param $param
     * @return mixed
     */
    public function getCollectIdLists($param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->get(['api'=>'getCollectIdLists'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * @desc 删除收藏的产品
     * @param $param [ids,email,website]
     * @return mixed
     */
    public function delete($param)
    {

        $appCurl = new AppCurl();
        $res = $appCurl->post(['api'=>'deleteProCollect'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }


}

