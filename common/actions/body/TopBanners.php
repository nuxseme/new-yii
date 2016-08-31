<?php
/*
* 头部banners相关action
*
*/
namespace common\actions\body;

use Yii;
use common\components\AppAction;

class TopBannersAction extends AppAction
{
	/**
	* 运行action
	*
	* @param array $params
	*
	* @return string
	*/
	public function run($params = [])
	{
		$banners = Yii::$container->get('AdvertModel')->getAdvert('HOME','BANNER-TOP');
		$banners = $banners['ret'] == 1 ? $banners['data'] : [];
		return $this->renderPartial(
									'//layouts/topBanners', 
									[
										'banners' => $banners
									]
								);
	}
}