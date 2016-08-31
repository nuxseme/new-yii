<?php
/**
* @author hyd
* @date 2016-08-13 18:39:22
* @todo 分类商品 控制器
*/

namespace app\controllers;
use Yii;

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
    * @var int $cid 分类ID
    */
    public $cid;
    
    /**
    * 初始化操作
    */
    public function init()
    {
        parent::init();
        $this->TTHelper = Yii::$container->get('TTHelper');
    }

	/**
     * 列表页 
     * 满足主分类页面
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render(
                                'index',
                                [
                                    'banner' => $this->runAppAction('\common\actions\ppcate\BannerAction'),
                                    'cate_nav' => $this->runAppAction('\common\actions\ppcate\NavAction'),
                                    'products' => $this->runAppAction('\common\actions\ppcate\ProductsAction'),
                                ]
                            );
    }

}