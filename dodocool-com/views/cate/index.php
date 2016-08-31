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
	<div class="bm_dialog bm_quickview">
		<s></s> 
		<div class="dialog">
		  <div class="hd">
		    <p></p>
		    <span class="close"><i class="icon_cross"></i></span class="close">
		  </div>
		  <div class="bd clearfix">
		  	<div class="load_bg"></div>
		  </div>
		  <div class="ft"></div>                
		</div>
	</div>
</div>
<!--main end-->