<?php
/*
* 首页 右侧 banner 模块相关Action
*
*/
namespace common\actions\index;

use Yii;
use common\components\AppAction;

class RightBannerAction extends AppAction
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
		$banners = $adModel->getAdvert('HOME', 'BANNER-RIGHT-TOPIC');
		$banners = $banners['ret'] == 1 ? $banners['data'] : [];
		return $this->renderPartial(
									'rightBanners', 
									['banners' => $banners]
								);
	}
}