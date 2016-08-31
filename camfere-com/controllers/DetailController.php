<?php
namespace app\controllers;

use Yii;
use yii\helpers\Json;

/**
 * 分类控制器
 */
class DetailController  extends BaseController
{
    /**
     * @var TTHelper $TTHelper 公用助手类
     */
    protected $TTHelper;

    /**
     * @var String $listingId
     */
    public $listingId;

    public function init()
    {
        $this->TTHelper = Yii::$container->get('TTHelper');
    }

	/**
     * 列表页
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $urlPrefix = $this->getUrlPrefix();

        //提取所有产品信息
        $product = $this->getProductAllInfo($urlPrefix);

        //提取主产品信息
        $productBaseInfo = $this->getMainProduct($urlPrefix, $product['pdbList']);
        
        //产品listingId
        $this->listingId = $productBaseInfo['listingId'];

        //产品信息输出到页面共JS调用
        $productMainContent = Json::encode($this->addUsPrice($product['pdbList']));

        //注册用户浏览记录
        if($productBaseInfo)
        { 
            $webHistory = $this->webHistory();  //设置cookies浏览记录
        }

        //产品详情SEO信息
        $meta = $product['psb'];

        //收藏数
        $favoritesNumber = $product['ccb'];

        //仓库
        $storageAct = $this->createAppAction('\common\actions\detail\StorageAction');

        //图片放大部分列表
        $slideImgList = $this->TTHelper->sortProductImgArray($productBaseInfo['imgList']);

        //获取客户端汇率
        $currentRate = $this->getCurrentRate();

        //根据仓库显示默认价格
        $productDetailPrice = $this->TTHelper->getPriceByWarehouse($productBaseInfo['listingId'], $productBaseInfo['whouse'], $currentRate);

        //获取系统时间
        $serverTime = $this->getServerTime();

        $productImagesDisplayType = $this->getImagesDisplayType();

        //面包屑
        $breadCrumbs = $this->TTHelper->breadCrumbs($productBaseInfo['listingId'], 'detail');
        $imagesDisplayType = $this->TTHelper->imagesDispalyType($productImagesDisplayType, $breadCrumbs);

        //seo信息
        $this->seoMeta(
            [
                'title' => $productBaseInfo['title'] . ' with Free Shipping | Camfere.com',
                'description' => 'Shop ' . $productBaseInfo['title'] . ' at Bargain Price.',
                'keywords' => 'action camera,360 degree camera,360 panorama camera,VR camera,digital camcorder,flashes,speedlite,ringlight,tripod,monopod,digital photo frame,Binoculars,Telescopes,Mobile Photography Accessories'
            ]
        );

        return $this->render(
                                'index',
                                [
                                    'productInfo' => $productBaseInfo,
                                    'meta' => $meta,
                                    'favoritesNumber' => $favoritesNumber,
                                    'porductStorage' => $storageAct->run(['listingId' => $this->listingId, 'whouse' => $productBaseInfo['whouse']]),
                                    'reviews' => $this->runAppAction('\common\actions\detail\ReviewsAction', [['rsnbo' => $product['rsnbo'], 'listingId' => $productBaseInfo['listingId']]]),
                                    'tabs' => $this->runAppAction('\common\actions\detail\TabsAction', [['description' => $product['desc']]]),
                                    'hotEvent' => $this->runAppAction('\common\actions\detail\HotEventAction'),
                                    'productMainContent' => $productMainContent,
                                    'productImagesDisplayType' => $productImagesDisplayType,
                                    'shipping' => $this->runAppAction('\common\actions\shipping\DisplayShippingAction'),
                                    'productAttrs' => $this->runAppAction('\common\actions\detail\AttrsAction', [['pdbList' => $product['pdbList'], 'attributeMap' => $productBaseInfo['attributeMap']]]),
                                    'defaultWhouse' => $storageAct->defaultWhouse,
                                    'imgZoom' => $this->runAppAction('\common\actions\detail\ImgZoomAction', [['slideImgList' => $slideImgList, 'productTitle' => $productBaseInfo['title']]]),
                                    'slideImgList' => $slideImgList,
                                    'productDetailPrice' => $productDetailPrice,
                                    'serverTime' => $serverTime,
                                    'breadCrumbs' => $breadCrumbs,
                                    'currentRate' => $currentRate,
                                    'imagesDisplayType' => $imagesDisplayType,
                                ]
                            );
    }

    /**
     * 获取url前缀 (目前都为sku)
     * 
     * @return string
     */
    public function getUrlPrefix()
    {
         return Yii::$app->request->get('cpath');
    }

