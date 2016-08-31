<?php
use common\components\AppAsset;

//注册资源文件
AppAsset::register($this, 'index');

//站点SEO信息
$this->title = $articleDetails['title'];
?>

<!--main-->
<div id="main">
 	<!--主体内容-->
 	<div class="content">
		<?= $articleDetails['content']?>
	</div>
 	<!--主体内容 end-->        
</div>
<!--main end-->