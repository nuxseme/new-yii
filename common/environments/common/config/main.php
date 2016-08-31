<?php
/***********************++++++++++生产环境配置+++++++++*********************/
return [
    'id' => DOMAIN,
    'basePath' => SYS_PATH . DOMAIN,
    'vendorPath' => SYS_VENDOR_PATH,
    'runtimePath' => SYS_RUNTIME_PATH,
    'controllerNamespace' => 'app\controllers',
    'bootstrap' => [//启动阶段加载的组件
        'plugin',
        'log',
        'diBox',
    ],
    'components' => [
        'cacheCleaner' => [//缓存清理组件
            'class' => 'common\components\ComCacheCleaner',
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
        'diBox' => [//依赖注入容器管理
            'class' => 'common\components\ComDiBox',
            'box' => [
                'CountryModel' => [
                    'def' => [
                        'class' => 'common\models\Country',
                    ],  
                ],
                'CurrencyModel' => [
                    'def' => [
                        'class' => 'common\models\Currency',
                    ],
                ],
                'LangModel' => [
                    'def' => ['class' => 'common\models\Lang'],
                ],
                'TTHelper' => [
                    'def' => ['class' => 'common\helpers\TTHelper'],
                ],
                'AdvertModel' => [
                    'def' => ['class' => 'common\models\Advert'],
                ],
                'CateModel' => [
                    'def' => ['class' => 'common\models\Category'],
                ],
                'ProductModel' => [
                    'def' => ['class' => 'common\models\Product'],
                ],
            ],
        ],
        'plugin' => [//插件管理
            'class' => 'common\components\ComPlugin',
            'lists' => [
                            'facebookLogin' => [
                                        'available' => 'camfere.com', 
                                        'sort' => 0
                                    ],
                            'googleLogin' => [
                                        'available' => 'camfere.com',
                                        'sort' => 1
                                    ],

                        ],
        ],
        'urlManager' => [//url模块管理
            'class' => 'common\components\ComUrlManager',
            'enablePrettyUrl' => true,
            'ruleConfig' => ['class' => 'common\components\AppUrlRule'],
            'rules' => [
                '/' => 'default/index',
            ],
        ],
        'assetManager' => [//资源文件管理
            'bundles' => [
            ],
        ],
        'reqApi' => [//接口管理
            'class' => 'common\components\ComApi',
            'sites' => [//API站点
                'baseApi' => ['host' => 'http://base.api.tomtop.com'], 
                'memberApi' => ['host' => 'http://member.api.tomtop.com'], 
                'productApi' => ['host' => 'http://product.api.tomtop.com'],
                'loyaltyApi' => ['host' => 'http://loyalty.api.tomtop.com'],
                'cartApi' => ['host' => 'http://cart.tomtop.com'],
                'shippingApi' => ['host' => 'http://logistics.api.tomtop.com'],
                'advertApi' => ['host' => 'http://advert.api.tomtop.com'],
                'ttApi' => ['host' => 'http://www.tomtop.com'] 
            ],
            'apis' => [//各种API
                //baseApi
                'getCountries' => [//获取国家接口
                    'url' => '{#baseApi#}/base/country/v1',
                ],
                'getCurrencies' => [//获取货币接口
                    'url' => '{#baseApi#}/base/currency/v1',
                ],
                'getLangPkg' => [//获取语言包接口
                    'url' => '{#baseApi#}/base/resource/v1/map',
                ],
                'getLangList' => [//获取语言列表接口
                    'url' => '{#baseApi#}/base/language/v1',
                ],
                'getShape' => [//获取图片尺寸接口
                    'url' => '{#baseApi#}/base/shape/v1/map',
                ],
                'getSystemTime' => [//获取系统时间接口
                    'url' => '{#baseApi#}/base/systemTime/v1',
                ],
                'getFootArticle' => [//获取首页底部文章列表
                    'url' => '{#baseApi#}/base/cms/v1/map',
                ],
                'getArticleDetails' => [//获取首页底部文章列表
                    'url' => '{#baseApi#}/base/cms/v1/deails',
                ],

                //productApi
                'getListing' => [//获取Listing 信息
                    'url' => '{#productApi#}/ic/v2/products/{listingId}',
                ],
                'getProductsByType' => [//根据类型获取商品列表接口
                    'url' => '{#productApi#}/ic/v3/layout/module/contents',
                ],
                'getCategories' => [//获取所有分类接口
                    'url' => '{#productApi#}/ic/v1/categories',
                ],
                'getCategoryMate' => [//获取分类mate接口
                    'url' => '{#productApi#}/ic/v1/categories/{cateId}',
                ],
                'getProducts' => [//获取商品接口
                    'url' => '{#productApi#}/ic/v3/product/search/category',
                ],
                'addProCollect' => [//增加产品收藏
                    'url' => '{#productApi#}/ic/v1/product/collect/add',
                ],
                'getProCollectList' => [//获取用户产品收藏列表
                    'url' => '{#productApi#}/ic/v1/user/collect',
                ],
                'getCollectIdLists' => [//收藏产品的listingId列表
                    'url' => '{#productApi#}/ic/v1/collect/list',
                ],
                'getBreadCrumbs' => [//获取面包屑接口
                    'url' => '{#productApi#}/ic/v1/bread/{id}',
                ],
                'getProductDetails' => [//获取商品详情接口
                    'url' => '{#productApi#}/ic/v3/product/base',
                ],
                'getProductExplain' => [//获取商品相关描述
                    'url' => '{#productApi#}/ic/v1/product/explain/{type}',
                ],
                'getProductTopic' => [//获取商品相关主题活动
                    'url' => '{#productApi#}/ic/v1/product/topic',
                ],
                'getProductHot' => [//获取热门商品接口
                    'url' => '{#productApi#}/ic/v1/product/hot',
                ],
                'getReview' => [//获取评论详情接口
                    'url' => '{#productApi#}/ic/v1/product/review/{listingId}',
                ],
                'getReviewList' => [//获取评论列表接口
                    'url' => '{#productApi#}/ic/v1/product/review/list',
                ],
                'getDailyDeals' => [//获取Daily Deals接口
                    'url' => '{#productApi#}/ic/v2/home/dailyDeal',
                ],
                'getProductPrice' => [//获取商品价格接口
                    'url' => '{#productApi#}/ic/v1/product/price/{listingId}',
                ],
                'getFavoritesNumber' => [//获取商品收藏接口
                    'url' => '{#productApi#}/ic/v1/product/collect/{listingId}',
                ],
                'getAlsoBought' => [//获取通常购买的商品推荐接口
                    'url' => '{#productApi#}/ic/v3/product/alsoBought',
                ],
                'addWholesaleInquiry' => [//添加Wholesale Inquiry接口
                    'url' => '{#productApi#}/ic/v1/product/wholesaleInquiry',
                ],
                'addProductDropship' => [//添加产品收藏接口
                    'url' => '{#productApi#}/ic/v1/product/dropship/add',
                ],
                'addWholeSaleProduct' => [//添加商品WholeSaleProduct接口
                    'url' => '{#productApi#}/ic/v1/product/wholesale/add',
                ],
                'getViewHistory' => [//获取商品浏览记录接口
                    'url' => '{#productApi#}/ic/v2/products',
                ],
                'getAlsoViewed' => [//详情页通常浏览的商品推荐接口
                    'url' => '{#productApi#}/ic/v3/product/alsoViewed',
                ],
                'getProductsByKeyword' => [//通过关键字获取商品接口
                    'url' => '{#productApi#}/ic/v3/product/search/keyword/{keyword}',
                ],
                'getShoppingCart'=>[//获取购物车基本信息
                    'url' => '{#productApi#}/ic/v2/product/shoppingCart',
                ],
                'getHashCode'=>[//获取购物车hashCode代码
                    'url' => '{#productApi#}/ic/v1/hashcode/{listingId}',
                ],
                'getYouMayLike'=>[//获取你可能喜欢的商品
                    'url' => '{#productApi#}/ic/v3/product/youMayLike',
                ],
                'getProductReviews'=>[//获取商品评论接口
                    'url' => '{#productApi#}/ic/v1/product/review/{listingId}',
                ],
                'getRecProducts'=>[//获取推荐商品数据接口
                    'url' => '{#productApi#}/ic/v1/product/hotsellers',
                ],
                'getPromotionDeals'=>[//获取促销deals商品接口
                    'url' => '{#productApi#}/ic/v1/product/deals',
                ],
                'getChannelProducts'=>[//获取频道页商品列表
                    'url' => '{#productApi#}/ic/v1/product/{channel}',
                ],
                'getDealsCategory'=>[//获取频道页商品列表
                    'url' => '{#productApi#}/ic/v1/product/show/category',
                ],
                'newArrivalsReleaseDate'=>[//新品频道页聚合时间属性
                    'url' => '{#productApi#}/ic/v1/product/new/agg',
                ],
                'getReviewAndStart' => [//获取评论和星级
                    'url' => '{#productApi#}/ic/v1/product/review/start',
                ],
                //memberApi
                'getUserAddrs' => [//获取用户地址列表
                    'url' => '{#memberApi#}/member/v1/billaddress/{uuid}',
                ],
                'userRegister' => [//用户注册接口
                    'url' => '{#memberApi#}/member/v2/register',
                ],
                'userLogin' => [//用户登录接口
                    'url' => '{#memberApi#}/member/v2/login',
                ],
                'googleSign'=>[//获取谷歌用户登录信息接口
                    'url' => '{#memberApi#}/other/google',
                ],
                'faceBookSign' => [//获取FaceBook用户登录信息接口
                    'url' => '{#memberApi#}/other/facebook',
                ],
                'vkSign' => [//获取Vk用户登录信息接口
                    'url' => '{#memberApi#}/other/vk',
                ],
                'twitterSign' => [//获取twitter用户登录信息接口
                    'url' => '{#memberApi#}/other/twitter',
                ],
                'twitterUrl' => [//获取twitter用户登录Url
                    'url' => '{#memberApi#}/other/v1/signIn/twitter',
                ],
                'forgetPassword' => [//忘记密码(发送邮件)接口
                    'url' => '{#memberApi#}/findpwd/v1/send',
                ],
                'changePassword' => [//忘记密码(修改密码)接口
                    'url' => '{#memberApi#}/findpwd/v1/alert',
                ],
                'mailSubscribe' => [//邮件订阅接口
                    'url' => '{#memberApi#}/member/v1/subscribe',
                ],
                'mailActivate' => [//用户通过邮件URL链接激活接口
                    'url' => '{#memberApi#}/member/v1/activate',
                ],
                'accountAttache' => [//根据必要参数获取会员附属信息（如：爱好时长，经验水平）
                    'url' => '{#memberApi#}/member/v1/center/base/attache',
                ],
                'userBasicInfo' => [//获取会员基础信息
                    'url' => '{#memberApi#}/member/v1/memberbase',
                ],
                'UserSignInfo' => [//获取用户登录信息接口
                    'url' => '{#memberApi#}/member/v2/email/{uuid}',
                ],
                'getUserStatus' => [//用户统计信息
                    'url' => '{#memberApi#}/member/v1/center/count',
                ],
                'getUserEmail' => [//获取用户邮箱
                    'url' => '{#memberApi#}/member/v1/email/{UUID}',
                ],
                'sendContactMsg' => [//发送contact信息
                    'url' => '{#memberApi#}/brand/sendMassage',
                ],

                'MessageList' => [//获取用户站内信列表
                    'url' => '{#memberApi#}/message/v1/list',
                ],
                'MessageDetail' => [//获取用户站内信详情
                    'url' => '{#memberApi#}/message/v1/dtl/{id}',
                ],
                'setMessageRead' => [//标记已读站内信
                    'url' => '{#memberApi#}/message/v1/batch/read',
                ],
                'deleteMessage' => [//删除已读站内信
                    'url' => '{#memberApi#}/message/v1/batch/delete',
                ],
                'getAddressLists' => [//获取地址列表
                    'url' => '{#memberApi#}/member/v1/address/list',
                ],
                'addAddress' => [//新增地址
                    'url' => '{#memberApi#}/member/v1/address/add',
                ],
                'editAddress' => [//修改地址
                    'url' => '{#memberApi#}/member/v1/address/update',
                ],
                'deleteAddress' => [//删除地址
                    'url' => '{#memberApi#}/member/v1/address/delete',
                ],
                'setDefaultAddress' => [//设为默认地址
                    'url' => '{#memberApi#}/member/v1/address/setting',
                ],
                'getAddressDetail' => [//获取地址信息
                    'url' => '{#memberApi#}/member/v1/address/dtl',
                ],
				'thirdLoginUrl' => [//获取地址信息
                    'url' => '{#memberApi#}/other/v1/signIn',
                ],
                'getReviewInfo' => [//获取评论信息
                    'url' => '{#memberApi#}/review/v2/review',
                ],
                'getReviewDetail' => [
                    'url' => '{#memberApi#}/review/v1/review',
                ],
                'editReview' => [//修改评论
                    'url' => '{#memberApi#}/member/v1/review/update',
                ],
                'addReview' => [//发表评论
                    'url' => '{#memberApi#}/member/v1/review/add',
                ],
                'deleteReview' => [//删除评论
                    'url' => '{#memberApi#}/member/v1/review/delete/{rid}',
                ],
                'reviewStatus' => [// 获取评论统计
                    'url' => '{#memberApi#}/member/v2/reviews/statistics',
                ],
                'getOneReview' => [// 获取评论统计
                    'url' => '{#memberApi#}/review/v1/review',
                ],
                'deleteProCollect' => [//删除收藏的产品
                    'url' => '{#memberApi#}/collect/v1/collects/delete',
                ],
                'pushUserPhoto' => [//头像推到cdn
                    'url' => '{#memberApi#}/image/v1/upload_cdn',
                ],
                'editProfile' => [//修改个人信息
                    'url' => '{#memberApi#}/member/v1/center/base/update',
                ],
                'editPassword' => [//修改密码
                    'url' => '{#memberApi#}/findpwd/v1/pwd/_update',
                ],
                'synchronizeToServer' => [//图片同步到服务器
                    'url' => '{#memberApi#}/member/v1/memberphoto/update',
                ],
                'getPpHotDeals' => [//获取品牌站hotdeals接口
                    'url' => '{#memberApi#}/brand/getHotDeals',
                ],
                'getDriverProducts' => [//获取有驱动的商品
                    'url' => '{#memberApi#}/brand/findAllProduct',
                ],
                'getContactSubjects' => [//品牌站获取contact主题
                    'url' => '{#memberApi#}/brand/feedBackSubject',
                ],

                //cartApi
                'getOrderLists'=>[//获取订单列表
                    'url' => '{#cartApi#}/order/orderlist',
                ],
                'getOrderDetail'=>[//订单详情
                    'url' => '{#cartApi#}/order/orderdetail',
                ],
                'getMyOrderStatus'=>[//订单统计信息
                    'url' => '{#cartApi#}/order/status',
                ],
                'delOrder'=>[//删除订单
                    'url' => '{#cartApi#}/order/delorders',
                ],
                
                //loyaltyApi
                'getMyCouponLists'=>[//获取coupon列表
                    'url' => '{#loyaltyApi#}/loyalty/v1/coupon/{type}/{uuid}',
                ],
                'getMyPointsLists'=>[//获取points列表
                    'url' => '{#loyaltyApi#}//loyalty/v1/point/{type}/{uuid}',
                ],
                'getPointsCount'=>[//获取point统计
                    'url' => '{#loyaltyApi#}/loyalty/v1/point',
                ],
                'getPointsInfo'=>[//获取用户points统计信息
                    'url' => '{#loyaltyApi#}/loyalty/v1/userPointInfo',
                ],

                //advertApi
                'getAdvert' => [//获取广告接口
                    'url' => '{#advertApi#}/ic/v1/base/banners_content',
                ],
                'getCategoryBg' => [//获取分类背景
                    'url' => '{#advertApi#}/ic/v1/category/background',
                ],

                //ttApi
                'getTTHome' => [
                    'url' => '{#ttApi#}',
                ],

                //shippingApi
                'getShipping' => [
                    'url' => '{#shippingApi#}/shipping',
                ],

                //getProductDriverAndAmazonUrl
                //获取商品驱动文档和在亚马逊的地址
                'getProductDriverAndAmazonUrl' => [
                    'url' => '{#memberApi#}/brand/getDriverAndAmazonUrl',
                ],
                 //获取超级用户数据接口
                'getSuperuserInfo' => [
                    'url' => '{#memberApi#}/brand/getsuperuser',
                ],
                 //添加超级用户数据接口
                'addSuperuserProfile' => [
                    'url' => '{#memberApi#}/brand/superuser',
                ],
                //更新超级用户数据接口
                'updateSuperuserProfile' => [
                    'url' => '{#memberApi#}/brand/updateSuperuser',
                ],
            ],
        ],
        'cache' => [//默认使用文件缓存
            'class' => 'common\components\AppFileCache',
            'serializer' => ['igbinary_serialize', 'igbinary_unserialize'],//序列化|反序列化 函数 必须开启php_igbinary扩展
            'cachePath' => '@runtime/cache/' . DOMAIN, //文件缓存目录
        ],
        'redis' => [//redis缓存管理
            'class' => 'yii\redis\Cache',
            'serializer' => ['json_encode', 'json_decode'],
            'redis' => [
                'hostname' => 'redis01.tomtop.com',
                'port' => 6379,
                'database' => 14,
                'password'=>'jg8ZxxT1#lmc',
            ],
        ],
        'view' => [
            'class' => 'common\components\AppView',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [//日志系统
            'targets' => [
                'file' => [
                    'class' => 'common\components\AppFileTarget',
                    'levels' => ['trace', 'info', 'error', 'warning', 'profile'],
                    // 'categories' => ['yii\*'],
                ],
            ],
        ],
        'i18n' => [//翻译组件
            'translations' => [
                'app*' => [//app类型的翻译
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
                'site*' => [//站点类型的翻译 TTHelper::getSiteLang() 即调用此翻译
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        'site' => 'site.php',
                    ],
                ],
            ],
        ],
    ],
    'alias' => [//别名
    ],
];