    /**
     * 详细页提取产品所有信息
     * 
     * @param string $urlPrefix 商品url前缀
     * @return array
     */
    public function getProductAllInfo($urlPrefix)
    { 
        $re = Yii::$container->get('ProductModel')->getProductDetails($urlPrefix);
        return $re['ret'] == 1 ? $re['data'] : [];
    }

    /**
     * 详细页提取主产品
     * 
     * @param string $urlPrefix url前缀
     * @param array $productList 所有商品列表
     * @return mixed array|boolean
     */
    public function getMainProduct($urlPrefix, $productList)
    {
        $productInfo = $productList;
        $_count = count($productInfo);
        if($_count == 1)
        {
            return $productInfo[0];
        }
        if($_count > 1)
        {
            $mianProduct = array();
            $newUrl = strstr($urlPrefix, 'p');
            foreach ($productInfo as $key => $value)
            {
                $matchField = $newUrl ? $value['url'] : $value['sku'];
                if(urldecode($matchField) == $urlPrefix)
                {
                    return $value;
                }
            }
        }
        return false;
    }


    /**
     * 在原价的基础上增加美元价格
     * 
     * @param    array $pdbList
     * @return array $pdbList
     */
    public function addUsPrice($pdbList)
    {
        $currencyValue = $this->TTHelper->getCookie('TT_CURR');
        empty($currencyValue) && $currencyValue = 'USD';
        $currentRate = Yii::$container->get('CurrencyModel')->getRate($currencyValue);
        $currentRate = ($currentRate['ret'] == 1 ? $currentRate['data'] : null);
        empty($currentRate) && $currentRate = 1; //cookie为空时设置美元汇率
        foreach ($pdbList as $key => $value)
        {
            foreach ($value['whouse'] as $k => $v)
            {
                $pdbList[$key]['whouse'][$k]['us_nowprice'] = number_format($v['nowprice'] / $currentRate, 2 , '.', '');
                $pdbList[$key]['whouse'][$k]['us_origprice'] = number_format($v['origprice']/$currentRate, 2, '.' , '');
            }
        }
        return $pdbList;
    }

    /**
     * 获取当前产品属性
     * 
     * @param    array $productPlist
     * @return array
     */
    public function getMainProductAttribute($productPlist)
    { 
        $productInfo = $productPlist;
        $data = array();
        foreach ($productInfo as $key => $value) 
        {
            if($value['listingId'] == $this->listingId)
            { 
                $data = $value;
            }
        }
        return $data;
    }

