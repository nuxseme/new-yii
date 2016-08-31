<?php
namespace common\widgets;

use Yii;
use common\components\AppWidget;

/**
 * @desc 产品展示小部件
 * @author Yaofeng
 */
class CategoryDisplayWidget extends AppWidget
{
    
    /**
    * @var int 展示方式
    */
    public $displayType = null;
    
    /**
    * @var array 展示的产品
    */
    public $items = array();
    
    /**
    * @var array 产品列表分页
    */
    public $pages = array();

    /**
     *@var array 图片大小
     */
    public $imgSize = array('width' => '', 'height' => '');

    /**
     *@var string 显示价格
     */
    public $isShowPrice = true;

    /**
    * @var array 产品显示类型
    */
    public $itemOptions = array();
    
    const DISPLAY_TYPE_TRANSVERSE = 1;
    const DISPLAY_TYPE_LONGITUDINAL  = 2;
    
    public function init(){}
    
    public function run()
    {
        switch ($this->displayType)
        {
            case self::DISPLAY_TYPE_TRANSVERSE:
                $view = 'category/_transverse.php';
                break;
            default:
                $view = 'category/_longitudinal.php';
                break;
        }
        // 渲染视图
        return $this->render(
                                $view, 
                                [
                                    'items'         => $this->items,
                                    'pages'         => $this->pages,
                                    'imgSize'      => $this->imgSize,
                                    'isShowPrice'  => $this->isShowPrice,
                                    'itemOptions'   => $this->itemOptions,
                                ]
                            );
    }
}