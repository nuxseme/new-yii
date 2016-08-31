<?php
/*
* 分类页面 banner
*
*/
namespace common\actions\ppcate;

use Yii;
use common\components\AppAction;

class BannerAction extends AppAction
{
	/**
	* 运行action
	*
	* @param array $params
	* 			   ['cpath'] string 
	* 			   ['depotName'] string
	* 			   ['page'] int
 	*			   ['size'] int
	*
	* @return string
	*/
	public function run()
	{
		$adModel = Yii::$container->get('AdvertModel');
		$banners = $adModel->getAdvert('HOME', 'BANNER-SLIDER');
		$banners = $banners['ret'] == 1 ? $banners['data'] : [];
		return $this->renderPartial(
									'ppcate/banners', 
									['banners' => $banners]
								);
	}
}