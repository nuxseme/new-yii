<?php
$TTHelper = Yii::$container->get('TTHelper');
?>
<div class="dealsWarp">
     <div class="dailyAct_tltle"> Featured</div>
	<div class='deal_featured'>
		<ul class="clearfix">
			<?php
			foreach($featuredProducts as $key => $item):
			?>
		    <li class="productClass">
				<a class="productImg" href="<?= $TTHelper->getProductUrl($item['url']);?>"> 
					<img src="<?= $TTHelper->getThumbnailUrl('product', $item['imageUrl'], Yii::$app->params['productListImgWidth'], Yii::$app->params['productListImgHeight']);?>" alt="">
				</a>
				<a title="<?= $item['title']?>" class="productTitle2" href="<?= $TTHelper->getProductUrl($item['url']);?>"><?= $item['title']?></a>
				<?= $TTHelper->productPriceDisplay($item['origprice'], $item['nowprice'], $item['symbol']);?>
				<?php if($item['nowprice'] < $item['origprice']):?>
	            <span class="productOff">(<i><?= ceil(100 - ($item['nowprice'] / $item['origprice'] * 100));?>%</i> off)</span>
				<?php endif;?>
			</li>
			<?php
			endforeach;
			?>	 
		</ul>
	</div>
</div>