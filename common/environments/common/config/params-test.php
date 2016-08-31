<?php
return [
	/***********************++++++++++测试环境配置+++++++++*********************/
	'warehouse' => [
		'CN', 
		'GB', 
		'IT', 
		'DE', 
		'FR', 
		'FR-X51', 
		'FR-X52', 
		'FR-X53', 
		'ES', 
		'AU', 
		'US'
	],
	'warehouseIdCode'=>[
		'1' 	=> 'CN',
		'2' 	=> 'US',
		'3' 	=> 'GB',
		'4' 	=> 'IT',
		'5' 	=> 'DE',
		'6' 	=> 'FR',
		'7' 	=> 'AU',
		'9' 	=> 'FR-X51',
		'10' 	=> 'FR-X52',
		'11' 	=> 'FR-X53',
		'12' 	=> 'ES'
	],
	'warehouseFullName' => [
		'CN' => 'chinaWarehouse', 
		'GB' => 'GB Warehouse', 
		'IT' => 'IT Warehouse', 
		'DE' => 'DE Warehouse', 
		'US' => 'USA Warehouse', 
		'FR' => 'FR Warehouse', 
		'AU' => 'AU Warehouse'
	],
	'token' => 'TT_TOKEN',
	'uuid' => 'TT_UUID',
	'code' => 'TT_CODE',
	'device' => 'TT_DEVICE',
	'coun' => 'TT_COUN',
	'defaultCoun' => 'US',
	'shipto' => 'TT_SHIPTO',
	'cookExpire' => 3600,
	'cookDomain' => 'tomtop.com',
	'cookPath' => '/',
	'langToCountry' => [
		'en'    => 'United States',
		'ru'    => 'Russia',
		'es'    => 'Spain',
		'de'    => 'German',
		'fr'    => 'France',
		'it'    => 'Italy',
		'jp'    => 'Japan',
	],
	'defaultCountry' => 'en',

	//网站支持的所有货币
	'localCurrency' => [
		'USD',
		'EUR',
		'RUB',
		'JPY',
		'GBP',
		'BRL',
		'AUD',
		'PLN',
		'SEK',
		'CHF',
		'CAD',
		'DKK',
		'INR',
		'TRY',
		'MXN',
		'NOK',
		'CZK'
	],

	//国家对应的货币
	'currency' => [
		'en' => 'USD',
		'es' => 'EUR',
		'ru' => 'RUB',
		'de' => 'EUR',
		'fr' => 'EUR',
		'it' => 'EUR',
		'jp' => 'JPY',
		'pt' => 'EUR',
	],
	//SIZE属性排序设置
    'attrSizeSort' => ['4XL', 'XXXXL', '3XL', 'XXXL', '2XL', 'XXL', 'XL', 'L', 'M', 'S', 'XS', 'XXS'],
	'webDefaultLang' => ['en', 'es', 'ru', 'de', 'fr', 'it', 'jp', 'pt'],//网站默认语言排序
	'langIds' => [
					'en' => 1, 
					'es' => 2, 
					'ru' => 3, 
					'de' => 4, 
					'fr' => 5, 
					'it' => 6, 
					'jp' => 7, 
					'pt' => 8
    			],
    'copyRight' => 'Copyright © 2016 TOMTOP INC. All Rights Reserved.',
    'productListImgHeight' => 228, //商品列表页图片高度
	'productListImgWidth' => 228, //商品列表页图片宽度
	'productDetailMediumImgHeight' =>  500, //商品详情页放大镜中等图片高度
	'productDetailMediumImgWidth' =>  500, //商品详情页放大镜中等图片宽度
	'productDetailSmallImgHeight' =>  72, //商品详情页放大镜小图高度
	'productDetailSmallImgWidth' =>  72, //商品详情页放大镜小图宽度
	'productDetailLargeImgHeight' =>  2000, //商品详情页放大镜图高度
	'productDetailLargeImgWidth' =>  2000, //商品详情页放大镜图宽度
	'productReviewImgHeight' => 377, //评论列表图片高度
	'productReviewImgWidth' => 377, //评论列表图片宽度
	'cartImgWidth' => 74,//购物车图片宽度
	'cartImgHeight' => 101,//购物车图片高度
	'homeDailyDealsImgHeight' => 377,//首页daily deals 图片高度
	'homeDailyDealsImgWidth' => 377,//首页daily deals 图片宽度
	'awsAccessKey' => 'AKIAJA5WRIZRQ3VB4GKQ',//亚马逊上传key
	'awsSecretKey' => 'C+JB7PnZsyUNFF9HLJYuBhjqlsiDtc/bnhdEoqY8',//亚马逊上传key
	'shippingToken' => '077b075f-c0b4-4ffb-bb07-5fc0b4fffb8c',//shipping接口token
	'warehouseCodeToCountry' => [//仓库代码对应国家
		'CN'	=> 'China',
		'US'	=> 'United States',
		'GB'	=> 'United Kingdom',
		'IT'	=> 'Italy',
		'DE'	=> 'Germany',
		'FR'	=> 'France',
		'X51'	=> 'France',
		'X52'	=> 'France',
		'X53'	=> 'France',
		'AU'	=> 'Australia',
		'ES'	=> 'Spain',
	],
	'i18nDefaultCategory' => 'site', //翻译组件默认分类 即 TTHelper::getSiteLang() 使用的翻译分类
];
