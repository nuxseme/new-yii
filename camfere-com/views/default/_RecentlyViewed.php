<?php
/**
 * @desc 轮播式产品展示
 */
use yii\helpers\Html;

//助手类
$TTHelper = Yii::$container->get('TTHelper');
?>
<div class="moveHidden">
	<ul class="moveBox">
		<?php
		$i = 1;
		foreach ($viewHistory as $key => $item):?>
			<li>
				<a title="<?= $item['title']?>" href="<?= $TTHelper->getProductUrl($item['url']);?>">
					<img alt="<?= $item['title']?>" src="<?= $TTHelper->getThumbnailUrl('product', $item['imageUrl'], Yii::$app->params['productDetailSmallImgWidth'], Yii::$app->params['productDetailSmallImgHeight']);?>" />
				</a>
			</li>
		<?php
		if($i > 2)break;
		$i++;
		endforeach;
		?>
	</ul>
</div>