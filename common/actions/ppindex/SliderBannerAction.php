<?php
/**
* @author hyd
* @date 2016-08-13 17:59:06
* @todo 首页滑动banner
*/

namespace common\actions\ppindex;

use Yii;
use common\components\AppAction;

class SliderBannerAction extends AppAction
{
	/**
	* 运行action
	* @return string
	*/
	public function run()
	{
		$banners = Yii::$container->get('AdvertModel')->getAdvert('HOME', 'BANNER-SLIDER');
		$banners = $banners['ret'] == 1 ? $banners['data'] : [];
		return $this->renderPartial(
									'ppdefault/sliderBanners', 
									['banners' => $banners]
								);
	}
}