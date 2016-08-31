<?php
namespace common\widgets;


use common\components\AppWidget;

/**
 * @desc 
 * @author Yaofeng
 */
class AccountWidget extends AppWidget{


    //显示总数
    public $displayCount = null;

    //当前显示菜单项
    public $displayName = null;


    public function init(){}

    public function run(){

        // 渲染视图
        return $this->render('_menu', [
            'displayCount' => $this->displayCount,
            'displayName'  => $this->displayName,
        ]);
    }
}