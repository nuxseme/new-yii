<?php
/**
* @author hyd
* @date 2016-08-15 10:59:12
* @todo 频道页控制器
*/

namespace app\controllers;

use Yii;
use common\models\Channel;

class ChannelController  extends BaseController
{
	/**
	 * [actionNewarrivals 新品发布]
	 * @return [mixed] 
	 */
	public function actionNewarrivals(){

		$channel = new Channel;
		$params = $this->getUrlParmas();
		$products = $channel->getChannelProducts($params, 'new');
		$allCates = empty($params['cpath']) ? $products['data']['aggsMap']['mutil.productTypes.productTypeId'] : $channel->getChannelAllCates('new')['data'];
		return $this->render(
				'newArrivals',
				[
					//面包屑导航
					'breadCrumbs' => $this->runAppAction(
						'\common\actions\ppchannel\BreadCrumbsAction',
						[['channelName' => 'newarrivals']]
					),

					//顶部二级分类
					'topFiltering' => $this->runAppAction(
						'\common\actions\ppchannel\TopFilteringAction',
						[
							[
								'allCates' => $allCates,
								'route' => 'channel/newarrivals'
							]
						]
					),

					//商品列表
					'products' => $this->runAppAction(
						'\common\actions\ppchannel\ProductsListAction',
						[['products'=>$products['data']['pblist']]]
					),
				]
			);
	}

	/**
	 * [actionTopsellers 频道 top sellers]
	 * @return   [mixed]
	 */
	public function actionTopsellers()
	{
		$channel = new Channel;
		$params = $this->getUrlParmas();
		$products = $channel->getChannelProducts($params, 'topsellers');
		$allCates = empty($params['cpath']) ? $products['data']['aggsMap']['mutil.productTypes.productTypeId'] : $channel->getChannelAllCates('topsellers')['data'];
		return $this->render(
				'topSellers',
				[
					//面包屑导航
					'breadCrumbs' => $this->runAppAction(
						'\common\actions\ppchannel\BreadCrumbsAction',
						[['channelName' => 'topsellers']]
						),
					
					//顶部二级分类
					'topFiltering' => $this->runAppAction(
						'\common\actions\ppchannel\TopFilteringAction',
						[
							[
								'allCates' => $allCates,
								'route' => 'channel/newarrivals'
							]
						]
					),

					//商品列表区
					'products' => $this->runAppAction(
						'\common\actions\ppchannel\ProductsListAction',
						[['products'=>$products['data']['pblist']]]
					),	
				]
			);
	}

	/**
	 * [actionHotdeals 频道 hot deals]
	 * @return   [mixed]
	 */
	public function actionHotdeals(){

		$channel = new Channel;
		$re = $channel->getPpHotDeals();
		$products = [];
		if($re['ret'] == 1)
		{
			foreach ($re['data'] as $each) 
			{
				$country = trim($each['country']);
				$each['country'] = $country;
				!array_key_exists($country, $products) && $products[$country] = [];
				$products[$country][] = $each;
			}
		}
		return $this->render(
			'hotDeals',
			[
				'products' => $products
			]
		);
	}

	/**
	 * [获取URL参数]
	 * @return   [array]
	 */
	public function getUrlParmas()
	{
		$params = array();
    	$params['cpath']     		= Yii::$app->request->get("cpath");
    	$params['page'] = intval(Yii::$app->request->get("p"));
		$params['page'] < 1 && $params['page'] = 1;
    	$params['size']      		= 60;
    	return $params;
	}
	
}
