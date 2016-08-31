<?php 
/**
 * @desc 面包屑
 */
use yii\helpers\Url;

//公用助手类
$TTHelper = Yii::$container->get('TTHelper');
?>
<!--面包屑-->
<ul class="Bread_crumbs lbUl">
	<li class="Bread_home lineBlock">
		<a title="Home" class="icon-home" href="<?= Url::home();?>"> </a>
	</li>
	<?php 	
	foreach ((array)$items as $key => $data):
		$rpos = strrpos($data['cpath'], "/");
		$start = $rpos === false ? $rpos : ($rpos + 1);
		$cname = strtolower(mb_substr($data['cpath'], $start));
	?>
	<li>
		<i class="icon-breadArr"> </i>
		<a title="<?= $data['name']?>" href="<?= Url::toRoute(['cate/index', 'cname' => $cname, 'cid' => $data['categoryId']]);?>"><?= $data['name']?></a>
	</li>
	<?php endforeach;?>
</ul>