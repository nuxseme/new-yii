<?php
use common\components\AppAsset;

//注册资源文件
AppAsset::register($this, 'index');

//站点SEO信息
$this->title = $articleDetails['title'];
?>
<section class="contentInside">
	<div class="sss">
		<?= $articleDetails['content']?>
	</div>
</section>