    /**
     * 访客浏览记录，写入cookie
     * 
     * @return void
     */
    public function webHistory()
    {
        //获取cookies
        $cookiesHistory = $this->TTHelper->getCookie('WEB-history');

        //设置cookies,当浏览记录为空时注册一个cookies
        if($cookiesHistory === false)
        { 
            $this->TTHelper->setCookie('WEB-history', $this->listingId);
        }
        else
        { //cookies不为空移除原有cookies，重新追加
            $this->TTHelper->unsetCookie('WEB-history');

            $cookieString = '';

            //只记录10个最近显示的浏览记录
            $cookies = substr($cookiesHistory, 0, -1);
            $cookiesArray = explode(',', $cookies);
            $cookiesHistoryValue = '';
            if(count($cookiesArray) > 9)
            { 
                $i = 1;
                foreach ($cookiesArray as $key => $value)
                { 
                    $cookiesHistoryValue .= $value . ',';
                    $i++;
                    if($i > 9) break; 
                }
            }
            else
            { 
                $cookiesHistoryValue = $cookiesHistory;
            }
            //$cookiesHistoryValue = $cookiesHistory;
            //判断原有的cookies是否存在需要注入的listingID，不存在把listingID追加到最前面
            if(!strstr($cookiesHistoryValue, $this->listingId))
            { 
                $cookieString = $this->listingId . ',' . $cookiesHistoryValue;
            }
            else
            { 
                $cookiesArray = explode(',',$cookiesHistoryValue);
                $newCookiesString = '';
                foreach ($cookiesArray as $key => $value)
                { 
                    if($value != $this->listingId)
                    { //获取isttingID在cookies中不存在的值
                        $newCookiesString .= $value . ',';
                    }
                }
                $cookieString = $this->listingId . ',' . substr($newCookiesString, 0, -1);
            }
             $this->TTHelper->setCookie('WEB-history', $cookieString);
        }
    }


    /**
     * 不同分类的产品显示不同的图片规格
     * 
     * @return array
     */
    public function getImagesDisplayType()
    {
       $re = Yii::$container->get('ProductModel')->getImagesDisplayType();
        return $re['ret'] == 1 ? $re['data'] : []; 
    }

    /**
     * 根据不同的属性异步获取价格
     * 
     * @return string json
     */
    public function actionAjaxproductprice()
    { 
        $listtingId = $this->request->get("listingId");
        $data = ['ret' => -1, 'data' => []];
        if($listtingId != 'false')
        {
            $re = Yii::$container->get('ProductModel')->getProductPrice($listtingId);
            $data = ['ret' => $re['ret'], 'data' => []];
            if($re['ret'] == 1)
            {
                $data['data'] = [ 
                                    'nowprice' => $re['nowprice'],
                                    'origprice' => $re['origprice']
                                ];
            }
        }
        return $this->resAjax($data);
    }

    /**
     * 异步获取商品收藏数
     * 
     * @return string json
     */
    public function actionAjaxfavorites(){ 
        $listingId = Yii::$app->request->get('listingId');
        $re = Yii::$container->get('ProductModel')->getFavoritesNumber($listingId);

        $data = ['ret' => $re['ret'], 'data' => []];
        $re['ret'] == 1 && $data['data']['client'] = $re['data']['collectCount'];
    
        return $this->resAjax($data);
    }

    /**
     * 获取用户收藏产品listingID集合
     * 
     * @return string json
     */
    public function actionAjaxcollect()
    { 
        //登陆信息用户
        $ttUUID = $this->TTHelper->getCookie('TT_UUID');
        $listingId = Yii::$app->request->get("listingId");
        $favorites = false;
        $data = ['ret' => -1, 'data' => [], 'msg' => 'You have favorites too'];
        if(!empty($ttUUID))
        { 
            $userEmail = $this->isLogin();
            if($userEmail !== false)
            { 
                $re = Yii::$container->get('ProductModel')->getProductCollectList($userEmail);
                if($re['ret'] == 1)
                { //商品是否被收藏
                    foreach ($re['data'] as $key => $value)
                    { 
                        if($value == $listingId)
                        { 
                            $favorites = true;
                            break;
                        }
                    }
                }
            }
        }
        if($favorites)
        { 
            $data['ret'] = 1;
        }

        return $this->resAjax($data);
    }

    /**
     * 获取商品详情异步加载
     * 
     * @return string json
     */
    public function actionAjaxdescimg(){ 
        $data = ['ret' => 1, 'data' => []];

        $listingId = $this->request->get("listing_id");
        $product = $this->getProductAllInfo($listingId);

        //提取主产品信息
        $productBaseInfo = $this->getMainProduct($product['pdbList']);

        //提取主产品图片
        $imgList = $this->TTHelper->sortProductImgArray($productBaseInfo['imgList']);

        $imgHtml = '';

        foreach($imgList as $key => $value)
        {
            $imgHtml .= '<img class="lazy" data-original=' . $this->TTHelper->getThumbnailUrl('product', $value['imgUrl'], '', '', true) . '>';
        }
        
        $data['data'] = $imgHtml;

        return $this->resAjax($data);
    }

