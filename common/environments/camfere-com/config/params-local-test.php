<?php
/***********************++++++++++测试环境配置+++++++++*********************/
return [
	'cookDomain' => 'camfere.com',
	'website' => 14,
	'client'  => 20,
	'page'    =>1,
	'pageSize'=>10,
	'imagesCdnUrl' => 'http://img.camfere.com',
	'imagesHasClip' => false, //图片是否有裁剪 true 会在域名中加入clip
	'cartHost'   => 'http://cartuat.camfere.com',
	'cartCookiesName' => 'plist',
	'staticRoute'     =>'http://staticuat.camfere.com/camfere',
	'copyRight' => 'Copyright © 2016 camfere INC. All Rights Reserved.',
	'langPrefix' => 'camfere', //语言前缀
	'productListImgHeight' => 220, //商品列表页图片高度
	'productListImgWidth' => 220, //商品列表页图片宽度
	'productDetailMediumImgHeight' =>  500, //商品详情页放大镜中等图片高度
	'productDetailMediumImgWidth' =>  500, //商品详情页放大镜中等图片宽度
	'productDetailSmallImgHeight' =>  60, //商品详情页放大镜小图高度
	'productDetailSmallImgWidth' =>  60, //商品详情页放大镜小图宽度
	'productDetailLargeImgHeight' =>  2000, //商品详情页放大镜图高度
	'productDetailLargeImgWidth' =>  2000, //商品详情页放大镜图宽度
	'productReviewImgHeight' => 377, //评论列表图片高度
	'productReviewImgWidth' => 377, //评论列表图片宽度
	'cartImgWidth' => 60,//购物车图片宽度
	'cartImgHeight' => 60,//购物车图片高度
	'homeDailyDealsImgHeight' => 377,//首页daily deals 图片高度
	'homeDailyDealsImgWidth' => 377,//首页daily deals 图片宽度
];