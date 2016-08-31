<?php
/**
* @author hyd
* @date 2016-08-13 16:15:34
* @todo 品牌网站搜索页面控制器
*/
namespace app\controllers;
use Yii;

class SearchController  extends BaseController
{
    protected $TTHelper;

    public $keyword;
    /**
     * [init 初始化]
     */
    public function init()
    {
        $this->TTHelper = Yii::$container->get('TTHelper');
        $keyword = $this->_filterKeyword(Yii::$app->request->get('keyword'));
        $this->keyword = str_replace('.','~D~',$keyword);
    }

    /**
     * 搜索页首页. 品牌网站根据关键词搜索
     */
    public function actionIndex()
    {
     
        //seo信息
        $this->seoMeta(
            [
                'title' => $this->keyword . ' Deals with Worldwide Freeshipping | Dodocool.com',
                'description' => 'Shop Best ' . $this->keyword . ' Deals with Worldwide Freeshipping | Dodocool.com',
                'keywords' => 'Shop Best ' . $this->keyword . ' Deals with Worldwide Freeshipping | Dodocool.com'
            ]
        );
        //搜索页面  面包屑导航 + 商品显示区
        return $this->render('index', 
                            [
                            'breadCrumbs' => $this->runAppAction(
                                '\common\actions\ppsearch\BreadCrumbsAction',
                                [['keyword' => $this->keyword ]]),
                            'products' => $this->runAppAction(
                                '\common\actions\ppsearch\ProductsListAction',
                                [['keyword' => $this->keyword ]]),
                            ]);
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

}