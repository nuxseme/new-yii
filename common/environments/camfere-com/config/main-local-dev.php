<?php
/***********************++++++++++开发环境配置+++++++++*********************/
return [
    'components' => [
        'cacheCleaner' => [//缓存清理组件
            'cacheVersions' => [
                'vdvert' => 'V1.0.1',
                'categoryBg' => 'V1.0.1',
                'allCategories' => 'V1.0.1',
                'allCountries' => 'V1.0.1',
                'allCurrencies' => 'V1.0.1',
                'langPkg' => 'V1.0.1',
                'langList' => 'V1.0.1',
                'productDetails' => 'V1.0.1',
                'shippingPaymentOrWarranty' => 'V1.0.1',
                'detailHotEvent' => 'V1.0.1',
                'detailTopSellers' => 'V1.0.1',
                'reviews' => 'V1.0.1',
                'dailyDeals' => 'V1.0.1',
                'plugins' => 'V1.0.1',
                'dailyDeals' => 'V1.0.1',
                'alsoViewed' => 'V1.0.1',
                'user'   => 'V1.0.1',
                'footArticle' => 'V1.0.1',
                'articleDetails' => 'V1.0.1',
                'productsType' => 'V1.0.1',
                'cateMetaInfo' => 'V1.0.1',
                'cateProducts' => 'V1.0.1',  
                'channelTopsellersHome' => 'V1.0.1',   
                'channelTopsellers' => 'V1.0.1',   
                'channelNew' => 'V1.0.1',   
                'channelFreeshipping' => 'V1.0.1',   
                'channelDeals' => 'V1.0.1',   
                'channelPresale' => 'V1.0.1',   
                'channelClearance' => 'V1.0.1',
                
            ],
        ],
        'assetManager' => [//资源文件管理
            'bundles' => [
                'base' => [
                    'class' => 'common\components\AppAsset',
                    'js' => [
                                'js/jquery-1.9.1.min.js?V=1.0.0', 
                                'js/jquery.lazyload.js?V=1.0.0',
                                'js/JSlanguage.js?V=1.0.0',
                                'js/jquery.downCount.js?V=1.0.0',
                                'js/nortonseal.js?V=1.0.0',
                                'js/common.js?V=1.0.0',
                            ],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.camfere.com/camfere',
                ],
                'index' => [
                    'class' => 'common\components\AppAsset',
                    'css' => ['css/index.css?V=1.0.0'],
                    'js' => [
                        'js/scroll.js?V=1.0.0',
                        'js/raphael.js?V=1.0.0',
                        'js/index.js?V=1.0.0',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.camfere.com/camfere',
                ],
                'cate' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/category.css?V=1.0.0',
                    ],
                    'js' => [
                        'js/category.js?V=1.0.0',
                        'js/product.js?V=1.0.0',
                        'js/productImg.js?V=1.0.0',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.camfere.com/camfere',
                ],
                'detail' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/product.css?V=1.0.0',
                    ],
                    'js' => [
                        'js/product.js?V=1.0.2',
                        'js/productImg.js?V=1.0.0',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.camfere.com/camfere',
                ],
                'review' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/product.css?V=1.0.0',
                    ],
                    'js' => [
                        'js/jquery-1.9.1.min.js?V=1.0.0', 
                        'js/jquery.lazyload.js?V=1.0.0',
                        'js/JSlanguage.js?V=1.0.0',
                        'js/nortonseal.js?V=1.0.0',
                        'js/common.js?V=1.0.0',
                        'js/product.js?V=1.0.0',
                    ],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.camfere.com/camfere',
                ],
                'detail-special' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/style.css?V=1.0.0',
                    ],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'baseUrl' => 'http://staticuat.camfere.com/camfere',
                ],
                'account' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/public.css?V=1.0.0',
                        'css/accHome.css?V=1.0.0',
                    ],
                    'js' => [
                        'js/vip.js?V=1.0.0',
                        'js/upFile.js?V=1.0.0',
                        'js/jquery.form.js?V=1.0.0',
                        'js/birthday.min.js?V=1.0.0',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.camfere.com/camfere',
                ],
                'register' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/public.css?V=1.0.0',
                        'css/login.css?V=1.0.0',
                    ],
                    'js' => [
                        'js/login.js?V=1.0.0',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.camfere.com/camfere',
                ],
                'deals' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/common.css?V=1.0.0',
                        'css/deals.css?V=1.0.0',
                    ],
                    'js' => [
                        'js/deals_countdown.js?V=1.0.0',
                        'js/category.js?V=1.0.1',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.camfere.com/camfere',
                ],
                'newarrivals' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/common.css?V=1.0.0',
                        'css/new_arrivals.css?V=1.0.0',
                    ],
                    'js' => [
                        'js/category.js?V=1.0.1',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.camfere.com/camfere',
                ],
                'topsellers' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/common.css?V=1.0.0',
                        'css/top_sellers.css?V=1.0.0',
                    ],
                    'js' => [
                        'js/category.js?V=1.0.1',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.camfere.com/camfere',
                ],
                'error' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/style.css?V=1.0.0',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.camfere.com/camfere',
                ],
            ],
        ],
        'urlManager' => [//url模块管理
            'showScriptName' => false,
                'rules' => [
                    /*+++首页重写+++*/
                    'index.html' => 'default/index',
                    '/' => 'default/index',
                    /*+++首页重写+++*/

                    /*+++忘记密码 +++*/
                    '/change-password.html' =>'member/changepass',
                    /*+++忘记密码 +++*/

                    /*+++文章页重写+++*/
                    '/site-map.html' => 'cms/sitemap',
                    '<url:[a-zA-Z-&\s]+>.html' => 'cms/details',
                    /*+++文章页重写+++*/

                    /*+++thirdLogin重写+++*/
                    '/sign-facebook' =>  'login/facebook',
                    '/sign-google'   =>  'login/google',
                    '/sign-vk'       =>  'login/vk',
                    '/sign-twitter'  =>  'login/twitter',
                    /*+++thirdLogin重写+++*/

                    /*+++搜索页重写+++*/
                    '/search/<keyword:[a-zA-Z0-9-&\s\'\"%]+>.html' => 'search/index',
                    '/search/<keyword:[a-zA-Z0-9-&\s\'\"%]+>/<p:[\d]+>.html' => 'search/index',
                    /*+++搜索页重写+++*/

                    /*+++频道页重写+++*/
                    '/deals/' => 'channel/deals',
                    '/top-sellers/' => 'channel/topsellers',
                    '/top-sellers-list/' => 'channel/topsellers-list',
                    '/new-arrivals/' => 'channel/newarrivals',
                    '/clearance/' => 'channel/clearance',
                    '/deals/<p:[1-9]+>.html' => 'channel/deals',
                    '/top-sellers/<p:[1-9]+>.html' => 'channel/topsellers',
                    '/top-sellers-list/<p:[1-9]+>.html' => 'channel/topsellers-list',
                    '/new-arrivals/<p:[1-9]+>.html' => 'channel/newarrivals',
                    '/clearance/<p:[1-9]+>.html' => 'channel/clearance',
                    /*+++频道页重写+++*/

                    /*+++分类URL重写版本2+++*/
                    '/<cname:([a-z0-9]+-)+[a-z0-9]+>-<cid:[0-9]+>/' => 'cate/index',
                    '<cname:([a-z0-9]+-)+[a-z0-9]+>-<cid:[0-9]+>/<p:[1-9]+>.html' => 'cate/index',
                    '/<cname:[a-z0-9]+>-<cid:[0-9]+>/' => 'cate/index',
                    '<cname:[a-z0-9]+>-<cid:[0-9]+>/<p:[1-9]+>.html' => 'cate/index',
                    /*+++分类URL重写版本2+++*/
                    
                    /*+++商品URL重写版本二+++*/
                    '<cpath:p-[0-9a-zA-Z-]+>.html' => 'detail/index',
                    '<cpath:[a-z0-9]+-[0-9]+/p-[0-9a-zA-Z-]+>.html' => 'detail/index',
                    '<cpath:([a-z0-9]+-)+[a-z0-9]+-[0-9]+/p-[0-9a-zA-Z-]+>.html' => 'detail/index',
                    '<cpath:[a-z0-9]+-[0-9]+/p_[0-9a-zA-Z-]+>.html' => 'detail/index',
                    '<cpath:([a-z0-9]+-)+[a-z0-9]+-[0-9]+/p_[0-9a-zA-Z-]+>.html' => 'detail/index',
                    /*+++商品URL重写版本二+++*/
                ],
        ],
    ],
    'alias' => [//别名
        '@layout' => SYS_PATH . DOMAIN . DS . 'views' . DS .'layouts',
        '@static' => SYS_PATH . 'static' . DS . 'camfere',
    ],
];