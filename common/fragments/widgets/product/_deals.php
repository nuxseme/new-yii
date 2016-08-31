<?php 
/**
 * @desc Deals产品展示
 */
use Yii;

//公用助手类
$TTHelper = Yii::$container->get('TTHelper');
$countdown = $TTHelper->dailyDealsCountdown($finalTime);
?>
<div class="dailyDeals">
	<div class="dailyDealsTitle"> 
	    <?= $title?>
		<div class="dealsTime countdown">
			<i class="icon-clock lineBlock"> </i>
			<span class="lineBlock hours"><?= $countdown['hours']?></span>:<span class="lineBlock minutes"><?= $countdown['mins']?></span>:<span class="lineBlock seconds"><?= $countdown['secs']?></span><span class="lineBlock txt_left">Left</span>
		</div>
	</div>
	<div class="dealsWarp">
		<div class="moveHidden">
			<ul class="lbUl moveBox">
			    <?php foreach($items as $item):?>
			    <li class="moveList productClass">
			        <?php if($item['origprice'] > $item['nowprice']):?>
					<span class="icon-sale">
					   <?= ceil(100 - ($item['nowprice'] / $item['origprice'] * 100)) ?>
					</span>
					<?php endif;?>
					<a href="<?= $TTHelper->getProductUrl($item['url'])?>" class="productImg">
					    <img alt="<?= $item['title']?>" src="<?= $TTHelper->getThumbnailUrl('product', $item['imageUrl'], Yii::$app->params['productListImgWidth'], Yii::$app->params['productListImgHeight']);?>" />
					</a>
					<a href="<?= $TTHelper->getProductUrl($item['url'])?>" title="<?= $item['title']?>" class="productTitle"><?= $item['title']?></a>
					<?= $TTHelper->productPriceDisplay($item['origprice'], $item['nowprice'], $item['symbol']);?>
				</li>
			    <?php endforeach;?>
			</ul>
		</div>
	</div>
</div>