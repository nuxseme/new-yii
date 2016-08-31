<?php
/*
* 详情页评论列表相关action
*
*/
namespace common\actions\detail;

use Yii;
use common\components\AppAction;

class ReviewsAction extends AppAction
{
	/**
	* 运行action
	*
	* @param array $params
	* $params['rsnbo'] string 
    * $params['listingId'] string 
	*
	* @return string
	*/
	public function run($params)
	{
		return $this->renderPartial(
									'detail/reviews',
									[
                                        'reviewAndStartTotal' => $this->reviewAndStartTotal($params['rsnbo']),
                                        'reviewList' => $this->reviewList($params['listingId']),
                                        'listingId' => $params['listingId'],
                                    ]
								);
	}


	/**
     * 获取商品评论星级和评论总数
     * 
     * @param    array $reviewList
     * @return array
     */
    public function reviewAndStartTotal($reviewList)
    { 
        $result = $reviewList;
        $reviewList = $result['startNum'];
        if($reviewList)
        { 
            $startToPtage = array();
            foreach ($reviewList as $key => $value)
            { 
                $startToPtage[$value['startNum']] = $value['ptage'];
            }
        }
        return array('result' => $result, 'startToPtage' => $startToPtage);
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