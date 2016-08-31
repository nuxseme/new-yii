<?php 
/**
 * @desc 底部产品切换视图
 */
use Yii;

//公用助手类
$TTHelper = Yii::$container->get('TTHelper');
?>
<div class="<?= isset($itemOptions['class']) ? $itemOptions['class'] : ''?>"> 
	<a href="javascript:void(0)" class="moveLeftClick leftArr"> </a>
	<a href="javascript:void(0)" class="moveRightClick rightArr"> </a>
	<div class="moveHidden">
		<ul class="lbUl moveBox">
		    <?php foreach ($items as $item):?>
			<li class="moveList productClass" rel-data="<?= $item['listingId']?>">
				<?php if($item['cost'] > $item['price']):?>
					<span class="icon-sale">
					   <?= ceil($item['price'] / $item['cost'] * 100) ?>
					</span>
				<?php endif;?>
				<a href="<?= $TTHelper->getProductUrl($item['url'])?>" class="productImg">
				    <img alt="<?= $item['title']?>" class="lazy" data-original="<?= $TTHelper->getThumbnailUrl('product', $item['imageUrl'], Yii::$app->params['productListImgWidth'], Yii::$app->params['productListImgHeight']);?>" />
				</a>
				<a href="<?= $TTHelper->getProductUrl($item['url'])?>" class="productTitle" title="<?= $item['title']?>"><?= $item['title']?></a>

				<?= $isShowPrice == true ? $TTHelper->productPriceDisplay($item['origprice'], $item['nowprice'], $item['symbol']) : '';?>
				<?php if(intval($item['reviewCount']) > 0):?>
				<div class="productReviews lineBlock">
				    <div class="productStar" style="width:<?= (100 / 5) * $item['avgScore']?>%"> </div>
                </div>
                <p class="lineBlock">(<?= intval($item['reviewCount'])?>)</p>
                <?php endif;?>
			</li>
			<?php endforeach;?>
		</ul>
	</div>
</div>