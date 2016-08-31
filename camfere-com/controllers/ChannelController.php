<?php
namespace app\controllers;

use Yii;
use common\helpers\TTPageHelper;

/**
 * 频道页控制器
 */
class ChannelController  extends BaseController
{
	public function actions()
	{
		return [
			'newarrivals' => [//频道页——New Arrivals新品
				'class' => 'common\actions\channel\CommonChannelAction',
				'channelName' => 'new',
				'seoMeta' => [
					'title' => 'New Arrivals | Camfere.com',
					'description' => 'Shop for New Action Cameras, On Camera Flashes, Digital Camcorders, Digital Photo Frames, Tripods, Studio Equipment at Bargain Prices.',
					'keywords' => 'Shop for New Action Cameras, On Camera Flashes, Digital Camcorders, Digital Photo Frames, Tripods, Studio Equipment at Bargain Prices.'
				],
			],
			'clearance' => [//频道页——Clearance清仓商品
				'class' => 'common\actions\channel\CommonChannelAction',
				'channelName' => 'clearance',
				'seoMeta' => [
					'title' => 'Photography Accessories Clearance | Camfere.com',
					'description' => 'Best action camera, 360 panorama camera, digital camcorders, tripod, monopod, flashes, studio equipment, digital photo frames and more photography accessories Clearance Deals',
					'keywords' => 'Best action camera, 360 panorama camera, digital camcorders, tripod, monopod, flashes, studio equipment, digital photo frames and more photography accessories Clearance Deals'
				],
			],
			'deals' => [//频道页——Clearance清仓商品
				'class' => 'common\actions\channel\DealsAction',
				'seoMeta' => [
					'title' => 'Photography Accessories Deals | Camfere.com',
					'description' => 'Best action camera, 360 panorama camera, digital camcorders, tripod, monopod, flashes, studio equipment, digital photo frames and more photography accessories at Camfere.com',
					'keywords' => 'Best action camera, 360 panorama camera, digital camcorders, tripod, monopod, flashes, studio equipment, digital photo frames and more photography accessories at Camfere.com'
				],
			],
			'topsellers' => [//频道页——Top Sellers热卖商品首页
				'class' => 'common\actions\channel\TopsellersAction',
				'seoMeta' => [
					'title' => 'Top Selling Photography Accessories | Camfere.com',
					'description' => 'Shop Top Selling Photography Accessories at Bargain Price',
					'keywords' => 'Shop Top Selling Photography Accessories at Bargain Price'
				],
			],
			'topsellers-list' => [//频道页——Top Sellers热卖商品首页
				'class' => 'common\actions\channel\TopsellersListAction',
				'seoMeta' => [
					'title' => 'Top Selling Photography Accessories | Camfere.com',
					'description' => 'Shop Top Selling Photography Accessories at Bargain Price',
					'keywords' => 'Shop Top Selling Photography Accessories at Bargain Price'
				],
			]
		];
	}
}
