<?php
/*
* 首页 左侧滑动banner 模块相关Action
*
*/
namespace common\actions\index;

use Yii;
use common\components\AppAction;

class SliderBannerAction extends AppAction
{
	/**
	* 运行action
	*
	* @param array $params
	* @return string
	*/
	public function run($params = array())
	{
		$adModel = Yii::$container->get('AdvertModel');
		$banners = $adModel->getAdvert('HOME', 'BANNER-SLIDER');
		$banners = $banners['ret'] == 1 ? $banners['data'] : [];
		return $this->renderPartial(
									'sliderBanners', 
									['banners' => $banners]
								);
	}
}