    /**
     * 异步调用Customers Who Bought This Item Also Bought
     * 
     * @return string json
     */
    public function actionAjaxalsobought()
    { 
        $listingId = Yii::$app->request->get('listingId');
        $itemOptions = ['class'=>'AlsoBought', 'title' => 'Customers Who Bought This Item Also Bought'];
        $data = ['ret' => -1, 'data' => []];
        if(!empty($listingId))
        { 
            $autoPlayProductList = Yii::$container->get('ProductModel')->getAlsoBought($listingId);
            $autoPlayProductList = ($autoPlayProductList['ret'] == 1 ? $autoPlayProductList['data'] : []);
            $data['ret'] = 1;
            $data['data'] = $this->renderPartial(
                                                    'ajax/_autoPlayProduct',
                                                    ['autoPlayProduct' => $autoPlayProductList, 'itemOptions' => $itemOptions]
                                                );
        }

        return $this->resAjax($data);
    }

    /**
     * 异步调用Customers Who Viewed This Item Also Viewed
     * 
     * @return string json
     */
    public function actionAjaxalsoviewed(){ 
        $listingId = Yii::$app->request->get('listingId');
        $itemOptions = ['class'=>'AlsoViewed', 'title' => 'Customers Who Viewed This Item Also Viewed'];
        $data = ['ret' => -1, 'data' => []];
        if(!empty($listingId))
        { 
            $autoPlayProductList = Yii::$container->get('ProductModel')->getAlsoViewed($listingId);
            $data['ret'] = 1;
            $data['data'] = $this->renderPartial(
                                            'ajax/_autoPlayProduct',
                                            [
                                                'autoPlayProduct' => $autoPlayProductList['data'],
                                                'itemOptions' => $itemOptions
                                            ]
                                        );
        }
        return $this->resAjax($data);
    }

    /**
     * 添加Wholesale Inquiry
     * 
     * @return string json
     */
    public function actionAjaxwholesale()
    {
        $wholesaleInquiryInfo = Yii::$app->request->post();
        $res = Yii::$container->get('ProductModel')->addWholesaleInquiry($wholesaleInquiryInfo);
        $data = ['ret' => 0, 'data' => '', 'msg'=>'Add failure'];
        if($res['ret'] == 1)
        { 
            $data = ['ret' => 1, 'data' => '', 'msg' => 'Add successful'];
        }
        return $this->resAjax($data);
    }

    /**
     * 添加商品收藏
     * 
     * @return string json
     */
    public function actionAjaxaddcollect()
    {
        $collectInfo = Yii::$app->request->post();
        $userEmail = $this->isLogin();
        $collectInfo['email'] = $userEmail;
        $res = Yii::$container->get('ProductModel')->addProductCollect($collectInfo);
        $data = ['ret' => 0, 'data' => '', 'msg'=>$res['errMsg']];
        if($res['ret'] == 1)
        { 
            $data['ret'] = 1;
            $data['msg'] = 'Add successful';
        }
        return $this->resAjax($data);
    }

    /**
     * 添加商品dropship
     * 
     * @return string json
     */
    public function actionAjaxdropship(){
        $dropShipInfo = Yii::$app->request->post();
        $res = Yii::$container->get('ProductModel')->addProductDropship($dropShipInfo);
        $data = ['ret' => 0, 'data' => '', $res['errMsg']];
        if($res['ret'] == 1)
        { 
            $data['ret'] = 1;
            $data['msg'] = 'Add successful';
        }
        return $this->resAjax($data);
    }
    
