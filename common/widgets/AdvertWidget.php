<?php
namespace common\widgets;

use Yii;
use common\components\AppWidget;

/**
 * @desc 广告轮播小部件
 * @author Yaofeng
 */
class AdvertWidget extends AppWidget
{
    
    /**
    * @var int 展示方式
    */
    public $displayType;
    
    /**
    * @var array 展示的产品
    */
    public $items;
    
    /**
    * @var int 宽度
    */
    public $width;
    
    /**
    * @var int 高度
    */
    public $height;

    /**
    * @var array $langPkg 语言包
    */
    public $langPkg;
    
    /**
    * @var array 其他参数
    */
    public $itemOptions = array();
    
    const DISPLAY_TYPE_AUTOPLAY = 1;//轮播
    const DISPLAY_TYPE_COMMON   = 2;//普通图片展示
    
    public function init()
    {

    }
    
    public function run()
    {
        $view = 'advert/_roll';
        if($this->displayType == self::DISPLAY_TYPE_COMMON)
        {
            $view = 'advert/_common';
        }
        // 渲染视图
        return $this->render(
                                $view, 
                                [
                                    'items'         => $this->items,
                                    'width'         => $this->width,
                                    'height'        => $this->height,
                                    'itemOptions'   => $this->itemOptions,
                                    'L'             => $this->langPkg,
                                ]
                            );
    }
}