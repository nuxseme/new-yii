<?php
namespace common\widgets;

use Yii;
use common\components\AppWidget;

/**
 * @desc 产品展示小部件
 * @author Yaofeng
 */
class ProductDisplayWidget extends AppWidget
{
    /**
    * @var int 展示方式
    */
    public $displayType = null;
    
    /**
    * @var array 展示的产品
    */
    public $items = null;
    
    /**
    * @var string 标题
    */
    public $title = null;
    
    /**
    * @var int 默认展示个数
    */
    public $per = 5;
    
    /**
    * @var boolean 是否包含头部
    */
    public $includeHeader = true;
    
    /**
    * @var array 产品显示类型
    */
    public $itemOptions = array();

    /**
     *@var array 图片大小
     */
    public $imgSize = array('width' => '', 'height' => '');

    /**
     *@var string 显示价格
     */
    public $isShowPrice = true;

    /**
    * @var array 语言包
    */
    public $langPkg;
    
    const DISPLAY_TYPE_AUTOPLAY     = 1;//轮播
    const DISPLAY_TYPE_DEALS        = 2;//deals
    const DISPLAY_TYPE_LIST         = 3;//列表
    const DISPLAY_TYPE_ROLL         = 4;
    const DISPLAY_TYPE_BREADCRUMBS  = 5;//面包屑
    
    public function init()
    {

    }
    
    public function run()
    {
        switch($this->displayType)
        {
            case self::DISPLAY_TYPE_AUTOPLAY:
                $view = 'product/_autoplay.php';
                break;
            case self::DISPLAY_TYPE_DEALS:
                $view = 'product/_deals.php';
                break;
            case self::DISPLAY_TYPE_LIST:
                $view = 'product/_list.php';
                break;
            case self::DISPLAY_TYPE_ROLL:
                $view = 'product/_roll.php';
                break;
            case self::DISPLAY_TYPE_BREADCRUMBS:
                $view = 'product/_bread_brumbs.php';
                break;
            default:
                $view = 'product/_autoplay.php';
                break;
        }
        // 渲染视图
        return $this->render(
                                $view, 
                                [
                                    'items'         => $this->items,
                                    'title'         => $this->title,
                                    'per'           => $this->per,
                                    'imgSize'      => $this->imgSize,
                                    'isShowPrice'      => $this->isShowPrice,
                                    'itemOptions'   => $this->itemOptions,
                                    'includeHeader' => $this->includeHeader,
                                    'L'             => $this->langPkg,
                                ]
                            );
    }
}