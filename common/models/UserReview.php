<?php
/**
 * @desc 用户评论信息
 * @author wang
 */
namespace common\models;

use Yii;
use common\components\AppModel;
use common\components\AppCurl;
use yii\helpers\Json;

class UserReview extends AppModel
{

    /**
     * @desc 获取评论列表
     * @param $param  [email,uuid,status,dateType,page,limit]
     * @return mixed
     */
    public function getReviewList($param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->get(['api'=>'getReviewList'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }


    /**
     * @desc 获取评论详情
     * @param $param [uuid,email,iid]
     * @return mixed
     */
    public function getReviewInfo($param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->get(['api'=>'getReviewDetail'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);

    }


    /**
     * @desc 发表或更新一个评论
     * @param $param 
     * [comment,listingId,ps,qs,ss,foverallratingStarWidth,us,videoTitle,videoUrl,sku,oid,email,website,countryName,pform] 
     * [commentId,uuid,imageUrls]当存在评论编号时传入
     * @return mixed
     */
    public function write($param)
    {
        $appCurl = new AppCurl();
        $api = isset($param['commentId']) ? 'editReview' : 'addReview';
        $res = $appCurl->post(['api'=>$api], $param, false);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }


    /**
     * @desc 删除评论
     * @param $rid
     * @param $param
     * @return mixed
     */
    public function deleteReview($rid, $param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->post(['api' => 'deleteReview', 'params' => ['rid' => $rid]], $param, false);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * @desc 获取评论统计
     * @param $param [uuid,email]
     * @return mixed
     */
    public function reviewStatus($param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->get(['api'=>'reviewStatus'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }



}

