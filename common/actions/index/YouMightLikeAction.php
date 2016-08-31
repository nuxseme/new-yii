<?php
/*
* 首页 You Might Like 模块相关Action
*
*/
namespace common\actions\index;

use Yii;
use common\components\AppAction;

class YouMightLikeAction extends AppAction
{
    /**/
    public $isShowPrice = true;

    /**
     * 运行action
     *
     * @param array $params
     * @return string
     */
    public function run()
    {

        //外部参数
        $listingId = Yii::$app->request->get('listing_id');
        $position = Yii::$app->request->get('position');

        //获取数据
        $productModel = Yii::$container->get('ProductModel');
        $youMightLike = $productModel->getYouMayLike($listingId);
        $youMightLike = $youMightLike['ret'] == 1 ? $youMightLike['data'] : [];
        $res = ['ret' => 1, 'data' => "" ];

        //渲染
        $res['data'] =  $this->renderPartial(
            'index/_youmightlike', [
                'youMightLike' => $youMightLike,
                'position' => $position,
                'isShowPrice' => $this->isShowPrice
            ]
        );

        //返回
        return $this->controller->resAjax($res);
    }
}