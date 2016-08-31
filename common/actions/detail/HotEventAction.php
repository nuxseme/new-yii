<?php
/*
* 详情页hotEvent相关action
*
*/
namespace common\actions\detail;

use Yii;
use common\components\AppAction;

class HotEventAction extends AppAction
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
		return $this->renderPartial(
									'detail/hotEvent',
									[
                                        'hotEvents' => $this->getHotEvents(),
                                    ]
								);
	}

	/**
     * 详情页获取Hot Event
     * 
     * @return array
     */
	public function getHotEvents()
	{
		$adModel = Yii::$container->get('AdvertModel');
		$banners = $adModel->getAdvert('HOME', 'BANNER-SLIDER');
		return $banners['ret'] == 1 ? $banners['data'] : [];
//        $re = Yii::$container->get('ProductModel')->getHotEvent();
//        return $re['ret'] == 1 ? $re['data'] : [];
	}
}
