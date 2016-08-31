<?php
use yii\helpers\Url;
$cpath = Yii::$app->request->get('cpath');
?>

<li class="li1 <?php if(empty($cpath)){echo 'active';}?>"><a href="<?= Url::toRoute($route);?>"><p>All</p></a></li>
<?php foreach ($allCates as $key => $value) : ?>
	 <li class="li2 <?php if($value['cpath'] == $cpath){echo 'active';}?>"><a href="<?= Url::toRoute([$route, 'cpath' => $value['cpath']]);?>"><p><?=$value['name']?></p></a></li>
<?php endforeach;?>