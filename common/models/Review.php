<?php
/**
 * 评论相关模型
 */
namespace common\models;

use Yii;
use common\components\AppModel;
use common\components\AppCurl;
use yii\helpers\Json;

class Review  extends AppModel
{
    /**
     * @desc 获取商品评论列表
     * @param $param [listingId,page,pageSize]
     * @return mixed
     */
    public static function getProductReviews($param)
    {
        $appCurl = new AppCurl;
        $re = $appCurl->get(array('api' => 'getReviewList'), $param);
        $re = $appCurl->convertResError($re);
        $data = Json::decode($re); 
        return $data;
    }
}

