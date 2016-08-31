<?php
use common\components\AppAsset;
use yii\helpers\Url;

//注册资源文件
AppAsset::register($this, 'profile');
$TTHelper = Yii::$container->get('TTHelper');
?>
<!--main-->
<div id="main">
 <!--主体内容-->
 <div class="content">
    <?=$breadCrumbs?>
    <div class="w">
      <div class="acount_container">
       <?=common\widgets\ppaccount\AccountNavWidget::widget();?>
       <?=$profile?>
      </div>
    </div>
 </div>
 <!--主体内容 end-->         
</div>
<!--main end-->