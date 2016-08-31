<?php
/*
* 详情页 图片展示区 action
*
*/
namespace common\actions\ppdetail;

use Yii;
use common\components\AppAction;

class ProductShowAction extends AppAction
{
	
	public function run($params=[])
	{
        $imgList = Yii::$container->get('TTHelper')->sortProductImgArray($params['imgList']);
		return $this->renderPartial(
									'ppdetail/productShow',
									['imgList' => $imgList]
								);
	}

	 
}