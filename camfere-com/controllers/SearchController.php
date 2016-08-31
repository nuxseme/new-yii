<?php
namespace app\controllers;

use Yii;
use common\helpers\TTPageHelper;

/**
 * 分类控制器
 */
class SearchController  extends BaseController
{
	protected $TTHelper;

	public $keyword;
	
	public $page;
	
	protected $size = 40;
	
	public $sort;
	
	public $tagName;
	
	public $brand;
	
	public $depotname;

	public $cpath;
	
	public $categorieId;
	
	public $yjPrice;

	public $startPrice;

	public $endPrice;
	
	public $type;

	public function init()
	{
		$this->TTHelper = Yii::$container->get('TTHelper');
	}

	/**
     * 搜索页首页.
     *
     * @return mixed
     */
    public function actionIndex()
    {
    	$keyword = $this->_filterKeyword(Yii::$app->request->get('keyword'));
    	$this->keyword = str_replace('.','~D~',$keyword);
    	$this->cpath = Yii::$app->request->get("cpath");
    	$p = intval(Yii::$app->request->get("p"));
    	$this->page = ($p !== 0) ? $p : 1;
    	$this->sort = Yii::$app->request->get("sort");
    	$this->tagName = Yii::$app->request->get("tagname");
    	$this->brand = Yii::$app->request->get("brand");
    	$this->depotname = Yii::$app->request->get("depotname");
    	$this->yjPrice = Yii::$app->request->get("yjprice");
    	$this->type = Yii::$app->request->get("type");
    	$this->startPrice = Yii::$app->request->get("startprice");
    	$this->endPrice = Yii::$app->request->get("endprice");

    	//显示当前页记录条数
    	$startNumber = ($this->page == 1) ? 1 : ($this->page - 1) * $this->size;
    	$toNumber = $this->page * $this->size;
    	$displayNumber = array('startNumber' => $startNumber, 'toNumber' => $toNumber);

    	//分类产品列表
    	$productInfo = $this->getResult();

        //seo信息
        $this->seoMeta(
            [
                'title' => $this->keyword . ' Deals with Worldwide Freeshipping | Camfere.com',
                'description' => 'Shop Best ' . $this->keyword . ' Deals with Worldwide Freeshipping | Camfere.com',
                'keywords' => 'Shop Best ' . $this->keyword . ' Deals with Worldwide Freeshipping | Camfere.com'
            ]
        );

        return $this->render('index', 
        					[
								'subCategories'  =>  $subCategories,
								'productList'    =>  $productInfo['list'],
								'aggsMap'        =>  $productInfo['aggsMap'],
								'pages'          =>  $productInfo['page'],
								'displayNumber'  =>  $displayNumber,
	        				]
        					);
    }

    /**
     * 过滤关键字
     *
     * @param string $keyword 
     * @return string $keyword
     */
    private function _filterKeyword($keyword)
    {
    	return trim(htmlspecialchars(str_replace('>','',str_replace('<','',$keyword))));
    }

	/**
     * 获取搜索结果
     *
     * @return aray
     */
    public function getResult()
    {
        $return = array('list'=>'null');
    	$pageParam = array(
    					   'keyword'   =>  $this->keyword,
    					   'page'      =>  $this->page,
    					   'size'      =>  $this->size,
    					   'sort'      =>  $this->TTHelper->categoryListSort($this->sort),
    					   'tagName'   =>  $this->tagName,
    					   'brand'     =>  $this->brand,
    					   'depotname' =>  $this->depotname,
    					   'cpath'=>  $this->cpath,
    					   'yjPrice'   =>  $this->yjPrice,
    					   'type'      =>  $this->type,
    					   'startPrice'      =>  $this->startPrice,
    					   'endPrice'      =>  $this->endPrice,
    					   );
    	$re = Yii::$container->get('ProductModel')->getProductsByKeyword($pageParam);
    	if($re['ret'] == 1)
    	{
            $currentPage = Yii::$app->request->get('p');
            !$currentPage && $currentPage = 1;
    		$return = array(
                                'list' => $re['data']['pblist'], 
                                'aggsMap' => $re['data']['aggsMap'],
                                'page' => new TTPageHelper( $re['data']['page']['totalRecord'], $this->size, $currentPage)
                            );
    	}
    	return $return;
    }
}