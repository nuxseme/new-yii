<?php
namespace app\controllers;

use Yii;
use yii\base\InvalidParamException;
use common\models\ProductList;
use common\helpers\TTPageHelper;


/**
 * 分类控制器
 */
class CateController  extends BaseController
{
    /**
    * @var TTHelper $TTHelper 公用助手类
    */
    protected $TTHelper;

    /**
    * @var string $cpath 分类路径
    */
    public $cpath;
    
    /**
    * @var int $page 当前页
    */
    public $page;
    
    /**
    * @var string $sort 排序方式
    */
    public $sort;
    
    /**
    * @var string $tagName 标签名称
    */
    public $tagName;
    
    /**
    * @var string $brand 品牌
    */
    public $brand;
    
    /**
    * @var string $depotname 厂库名称
    */
    public $depotname;
    
    /**
    * @var string $type 类别
    */
    public $type;
    
    public $yjPrice;

    /**
    * @var float $startPrice 价格起点
    */
    public $startPrice;

    /**
    * @var float $endPrice 价格终点
    */
    public $endPrice;
    
    /**
    * @var int $categoryId 分类ID
    */
    public $categoryId;
    
    /**
    * @var int $pageSize 每页条数
    */
    protected $pageSize = 40;

    /**
    * 初始化操作
    */
    public function init()
    {
        parent::init();
        $this->TTHelper = Yii::$container->get('TTHelper');
    }

    private function _getParam($name, $defaultValue = null)
    {
        $value = Yii::$app->request->get($name);
        $value === null && $defaultValue !== null && $value = $defaultValue;
        return $value;
    }

	/**
     * 列表页
     *
     * @return mixed
     */
    public function actionIndex()
    {
    	$this->cpath     = $this->_getParam('cid');
        $this->page      = $this->_getParam('p', 1);
        $this->sort      = $this->_getParam('sort');
        $this->tagName   = $this->_getParam('tagname');
        $this->brand     = $this->_getParam('brand');
        $this->depotname = $this->_getParam('depotname');
        $this->yjPrice   = $this->_getParam('yjprice');
        $this->type      = $this->_getParam('type');
        $this->startPrice = $this->_getParam('startprice');
        $this->endPrice = $this->_getParam('endprice');

        $subCategories = $bannerSlider = $categoryInfo = [];

        //显示当前页记录条数
        $startNumber = ($this->page == 1) ? 1 : ($this->page - 1) * $this->pageSize;

        $toNumber = $this->page * $this->pageSize;

        $displayNumber = array('startNumber' => $startNumber, 'toNumber' => $toNumber);

        //分类产品列表
        $productInfo = $this->porductsList();

        if($productInfo)
        {
            //获取子分类
            $subCategories = Yii::$container->get('CateModel')->getSubCategory($this->categoryId)['data'];
                        
            //获取栏目信息
            $categoryInfo = Yii::$container->get('CateModel')->getCategoryMateInfo($this->categoryId);

            $categoryInfo = $categoryInfo['ret'] == 1 ? $categoryInfo['data'] : array();
        }

        //根据聚合出来的产品价格进行排序
        $yjPriceSort = array();
        $aggsMap = $productInfo['aggsMap'];
        $yjPrice = $productInfo['aggsMap']["yjPrice"];
        if($yjPrice)
        { 
            $yjPriceSort['yjPrice'] = $this->TTHelper->yjPriceSort($yjPrice);
            unset($productInfo['aggsMap']['yjPrice']);
            $aggsMap = array_merge($productInfo['aggsMap'], $yjPriceSort);
        }

        //面包屑
        $breadCrumbs = $this->TTHelper->breadCrumbs($this->categoryId);


        //站点SEO信息
        $seoTitle = $categoryInfo['metaTitle'] ? $categoryInfo['metaTitle'] : 'Best ' . ucwords(strtolower($subCategories['cname'])) . ' Wholesale Distributor Online - camfere.com';
        $seoDes = $categoryInfo['metaDescription'] ? $categoryInfo['metaDescription'] : 'Buy cheapest ' . strtolower($subCategories['cname']) . ' direct from manufacturers, Chicuu provides all kinds of ' . strtolower($subCategories['cname']) . ' with wholesale price, buy more, save more!';

        //seo信息
        $this->seoMeta(
            [
                'title' => $seoTitle,
                'description' => $seoDes,
                'keywords' => $seoDes
            ]
        );

        return $this->render(
                                'index',
                                [
                                    'subCategories'  =>   $subCategories,
                                    'productList'    =>   $productInfo['list'],
                                    'pages'          =>   $productInfo['page'],
                                    'displayNumber'  =>   $displayNumber,
                                    'bannerSlider'   =>   $productInfo ? $this->runAppAction('\common\actions\cate\SliderBannerAction', [['categoryId' => $this->categoryId]]) : '',
                                    'categoryInfo'   =>   $categoryInfo,
                                    'breadCrumbs' => $breadCrumbs,
                                    'leftFiltering' => $this->runAppAction('\common\actions\cate\LeftFilteringAction', [['aggsMap' => $aggsMap, 'breadCrumbs' => $breadCrumbs]]),
                                    'sortCate' => $productInfo ? $this->runAppAction('\common\actions\cate\SortCateAction', [['sort' => $this->sort]]) : '',
                                ]
                            );
    }

    /**
     * 获取商品列表
     *
     * @return mixed array|boolean 
     */
    public function porductsList()
    {
        $productListModel = new ProductList;
        $pageParam = array(
                            'cpath'     =>  $this->cpath,
                            'page'      =>  $this->page,
                            'size'      =>  $this->pageSize,
                            'tagName'   =>  $this->tagName,
                            'brand'     =>  $this->brand,
                            'sort'      =>  $this->sort !== null ? $this->TTHelper->categoryListSort($this->sort) : null,
                            'depotname' =>  $this->depotname,
                            'yjPrice'   =>  $this->yjPrice,
                            'type'      =>  $this->type,
                            'startPrice'      =>  $this->startPrice,
                            'endPrice'      =>  $this->endPrice,
                        );
        $re =  $productListModel ->getProductsByCateId($pageParam)['data'];
        if($re)
        {
            $currentPage = Yii::$app->request->get('p');
            !$currentPage && $currentPage = 1;
            $categoryAggsMap = $re['aggsMap'];
            $productList = $re['pblist'];
            $this->categoryId = $re['categoryId'];
            $pages = new TTPageHelper( $re['page']['totalRecord'], $this->pageSize, $currentPage);

            return array('list' => $productList, 'page' => $pages, 'aggsMap' => $categoryAggsMap);
        }
        return false;
    }
}