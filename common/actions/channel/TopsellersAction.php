<?php
/*
* 频道页top sellers相关action
*
*/
namespace common\actions\channel;

use Yii;
use common\components\AppAction;
use common\models\Channel;

class TopsellersAction extends AppAction
{
	/**
    * @var array $seoMeta seo信息
    */
    public $seoMeta = [
        'title' => '',
        'description' => '',
        'keywords' => ''
    ];

	/**
	* @var Channel
	*/
	protected $channelModel;
	
	/**
	* 获取model
	*
	* @return Channel
	*/
	protected function getChannelModel()
	{
		if($this->channelModel === null)
		{
			$this->channelModel = new Channel;
		}
		return $this->channelModel;
	}

	/**
	* 运行action
	*
	* @param array $params
	* $params['channelModel']
	*
	* @return string
	*/
	public function run($params = [])
	{
		$channelModel = $this->getChannelModel();
		$re = $channelModel->getChannelProducts($params, 'topsellers/home');
		$categoryToProduct = [];
		if($re['ret'] == 1)
		{
			$categoryToProduct = $re['data'];
		}
		$whatHot = Yii::$container->get('AdvertModel')->getAdvert('HOME', 'BANNER-RIGHT-TOPIC');
		$whatHot = $whatHot['ret'] == 1 ? $whatHot['data'] : [];
		$this->controller->seoMeta($this->seoMeta);
    	return $this->controller->render(
				    						'topSellers',
				    						[
				    							'categoryToProduct'  =>   $categoryToProduct,
				    							'leftFiltering' => $this->controller->runAppAction(
				    								'common\actions\channel\TopLeftFilteringAction',
				    								[
				    									[
					    									'categoryToProduct' => $categoryToProduct,
					    									'whatHot' => $whatHot,
				    									]
				    								]
				    							)
				    						]
			    						);
	}
}