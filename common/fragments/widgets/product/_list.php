<?php 
/**
 * @desc 产品展示列表
 */
use Yii;
use yii\helpers\Url;

//公用助手类
$TTHelper = Yii::$container->get('TTHelper');
?>
<?php foreach ($items as $item):?>
<li class="lbBox">
	<a class="lineBlock" href="<?= $item['url']?>">
	   <img alt="<?= $item['title']?>" class="lazy" data-original="<?= $TTHelper->staticPrefix();?>/icon/imgNone228.jpg" />
	</a>
	<div class="lineBlock">
		<a class="scrollTitle" href="<?= $TTHelper->getProductUrl($item['url'])?>"><?= $item['title']?></a>
		<?= $TTHelper->productPriceDisplay($item['cost'], $item['price'], $item['symbol']);?>
	</div>
</li>
<?php endforeach;?>