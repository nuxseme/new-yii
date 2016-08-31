<?php
/**
 * @desc 轮播式产品展示
 */
use yii\helpers\Html;

//助手类
$TTHelper = Yii::$container->get('TTHelper');
?>
<div class="lbBox listPageTitle">
	<?php if($itemOptions['title'] == 'Customers Who Bought This Item Also Bought'):?>
		<p class="lineBlock"><?= $TTHelper->getSiteLang('product.customersWhoBought')?></p>
	<?php else:?>
		<p class="lineBlock"><?= $TTHelper->getSiteLang('product.customersWhoViewed')?></p>
	<?php endif;?>
	<p class="lineBlock text-right">
		<span class="page">1</span>/<span class="pages"><?= ceil(count($autoPlayProduct) / 5)?></span>
	</p>
</div>
<div class="listMoveWarp <?= $itemOptions['class']?>">
	<?= Html::a('', 'javascript:void(0)', ['class' => 'moveLeftClick leftArr']);?>
	<?= Html::a('', 'javascript:void(0)', ['class' => 'moveRightClick rightArr']);?>
	<div class="moveHidden">
		<div class="feed-scrollbar">
			<span class="feed-scrollbar-track">
				<span class="feed-scrollbar-thumb"> </span>
			</span>
		</div>
		<ul class="moveBox lbUl">
		    <?php 
		    foreach($autoPlayProduct as $item):
		    ?>
			<li class="moveList productClass">
	            <?php if($item['origprice'] > $item['nowprice']):?>
				<span class="icon-sale">
				   <?= ceil(100 - ($item['nowprice'] / $item['origprice'] * 100)) ?>
				</span>
				<?php endif;?>
				<a href="<?= $TTHelper->getProductUrl($item['url']);?>" target="_blank" class="productImg">
				   <img alt="<?= $item['title'];?>" class="lazy" data-original="<?= $TTHelper->getThumbnailUrl('product', $item['imageUrl'], Yii::$app->params['productListImgWidth'], Yii::$app->params['productListImgHeight']);?>" />
				</a>

				<a class="productTitle" title="<?= $item['title'];?>" href="<?= $TTHelper->getProductUrl($item['url']);?>"><?= ($item['title'] ? $item['title'] : $item['title_default'])?></a>
				<?= $TTHelper->productPriceDisplay($item['origprice'], $item['nowprice'], $item['symbol']);?>
				<?php if($item['reviewCount'] > 0):?>
				<div class="productReviews lineBlock">
	                <div class="productStar" style="width:<?= (100 / 5) * $item['avgScore']?>%"> </div>
	            </div>
	            <p class="lineBlock">(<?= $item['reviewCount']?>)</p>
	            <?php endif;?>
			</li>
			<?php endforeach;?>
		</ul>
	</div>
</div>