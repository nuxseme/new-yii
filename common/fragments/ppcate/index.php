<?php
use common\components\AppAsset;
//注册资源文件
AppAsset::register($this, 'cate');

?>
<!--main-->
<div id="main">
<?= $banner ?>
<!--主体内容-->
<div class="content">
<?= $cate_nav ?>
<?= $products ?>
 </div>
 <!--主体内容 end-->  
</div>
<!--main end-->