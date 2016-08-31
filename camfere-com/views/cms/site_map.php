<?php
use yii\helpers\Url;
use common\components\AppAsset;

//注册资源文件
AppAsset::register($this, 'index');
$this->title = 'Site Map';
?>
<style type="text/css">
    *{margin:0; padding:0;}
    .site_map{width:1200px; margin:auto; padding:20px 0; font-size:12px; line-height:20px;}
    .site_map h1{height:48px; font-size:28px; color:#333; line-height:48px; border-bottom:1px solid #999;}
    .site_map h2{height:20px; margin-top:15px; font-size:16px; color:#333; line-height:20px;}
    .site_map h2 a{text-decoration:none;}
    .site_map ul{margin-top:10px; padding-bottom:15px; list-style:none; font-size:0; border-bottom:1px dashed #ccc;}
    .site_map ul li{width:25%; height:20px; font-size:12px; line-height:20px; display:inline-block;}
    .site_map ul li a{text-decoration:none;}
    .site_map ul li a:hover{text-decoration:underline}
</style>
<div class="site_map">
    <h1>Site Map</h1>
    <?php foreach ($categories as $key => $topCategory):?>
	    <h2><a title="<?= $topCategory['cname']?>" href="<?= Url::toRoute(['cate/index', 'cpath' => $topCategory['cpath']]);?>"><?= $topCategory['cname']?></a></h2>
	    <ul>
	    	<?php foreach ($topCategory['son'] as $k => $secondCategory):?>
	        	<li><a title="<?= $secondCategory['cname']?>" href="<?=  Url::toRoute(['cate/index', 'cpath' => $secondCategory['cpath']]);?>"><?= $secondCategory['cname']?></a></li>
	        <?php endforeach;?>
	    </ul>
	<?php endforeach;?>
</div>