    /**
     * 添加商品WholeSaleProduct
     * 
     * @return string json
     */
    public function actionAjaxwsp(){
        $wholeSaleProductInfo = Yii::$app->request->post();
        $res = Yii::$container->get('ProductModel')->addWholeSaleProduct($wholeSaleProductInfo);
        $data = ['ret' => 0, 'data' => '', 'msg' => $res['errMsg']];
        if($res['ret'] == 1)
        { 
            $data['ret'] = 1;
            $data['msg'] = 'Add successful';
        }
        return $this->resAjax($data);
    }

    /**
     * 获取客户端汇率
     * 
     * @return float $rate
     */
    public function getCurrentRate()
    {
        //获取客户端汇率
        $currencyValue = $this->TTHelper->getCookie('TT_CURR');
        $currentRate = Yii::$container->get('CurrencyModel')->getRate($currencyValue);
        $currentRate = ($currentRate['ret'] == 1 ? $currentRate['data'] : 1);
        return $currentRate;
    }

    /**
     * 获取系统时间
     * 
     * @return date y/m/d
     */
    public function getServerTime()
    {
        $serverTime = Yii::createObject('common\models\System')->getSystemTime();
        $serverTime = $serverTime['ret'] == 1 ? $serverTime['data'] : date('y/m/d');
        return $serverTime;
    }

    /**
     * 快速购买弹窗接口
     * 
     * @return string json
     */
    public function actionDetailajax()
    {
        $urlPrefix = Yii::$app->request->get('listingId');

        //提取所有产品信息
        $product = $this->getProductAllInfo($urlPrefix);

        //提取主产品信息
        $productBaseInfo = $this->getMainProduct($urlPrefix, $product['pdbList']);

        //产品listingId
        $this->listingId = $productBaseInfo['listingId'];

        //产品信息输出到页面共JS调用
        $productMainContent = Json::encode($this->addUsPrice($product['pdbList']));

        //仓库
        $storageAct = $this->createAppAction('\common\actions\detail\StorageAction');

        //不同分类的产品显示不同的图片规格
        $productImagesDisplayType = $this->getImagesDisplayType();

         //图片放大部分列表
        $slideImgList = $this->TTHelper->sortProductImgArray($productBaseInfo['imgList']);

        //获取客户端汇率
        $currentRate = $this->getCurrentRate();

        //根据仓库显示默认价格
        $detailPrice = $this->TTHelper->getPriceByWarehouse($productBaseInfo['listingId'], $productBaseInfo['whouse'], $currentRate);

        //获取系统时间
        $serverTime = $this->getServerTime();

        //面包屑
        $breadCrumbs = $this->TTHelper->breadCrumbs($productBaseInfo['listingId'], 'detail');
        $imagesDisplayType = $this->TTHelper->imagesDispalyType($productImagesDisplayType, $breadCrumbs);

        $data = ['ret' => 1, 'data' => ''];
        $data['data'] = $this->renderPartial(
                                            'ajax/_productviewdetail', 
                                            [
                                                'productBaseInfo' => $productBaseInfo,
                                                'productMainContent' => $productMainContent,
                                                'porductStorage' => $storageAct->run(['listingId' => $this->listingId, 'whouse' => $productBaseInfo['whouse']]),
                                                'productAttrs' => $this->runAppAction('\common\actions\detail\AttrsAction', [['pdbList' => $product['pdbList'], 'attributeMap' => $productBaseInfo['attributeMap']]]),
                                                'defaultWhouse' =>  $storageAct->defaultWhouse,
                                                'slideImgList' => $slideImgList,
                                                'imgZoom' => $this->runAppAction('\common\actions\detail\ImgZoomAction', [['slideImgList' => $slideImgList, 'productTitle' => $productBaseInfo['title'], 'suffix' => 'Ajax']]),
                                                'detailPrice' => $detailPrice,
                                                'serverTime' => $serverTime,
                                                'breadCrumbs' => $breadCrumbs,
                                                'currentRate' => $currentRate,
                                                'imagesDisplayType' => $imagesDisplayType,
                                            ]
                                            );
        return  $this->resAjax($data);
    }

}