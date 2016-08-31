<?php
/*
* 分类页滑动banner相关action
*
*/
namespace common\actions\cate;

use Yii;
use common\components\AppAction;

class SliderBannerAction extends AppAction
{
	/**
	* 运行action
	*
	* @param array $params
	*  $params['categoryId'] int 分类ID
	*
	* @return string
	*/
	public function run($params)
	{
		//滚动广告
        $banners = Yii::$container->get('AdvertModel')->getAdvert('CATEGORY', 'BANNER-SLIDER', $categoryId);
        $banners = $banners['ret'] == 1 ? $banners['data'] : [];
		return $this->renderPartial(
									'cate/sliderBanner', 
									[
										'banners' => $banners
									]
								);
	}
}