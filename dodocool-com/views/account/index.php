<?php
use common\components\AppAsset;
use common\widgets\ppaccount\AccountNavWidget;

//语言包
//注册资源文件
AppAsset::register($this, 'account');
$TTHelper = Yii::$container->get('TTHelper');
?>
<!--main-->
<div id="main">
   <!--主体内容-->
   <div class="content">
   <!--面包屑开始-->
   <?=$breadCrumbs?>
   <!--面包屑结束-->
      <div class="w">
        <div class="acount_container w">
        <!--左侧导航栏开-->
        <?= AccountNavWidget::widget(); ?>
        <!--左侧导航栏结束-->

        <!--右侧主体内容开始-->
           <?=$userBaseInfo?>
         <!--右侧主体内容结束-->

        </div>
      </div>
   </div>
   <!--主体内容 end-->         
</div>
<!--main end-->

