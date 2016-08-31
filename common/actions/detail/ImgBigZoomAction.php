<?php
/*
* 详情页图片放大镜(小图的左侧)相关action
*
*/
namespace common\actions\detail;

use Yii;
use common\components\AppAction;

class ImgBigZoomAction extends AppAction
{
    /**
     * 运行action
     *
     * @param array $params
     * $params['slideImgList'] array 所有图片列表
     * $params['productTitle'] string 商品标题
     * $params['suffix'] string 视图后缀 应用于多个视图
     *
     * @return string
     */
    public function run($params)
    {
        $viewFile = 'detail/imgBigZoom';
        isset($params['suffix']) && $params['suffix'] && $viewFile .= $params['suffix'];
        return $this->renderPartial(
            $viewFile,
            [
                'productTitle' => $params['productTitle'],
                'slideImgList' => $params['slideImgList'],
            ]
        );
    }
}
