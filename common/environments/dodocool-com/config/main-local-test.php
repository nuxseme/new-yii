<?php
/***********************++++++++++测试环境配置+++++++++*********************/
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
                'channelAllCates' => 'V1.0.1',
                'channelPpHotDeals' => 'V1.0.1',
                'driverProducts' => 'V1.0.1',
                'contactSubjects' => 'V1.0.1',
            ],
        ],
        'assetManager' => [//资源文件管理
            'bundles' => [
                'base' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/public.css?V=1.0.0'
                    ],
                    'js' => [
                                'js/jquery-1.9.1.js?V=1.0.0', 
                                'js/JSlanguage.js?V=1.0.0',
                                'js/common.js?V=1.0.0',
                                'js/main.js?V=1.0.0',
                            ],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.dodocool.com/dodocool',
                ],
                'index' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/index.css?V=1.0.0',
                    ],
                    'js' => [
                        'js/scroll.js?V=1.0.0',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.dodocool.com/dodocool',
                ],
                'cate' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/category.css?V=1.0.0',
                    ],
                    'js' => [
                        'js/scroll.js?V=1.0.0',
                        'js/product.js?V=1.0.0',
                        'js/category.js?V=1.0.0',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.dodocool.com/dodocool',
                ],
                'detail' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/product.css?V=1.0.0',
                    ],
                    'js' => [
                        'js/scroll.js?V=1.0.0',
                        'js/product.js?V=1.0.0',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.dodocool.com/dodocool',
                ],
                'superuser' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/superuser.css?V=1.0.0',
                    ],
                    'js' => [
                        'js/superuser.js?V=1.0.0',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.dodocool.com/dodocool',
                ],
                'superuserinfo' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/superUserInfo.css?V=1.0.0',
                    ],
                    'js' => [
                        'js/superuser.js?V=1.0.0',
                        'js/acount.js?V=1.0.0',
                        'js/scroll.js?V=1.0.0',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.dodocool.com/dodocool',
                ],
                'support' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/support.css?V=1.0.0',
                    ],
                    'js' => [
                        'js/scroll.js?V=1.0.0',
                        'js/support.js?V=1.0.0',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.dodocool.com/dodocool',
                ],
                'contact_service' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/contactservice.css?V=1.0.0',
                    ],
                    'js' => [
                        'js/contactservice.js?V=1.0.0',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.dodocool.com/dodocool',
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
                        'js/currency.js?V=1.0.0',
                        'js/nortonseal.js?V=1.0.0',
                        'js/common.js?V=1.0.0',
                        'js/product.js?V=1.0.0',
                    ],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.dodocool.com/dodocool',
                ],
                'detail-special' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/style.css?V=1.0.0',
                    ],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'baseUrl' => 'http://staticuat.dodocool.com/dodocool',
                ],
                'detail-order' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/order-detail.css?V=1.0.0',
                    ],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'depends' => ['base'],
                    'baseUrl' => 'http://staticuat.dodocool.com/dodocool',
                ],
                'account' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/acountHome.css?V=1.0.0',
                    ],
                    'js' => [
                        'js/scroll.js?V=1.0.0',
                        'js/profile.js?V=1.0.0',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.dodocool.com/dodocool',
                ],
                 'profile' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/editUserInfo.css?V=1.0.0',
                    ],
                    'js' => [
                        'js/scroll.js?V=1.0.0',
                        'js/calendar.js?V=1.0.0',
                        'js/acount.js?V=1.0.0',
                        'js/updata_photo.js?V=1.0.0',
                        
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                   'baseUrl' => 'http://staticuat.dodocool.com/dodocool',
                ],
                'register' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/login.css?V=1.0.0',
                    ],
                    'js' => [
                        'js/login.js?V=1.0.0',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.dodocool.com/dodocool',
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
                    'baseUrl' => 'http://staticuat.dodocool.com/dodocool',
                ],
                'newarrivals' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/newRlease.css?V=1.0.0',
                    ],
                    'js' => [
                        'js/scroll.js?V=1.0.0',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.dodocool.com/dodocool',
                ],
                'topsellers' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/newRlease.css?V=1.0.0',
                    ],
                    'js' => [
                       'js/scroll.js?V=1.0.0',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.dodocool.com/dodocool',
                ],
                'hotdeals' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/hotdeals.css?V=1.0.0',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.dodocool.com/dodocool',
                ],
                'forgetpass' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/findpassword.css?V=1.0.0',
                    ],
                    'js' => [
                        'js/login.js?V=1.0.0',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.dodocool.com/dodocool',
                ],
                'findPassword' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/findpassword.css?V=1.0.0',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.dodocool.com/dodocool',
                ],
                'changePassword' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/acchangepsw.css?V=1.0.0',
                    ],
                    'js' => [
                        'js/scroll.js?V=1.0.0',
                        'js/changepwd.js?V=1.0.0',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.dodocool.com/dodocool',
                ],
                'error' => [
                    'class' => 'common\components\AppAsset',
                    'css' => [
                        'css/style.css?V=1.0.0',
                    ],
                    'depends' => ['base'],
                    'cssOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'jsOptions' => ['position' => \yii\web\View::POS_END],
                    'baseUrl' => 'http://staticuat.dodocool.com/dodocool',
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
                    '/change-password.html' =>'member/forgetpass',
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
                    '/deals/' => 'channel/hotdeals',
                    '/top-sellers/' => 'channel/topsellers',
                    '/new-arrivals/' => 'channel/newarrivals',
                    /*+++频道页重写+++*/

                    /*+++superuse页面重写+++*/
                    '/superuser/' => 'superuser/index',
                    /*+++superuse页面重写+++*/

                    /*+++support页面重写+++*/
                    '/support/' => 'support/index',
                    '/contact/' => 'support/contactservice',
                    /*+++support页面重写+++*/

                    /*+++老的分类URL重写+++*/
                    '<cpath:[^-]+(-[a-zA-Z0-9]+){0,}>' => 'cate/index',
                    '<cpath:-[^-]+(-[a-zA-Z0-9]+){0,}>' => 'cate/index',
                    /*+++老的分类URL重写+++*/

                    /*+++分类URL重写版本2+++*/
                    '/<cname:(-[^0-9]+)+>-<cid:[0-9]+>/' => 'cate/index',
                    '/<cname:(-[^0-9]+)+>-<cid:[0-9]+>/<p:[1-9]+>.html' => 'cate/index',
                    '/<cname:([a-z0-9]+-)+[a-z0-9]+>-<cid:[0-9]+>/' => 'cate/index',
                    '<cname:([a-z0-9]+-)+[a-z0-9]+>-<cid:[0-9]+>/<p:[1-9]+>.html' => 'cate/index',
                    '/<cname:[a-z0-9]+>-<cid:[0-9]+>/' => 'cate/index',
                    '<cname:[a-z0-9]+>-<cid:[0-9]+>/<p:[1-9]+>.html' => 'cate/index',
                    /*+++分类URL重写版本2+++*/
                    
                    /*+++老的商品URL+++*/
                    '<cpath:[^/]+>.html' => 'detail/index',
                    /*+++老的商品URL+++*/

                    /*+++商品URL重写版本二+++*/
                    '<cpath:p-[0-9a-zA-Z-]+>.html' => 'detail/index',
                    '<cpath:[a-z0-9]+-[0-9]+/p-[0-9a-zA-Z-]+>.html' => 'detail/index',
                    '<cpath:([a-z0-9]+-)+[a-z0-9]+-[0-9]+/p-[0-9a-zA-Z-]+>.html' => 'detail/index',
                    '<cpath:[a-z0-9]+-[0-9]+/p_[0-9a-zA-Z-]+>.html' => 'detail/index',
                    '<cpath:([a-z0-9]+-)+[a-z0-9]+-[0-9]+/p_[0-9a-zA-Z-]+>.html' => 'detail/index',
                    /*+++商品URL重写版本二+++*/
                ],
        ],
        'errorHandler' => [//错误处理
            'errorAction' => 'site/error',
        ],
    ],
    'alias' => [//别名
        '@layout' => SYS_PATH . DOMAIN . DS . 'views' . DS .'layouts',
        '@static' => SYS_PATH . 'static' . DS . 'dodocool',
    ],
];