<?php
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
namespace common\components;

use Yii;
use yii\base\Widget;

/**
 * 新架构情况下 小部件基础类.
 * @author caoxl
 */
class AppWidget extends Widget
{
    /**
     * 返回小部件的视图文件目录.
     * 默认位于 '/common/fragments/widgets'目录下.
     * @return string 小部件视图文件路径.
     */
    public function getViewPath()
    {
       return SYS_COMMON_PATH . 'fragments' . DS . 'widgets';
    }
}
