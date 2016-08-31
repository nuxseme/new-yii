<?php
use common\components\AppAsset;

//注册资源文件
AppAsset::register($this, 'newarrivals');
?>
<!--main-->
<div id="main">
 <!--主体内容-->
 <div class="content">
    <?=$breadCrumbs?>
	<?=$products?>
 </div>
 <!--主体内容 end-->        
</div>
<!--main end-->
