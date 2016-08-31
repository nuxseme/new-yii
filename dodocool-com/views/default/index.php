<?php
use common\components\AppAsset;
//注册资源文件
AppAsset::register($this, 'index');

?>
<!--main-->
<div id="main">
<?= $sliderBanner ?>
<?= $downBanner?>
</div>
<!--main end-->