<?php
/*
* 首页 底部广告位
*
*/
namespace common\actions\ppindex;

use Yii;
use common\components\AppAction;

class DownBannerAction extends AppAction
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
		$banners = $adModel->getAdvert('HOME', 'BANNER-MIDDLE-TOPIC');
		$banners = $banners['ret'] == 1 ? $banners['data'] : [];
		return $this->renderPartial(
									'ppdefault/downBanner', 
									['banners' => $banners]
								);
	}
}