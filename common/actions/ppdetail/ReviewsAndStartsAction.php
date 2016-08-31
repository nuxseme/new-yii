<?php
/**
* @author hyd
* @date 2016-08-13 16:03:11
* @todo 品牌网站商品评论总数和星级
*/

namespace common\actions\ppdetail;

use Yii;
use yii\helpers\Json;
use common\components\AppAction;
use common\models\product;

class ReviewsAndStartsAction extends AppAction
{
    /**
     * [run 运行]
     * @param  [type] $params [listingId]
     * @return [string]         [渲染片段]
     */
	public function run($params)
	{
        return $this->renderPartial(
                                    'ppdetail/reviewsAndStarts',
                                    [
                                        'reviewsAndStarts' => $this->reviewsAndStarts($params['listingId']),
                                    ]
                                );
	}

    /**
     * 获取商品评论星级和评论总数
     * 
     * @param    array $reviewList
     * @return array
     */
    public function reviewsAndStarts($listingId)
    { 
        $reviewsAndStarts = Yii::$container->get('ProductModel')->getReviewAndStart($listingId);
        $re = [
            'count' => 0,
            'start' => 0
        ];
        if($reviewsAndStarts['ret'] == 1)
        {
            $re = [
                'count' => $reviewsAndStarts['data']['count'],
                'start' => $reviewsAndStarts['data']['start']
            ];
        }

        return $re;
    }

}