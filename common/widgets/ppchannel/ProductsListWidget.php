<?php
namespace common\widgets\ppchannel;

use common\components\AppWidget;

/**
 * @desc 用户主页导航栏
 */
class ProductsListWidget extends AppWidget{

    public function run(){

        // 渲染视图
        return $this->render('ppchannel/productsContainer.php',[
        		'products' => $this->products
        	]);
    }
}