<?php
/*
*用户中心首页action
*
*/
namespace common\actions\account;

use common\models\Account;
use Yii;
use common\components\AppAction;

class ReviewAction extends AppAction
{

    /**
     * @desc 用户review 列表
     * @param $params
     * @return string
     */
    public function run($params)
    {
        //获取评论列表(通过状态)
        $reviewList = Yii::createObject('common\models\UserReview')->getReviewList($params)['data'];

        return $this->renderPartial('account/reviewList',[
            'reviewList' => $reviewList,
        ]);
    }
    
}
