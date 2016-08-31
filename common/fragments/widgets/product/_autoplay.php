<?php
/**
 * @desc 轮播式产品展示
 */
use yii\helpers\Html;
use yii\helpers\Url;

//公用助手类
$TTHelper = Yii::$container->get('TTHelper');

//获取图片的宽高
$imgHeight = empty($imgSize['height']) ? Yii::$app->params['productListImgHeight'] : $imgSize['height'] ;
$imgWidth = empty($imgSize['width']) ? Yii::$app->params['productListImgWidth'] : $imgSize['width'] ;

?>
<?php if(isset($includeHeader) && $includeHeader):?>
<div class="listPageWarp" id="<?= $itemOptions['class']?>">
    <div class="lbBox listPageTitle">
		<p class="lineBlock"><?= $title?></p>
		<?php if($itemOptions['class'] == 'topSellers' || $itemOptions['class'] == 'newArrivals'):?>
			<?php if($itemOptions['class'] == 'topSellers'):?>
				<a class="lineBlock marL10 txt_cap text-right" title="<?= $TTHelper->getSiteLang('common.more')?> <?= $TTHelper->getSiteLang('home.topSellers')?>" href="<?= $TTHelper->TomtomHrefLink('product/hot') ?>"><?= $TTHelper->getSiteLang('common.more')?></a>
			<?php else:?>
				<a class="lineBlock marL10 txt_cap text-right" title="<?= $TTHelper->getSiteLang('common.more')?> <?= $TTHelper->getSiteLang('home.newArrivals')?>" href="<?= Url::toRoute('channel/newarrivals');?>"><?= $TTHelper->getSiteLang('common.more')?></a>
			<?php endif;?>
		<?php endif;?>
		<p class="lineBlock text-right">
			<span class="page">1</span>/<span class="pages"><?= ceil(count($items) / $per);?></span>
		</p>
	</div>
<?php endif;?>
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
			    <?php foreach($items as $item):?>
				<li class="moveList productClass">
                    <?php if($item['origprice'] > $item['nowprice']):?>
					<span class="icon-sale">
					   <?= ceil(100 - ($item['nowprice'] / $item['origprice'] * 100)) ?>
					</span>
					<?php endif;?>
				    <?= Html::beginTag('a', ['class' => 'productImg', 'href' => $TTHelper->getProductUrl($item['url'])]) ?>
					   <img alt="<?= $item['title']?>" class="lazy" data-original="<?= $TTHelper->getThumbnailUrl('product', $item['imageUrl'], $imgWidth, $imgHeight);?>" />
					<?= Html::endTag('a')?>
					<?= Html::a(
								    $item['title'] ? $item['title'] : $item['title_default'],
								    $TTHelper->getProductUrl($item['url']),
								    ['class' => 'productTitle', 'title'=>$item['title']]
								);
					?>
					<?php if($isShowPrice):?>
					<p><?= $TTHelper->productPriceDisplay($item['origprice'], $item['nowprice'], $item['symbol']);?></p>
					<?php endif; ?>
					<?php if($item['reviewCount'] > 0):?>
					<div>
						<div class="productReviews lineBlock">
							<div class="productStar" style="width:<?= (100 / 5) * $item['avgScore'] ?>%;"> </div>
						</div>
	                	<p class="lineBlock vMiddle">(<?= $item['reviewCount']?>)</p>
						<span class=""><i></i><em></em></span>
					</div>
	                <?php endif;?>
				</li>
				<?php endforeach;?>
			</ul>
		</div>
	</div>
<?php if(isset($includeHeader) && $includeHeader):?>
</div>
<?php endif;?>