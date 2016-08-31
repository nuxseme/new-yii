<?php
/*
* 频道页top sellers相关action
*
*/
namespace common\actions\channel;

use Yii;
use common\components\AppAction;
use common\models\Channel;
use common\helpers\TTPageHelper;

class TopsellersListAction extends AppAction
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
		$params = array();
		$params['cpath'] = Yii::$app->request->get("cpath");
		$params['page'] = intval(Yii::$app->request->get("page"));
		$params['page'] < 1 && $params['page'] = 1;
    	$params['size'] = 40;


		$channelModel = $this->getChannelModel();

		$productList = [];
		$pages = null;
		$re = $channelModel->getChannelProducts($params, 'topsellers');
    	if($re['ret'] == 1)
    	{ 
	    	$productList = $re['data'];
	    	$pages = new TTPageHelper($productList['page']['totalRecord'], $params['size'], $params['page']); 
    	}

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
				    						'topSellersList',
				    						[
				    							'productList'  =>   $productList['pblist'],
				    							'pages' => $pages,
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