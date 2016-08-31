<?php
/*
* 详情页图片放大镜相关action
*
*/
namespace common\actions\detail;

use Yii;
use common\components\AppAction;

class ImgZoomAction extends AppAction
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
		$viewFile = 'detail/imgZoom';
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
