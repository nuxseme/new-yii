<?php
/**
* @author hyd
* @date 2016-08-13 16:52:16
* @todo 品牌网站 商品详情页控制器
*/

namespace app\controllers;

use Yii;
use yii\helpers\Json;
use yii\helpers\Url;

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
     * action别名
     * @return array 
     */
    public function actions()
    {
        return [];
    }

    /**
     * [actionIndex 商品详情]
     */
    public function actionIndex()
    {
        $urlPrefix = $this->getUrlPrefix();

        //提取所有产品信息
        $product = $this->getProductAllInfo($urlPrefix);

        //提取主产品信息
        $productBaseInfo = $this->getMainProduct($urlPrefix, $product['pdbList']);

        //对老的URL自动进行301跳转
        $this->autoRedirect301($urlPrefix, str_replace('.html', '', $productBaseInfo['jumpUrl']));
        
        $this->listingId = $productBaseInfo['listingId'];

        $drivers =  $this->runAppAction(
                      'common\actions\ppdetail\DriverAction',
                      [
                        ['sku' => $productBaseInfo['sku']]
                      ]
                    );

        $platforms = $drivers->platforms;

        return $this->render(
            'index',
            [
                //面包屑导航
                'breadCrumbs' => $this->runAppAction(
                    '\common\actions\ppdetail\BreadCrumbsAction',
                    [['listingId'=>$this->listingId]]
                ),

                //商品图片展示
                'productShow' => $this->runAppAction(
                    '\common\actions\ppdetail\ProductShowAction',
                    [['imgList'=> $productBaseInfo['imgList']]]
                ),

                //js变量展示区
                'jsvars' => $this->runAppAction(
                  'common\actions\ppdetail\JsvarsAction',
                  [
                    [
                      'pdbList' => $product['pdbList'],
                      'productInfo' => $productBaseInfo
                    ]
                  ]
                ),

                //评论列表
                'reviews' => $this->runAppAction(
                  'common\actions\ppdetail\ReviewAction',
                  [
                    ['listingId' => $this->listingId]
                  ]
                ),

                //商品介绍
                'overview' => $product['desc'],

                //驱动列表
                'drivers' => $drivers,

                //亚马逊及各个平台购买地址
                'platforms' => $platforms,

                //帮助信息
                'faq' => $this->runAppAction(
                  'common\actions\ppdetail\FaqAction'
                ),

                //商品仓储
                'porductStorage' => $this->runAppAction(
                    '\common\actions\ppdetail\StorageAction',
                    [['listingId' => $this->listingId, 'whouse' => $productBaseInfo['whouse']]]
                ),

                //星级 评论总数
                'reviewsAndStarts' => $this->runAppAction('\common\actions\ppdetail\ReviewsAndStartsAction', [['listingId' => $this->listingId]]),
                
                //商品标题
                'title' => $productBaseInfo['title'],

                //商品属性
                'productAttrs' => $this->runAppAction(
                    '\common\actions\ppdetail\AttrsAction', 
                    [[
                        'pdbList' => $product['pdbList'], 
                        'attributeMap' => $productBaseInfo['attributeMap']
                    ]]
                ),

                //youmaylike
                'youmaylike' => $this->runAppAction(
                    '\common\actions\ppdetail\YouMayLikeAction',
                    [['listingId'=>$this->listingId]]
                ),
            ]
        );
    }

    /**
     * 自动301跳转
     * @param string $urlPrefix 当前url
     * @param string $jumpUrl 跳转的URL
     *
     * @return string
     */
    public function autoRedirect301($urlPrefix, $jumpUrl)
    {
        if(strpos($urlPrefix, '/') === false)
        {//url前缀中不带有分割符'/'证明是老URL 进行301跳转
          $jumpUrl = $jumpUrl ? $this->TTHelper->getProductUrl($jumpUrl) : Url::home();
          $this->redirect($jumpUrl, 301);
        }
    }

    /**
     * 获取url前缀
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
            $newUrl = strstr($urlPrefix, 'p_') || strstr($urlPrefix, 'p-');
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
     * 产品列表页快速浏览功能
     * 
     * @return string json
     */
    public function actionAjaxquickview()
    {
      $urlPrefix = $this->getUrlPrefix();

      //提取所有产品信息
      $product = $this->getProductAllInfo($urlPrefix);

      //提取主产品信息
      $productBaseInfo = $this->getMainProduct($urlPrefix, $product['pdbList']);

      $this->listingId = $productBaseInfo['listingId'];

      $imageUrl = Yii::$container->get('TTHelper')->sortProductImgArray($productBaseInfo['imgList']);
      $imageUrl = $imageUrl[0]['imgUrl'];

      $html = $this->renderPartial(
        'ajaxquickview',
        [
          'title' => $productBaseInfo['title'],

          'imageUrl' => $imageUrl,

          //js变量展示区
          'jsvars' => $this->runAppAction(
            'common\actions\ppdetail\JsvarsAction',
            [
              [
                'pdbList' => $product['pdbList'],
                'productInfo' => $productBaseInfo
              ]
            ]
          ),

          //商品仓储
          'porductStorage' => $this->runAppAction(
              '\common\actions\ppdetail\StorageAction',
              [['listingId' => $this->listingId, 'whouse' => $productBaseInfo['whouse']]]
          ),

          //商品属性
          'productAttrs' => $this->runAppAction(
              '\common\actions\ppdetail\AttrsAction', 
              [['pdbList' => $product['pdbList'], 'attributeMap' => $productBaseInfo['attributeMap']]]
          ),
        ]
      );

      return $this->resAjax(['ret' => 1, 'data' => $html]);
    }
}