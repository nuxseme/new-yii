<?php
/**
* @author hyd
* @date 2016-08-15 15:58:48
* @todo 用户主页导航栏部件
*/
namespace common\widgets\ppaccount;
use common\components\AppWidget;

class AccountNavWidget extends AppWidget{

    public function run(){
        // 渲染视图
        return $this->render('ppaccount/nav.php');
    }
}