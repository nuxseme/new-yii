<?php
/*
* 详情页 评论相关action
*
*/
namespace common\actions\ppdetail;

use Yii;
use yii\helpers\Json;
use common\components\AppAction;

class ReviewAction extends AppAction
{
    

	/**
	* 运行action
	*
	* @param array $params
    * $params['listingId'] string 
	*
	* @return string
	*/
	public function run($params)
	{
        return $this->renderPartial(
            'ppdetail/reviewList',
            [
                'reviewLists' => $this->reviewList($params['listingId']),//评论列表
            ]
        );
	}

    /**
     * 详情页评论列表
     * 
     * @param string $listingId
     * @return array
     */
    public function reviewList($listingId)
    { 
        $re = Yii::$container->get('ProductModel')->getReview($listingId);
        return $re['ret'] == 1 ? $re['data'] : [];
    }
}