<?php
/*
*you may also like
*/
namespace common\actions\ppdetail;

use Yii;
use yii\helpers\Json;
use common\components\AppAction;

class YouMayLikeAction extends AppAction
{
    
	public function run($params)
	{
       return $this->renderPartial(
            'ppdetail/youMayLike',
            ['youMayLike' => $this->getYouMayLike($params['listingId']),]
        );
	}

    /**
     * [getYouMayLike 获取you may like的商品数据]
     * @param  [type] $listingId [description]
     * @return [type]            [description]
     */
    public function getYouMayLike($listingId){

        $re = Yii::$container->get('ProductModel')->getYouMayLike($listingId);
        return $re['ret'] == 1 ? $re['data'] : [];
    }
}