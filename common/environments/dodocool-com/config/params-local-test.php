<?php
/***********************++++++++++测试环境配置+++++++++*********************/
return [
	'cookDomain' => 'dodocool.com',
	'website' => 2,
	'client'  => 9,
	'page'    =>1,
	'pageSize'=>10,
	'imagesCdnUrl' => 'http://img.dodocool.com',
	'imagesHasClip' => false, //图片是否有裁剪 true 会在域名中加入clip
	'cartHost'   => 'https://cartuat.dodocool.com',
	'cartCookiesName' => 'plist',
	'staticRoute'     =>'http://staticuat.dodocool.com/dodocool',
	'copyRight' => 'Copyright © 2016 dodocool INC. All Rights Reserved.',
	'langPrefix' => 'dodocool', //语言前缀
	'productListImgHeight' => 265, //商品列表页图片高度
	'productListImgWidth' => 265, //商品列表页图片宽度
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