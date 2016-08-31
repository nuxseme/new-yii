<?php 
/**
 * @desc 产品列表纵向显示
 */
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use common\components\TTPageHelper;

$TTHelper = Yii::$container->get('TTHelper');

//获取图片的宽高
$imgHeight = empty($imgSize['height']) ? Yii::$app->params['productListImgHeight'] : $imgSize['height'] ;
$imgWidth = empty($imgSize['width']) ? Yii::$app->params['productListImgWidth'] : $imgSize['width'] ;
?>
<ul class="lbBox categoryProductList">
	<?php 
	foreach ($items as $key => $data):
		$productUrl = $TTHelper->getProductUrl($data['url']);
	?>
		<li class="productClass lineBlock">
			<div class="pic_wrap">
				<?php if($data['dlist'][0]['origprice'] > $data['dlist'][0]['nowprice']):?>
					<span class="icon-sale"><?= ceil(100 - ($data['dlist'][0]['nowprice'] / $data['dlist'][0]['origprice'] * 100)) ?></span>
				<?php endif;?>
				<a class="productImg" href="<?= $productUrl;?>"><img class="lazy" alt="<?= $data['title']?>" src="<?= $TTHelper->staticPrefix();?>/icon/placeholder.gif" data-original="<?= $TTHelper->getThumbnailUrl('product', $data['imageUrl'], $imgWidth,  $imgHeight);?>"></a>
				<span class="quick_view" dataid="<?=$data['url'];?>"><i></i>Quick view</span>
			</div>
			<!--快速购买开始-->
			<div class="showcase_container">

			</div>
			<!--快速购买结束-->

			<a title="<?= $data['title'];?>" class="productTitle" href="<?= $productUrl;?>"><?= $data['title']?></a>
			<div class="priceWarp">
				<?= $isShowPrice == true ? $TTHelper->productPriceDisplay($data['dlist'][0]['origprice'], $data['dlist'][0]['nowprice'], $data['dlist'][0]['symbol']) : '';?>
			</div>
			<?php if($data['dlist'][0]['freeShipping'] == true):?>
				<p class="freeShipping">Free Shipping</p>
			<?php endif;?>
			<!-- <div class="reviewsWarp">
				<a href="http://www.chicuu.com/review/product/<?= $data['listingId']?>">
					<?php if(intval($data['reviewCount']) > 0):?>
						<div class="productReviews lineBlock">
							<div class="productStar" style="width:<?= (100 / 5) * $data['avgScore']?>%;"> </div>
						</div>
						<p class="lineBlock">(<?= intval($data['reviewCount'])?>)</p>
					<?php else:?>
						Write a Review
					<?php endif;?>
				</a>
				<div class="likes" data-rel="<?= $data['listingId']?>"><i class="icon-heartR"> </i>(<span class="addHeartNum"><?= intval($data['collectNum'])?></span>)</div>
			</div> -->

			<p class="productSKU">SKU:<?= $data['sku']?></p>
			<!--<input class="btn btn-orange" type="button" value="Add To Cart" />-->
			<a href="<?= $productUrl;?>" class="viewDeatils">View details >></a>
		</li>
	<?php $productListingId[] = $data['listingId'];?>
	<?php endforeach;?>
</ul>
<script type="text/javascript">
	var productId = <?= Json::encode($productListingId)?>;
</script>
<!--分页-->
<ul class="lbBox pagingWarp">
	<?= $TTHelper->tomtopPageUrlRewrite($pages->bothNum, $pages->page, $pages->pageNum);?>
</ul>