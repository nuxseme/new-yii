<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use common\components\AppAsset;
use common\widgets\ProductDisplayWidget;

//注册资源文件
AppAsset::register($this, 'detail');

//助手
$TTHelper = Yii::$container->get('TTHelper');

//货币
$currencyList = $this->context->currencies;

//登陆信息用户
$TT_TOKEN = $TTHelper->getCookie('TT_TOKEN');
$TT_UUID = $TTHelper->getCookie('TT_UUID');
?>

<?php if($productInfo === false): //404page?>
	<?php 
		//注册资源文件
		AppAsset::register($this, 'detail-special');
	?>
	<div class="errorPage contentInside">
		<div class="errorTxt">
			<img src="<?= $TTHelper->staticPrefix();?>/icon/404.png">
			<b>The page you requested can not be found.</b>
			<span>But don't try so hard!</span>
			<div>
				<b>To proceed, you can:</b>
				<hr>
				Go to <a href="<?= Url::home();?>"><?= Url::home();?></a> front page.<br>
				If you need further help, Please contact our <a href="javascript:void(0);">Customer Service Express</a>.
			</div>
		</div>
	</div>
	<?php return; endif;?>
<!--顶部浮动-->
<nav class="contentOut navFixedTop">
	<div class="contentInside">
		<a class="navFixImg lineBlock" href="javascript:void(0)"><img src="<?= $TTHelper->getThumbnailUrl('product', $slideImgList[0]['imgUrl'], Yii::$app->params['productDetailSmallImgWidth'] , Yii::$app->params['productDetailSmallImgHeight']);?>"></a>
		<div class="lineBlock navFixTxt">
			<p class="navFixTitle"><?= $productInfo['title']?></p>
			<p>
				<span class="fz_feng pricelab" usvalue="<?= number_format($productDetailPrice['nowprice'] / $currentRate, 2, '.', '')?>"><?= $productDetailPrice['nowprice']?></span>
				<?php if($item['origprice'] > $item['nowprice']):?>
					<span class="discountFix">Discount<?= ceil(100 - ($item['nowprice'] / $item['origprice'] * 100)) ?>% off</span>
				<?php endif;?>
			</p>
		</div>
		<div class="addCart">
			<?php if($productInfo['status'] == 1 && $productInfo['qty'] > 0):?>
				<a href="javascript:void(0)" class="btn btn-feng" id="add_cartF"><i class="icon-prCart"> </i><?= $TTHelper->getSiteLang('product.addToCart')?></a>
			<?php else:?>
				<span class="btn btn-error"><i class="icon-prCart"> </i><?= $TTHelper->getSiteLang('product.addToCart')?></span>
			<?php endif;?>

		</div>
	</div>
</nav>
<!--顶部浮动 end-->
<section  class="contentInside lbBox">
	<?= ProductDisplayWidget::widget([
		'items'         => $breadCrumbs,
		'displayType'   => ProductDisplayWidget::DISPLAY_TYPE_BREADCRUMBS,
	]);?>
	<!--图片展示-->
	<div class="lbBox showCaseWarp <?php if($imagesDisplayType == 0):?>square_img<?php endif;?>">
		<!-- 图片放大镜 -->
		<?= $imgZoom?>

		<!--右边信息-->
		<div class="lineBlock showInformation">

			<h1><?= $productInfo['title']?><span id="p_sku_s"> ( <?= $TTHelper->getSiteLang('product.item')?>#: <?= $productInfo['sku']?> )</span></h1>
			<div class="shareWarp">
				<?php if($reviewAndStartTotal['result']['count'] > 0):?>
					<a href="#reviewsDetail" class="color666"><div class="productReviews lineBlock">
							<div class="productStar" style="width:<?= (100 / 5) * $reviewAndStartTotal['result']['start']?>%;"> </div>
						</div>
						(<?= $reviewAndStartTotal['result']['count']?> <?= $TTHelper->getSiteLang('product.customerReviews')?>)</a>
				<?php else:?>
					<a class="lineBlock color666" href="<?= Url::toRoute(['review/productreviews','listingId'=>$productInfo['listingId']])?>"><?= $TTHelper->getSiteLang('product.beTheFirstToReview')?></a>
				<?php endif;?>
				<a class="lineBlock" href="javascript:void(0)">
					<i class="icon-hearts lineBlock"> </i>
					<span class="heartNumber lineBlock"><i class="iconLArr"> </i>0</span>
				</a>
				<div class="lineBlock">
					<p class="lineBlock shareTxt"><?= $TTHelper->getSiteLang('product.share')?>:</p>
					<div class="lineBlock">
						<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-532965a902fc0807" async="async"></script>
						<div class="addthis_sharing_toolbox"> </div>
					</div>
				</div>
			</div>
			<div class="saleWarp">
				<?php if($productDetailPrice['origprice'] > $productDetailPrice['nowprice']):?>
					<p class="lineBlock"><?= $TTHelper->getSiteLang('product.regularPrice')?>: <span id="d_origprice" class="pricelab" usvalue="<?= number_format($productDetailPrice['origprice'] / $currentRate, 2, '.', '')?>"><?= $productDetailPrice['origprice']?></span></p>

					<?php
					//	if($productInfo->isOnSale):
					$countdown = $TTHelper->dailyDealsCountdown($productInfo['saleEndDate']);
					?>
					<p class="lineBlock saleOff"><i class="icon-clock-product lineBlock"> </i><?= ceil(100 - ($productDetailPrice['nowprice'] / $productDetailPrice['origprice'] * 100)) ?>% OFF</p><p class="lineBlock"><?= $TTHelper->getSiteLang('product.saleEndsIn')?></p>
					<div class="dealsTime lineBlock countdown">
						<span class="lineBlock hours"><?= $countdown['hours']?></span>:
						<span class="lineBlock minutes"><?= $countdown['mins']?></span>:
						<span class="lineBlock seconds"><?= $countdown['secs']?></span>
					</div>
				<?php endif;?>
			</div>
			<span id="serverTime" class="hide"><?= str_replace('-', '/', substr($serverTime, 0, 10))?></span>
			<div class="priceWarp">
				<p class="lineBlock"><?= $TTHelper->getSiteLang('product.price')?>:</p>
				<div class="lineBlock currency">
					<p><span class="symbolLab"><?= $productDetailPrice['symbol']?></span><i class="icon-arr"> </i></p>
					<ul class="lbUl currencyBox" >
						<?php foreach ($currencyList as $key => $value):?>
							<li><a href="javascript:void(0)" data-currency="<?= $value['code']?>"><em><?= $value['code']?></em><span><?= $value['symbolCode'];?></span></a></li>
						<?php endforeach;?>
					</ul>
				</div>
				<p id="detailPrice" class="lineBlock price pricelab detailPrice" usvalue="<?= number_format($productDetailPrice['nowprice'] / $currentRate, 2, '.', '')?>"><?= $productDetailPrice['nowprice']?></p>
			</div>
			
			<?php if($productInfo['freeShipping']):?>
				<p class="freeShipping"><?= $TTHelper->getSiteLang('home.freeShipping')?></p>
			<?php endif;?>
			
			<!--仓库显示-->
			<div class="lbBox shippingFrom">
				<p class="proColor lineBlock"><span data_key="whouse"><?= $TTHelper->getSiteLang('product.shippingFrom')?></span></p>
				<ul class="selectAttribute lbUl lineBlock" id="wearhouseList">
					<?= $porductStorage?>
				</ul>
			</div>
			
			<?php 
			//库存状态
			if($detailPrice['status'] == 1):?>
				<p class="shippTime"><?php if(($detailPrice['qty']) > 0):?><?= $TTHelper->getSiteLang('common.inStock', 'tomtop')?><?php else:?><?= $TTHelper->getSiteLang('common.outStock', 'tomtop')?><?php endif;?></p>
			<?php elseif($detailPrice['status'] == 2):?>
				<p class="shippTime"><?= $TTHelper->getSiteLang('common.stopSelling')?></p>
			<?php else:?>
				<p class="shippTime"><?= $TTHelper->getSiteLang('common.outStock')?></p>
			<?php endif;?>
			
			<!--属性列表-->
			<?= $productAttrs?>
			<!--属性列表-->

			<!--物流方式-->
			<?= $shipping?>
			<!--物流方式-->
			
			<div class="qty">
				<p class="lineBlock">QTY:</p>
				<div class="lineBlock lbBox qty_wrap">
					<input  class="lineBlock quantity" name="quantity" maxlength="3" id="quantity" value="1" onpaste="return false;" type="text">
					<a href="javascript:void(0)" class="lineBlock next icon_next"></a>
					<a href="javascript:void(0)" class="lineBlock prev icon_prev"></a>
				</div>
			</div>
			<div class="toCart">
				<input type="hidden" name="storageid" id="storageid" value="<?= $defaultWhouse['depotId'];?>">
				<input type="hidden" name="whouse" id="whouse" value="<?= $defaultWhouse['depotName'];?>">
				<input type="hidden" name="listingId" id="listingId" value="<?= $productInfo['listingId']?>">
				<input type="hidden" name="productSku" id="productSku" value="<?= $productInfo['sku']?>">
				<input type="hidden" name="categoryId" id="categoryId" value="<?= $TTHelper->getCateIdBybreadCrumbs($breadCrumbs, 1)?>">
				<input type="hidden" name="parentId" id="parentId" value="<?= $TTHelper->getCateIdBybreadCrumbs($breadCrumbs, 2)?>">
				<div class="addCart lineBlock">
					<?php if($productInfo['status'] == 1 && $productInfo['qty'] > 0):?>
						<a class="btn btn-feng" id="add_cart" href="javascript:void(0)"><i class="icon-prCart"> </i><?= $TTHelper->getSiteLang('product.addToCart')?></a>
					<?php else:?>
						<span class="btn btn-error"><i class="icon-prCart"> </i><?= $TTHelper->getSiteLang('product.addToCart')?></span>
					<?php endif;?>
				</div>
				<!-- <div class="lineBlock">
					<p class="lineBlock shareTxt"><?= $TTHelper->getSiteLang('product.share')?></p>
					<div class="lineBlock">
						<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-532965a902fc0807" async="async"></script>
						<div class="addthis_sharing_toolbox"> </div>
					</div>
				</div> -->
				<div>
					<a class="lineBlock favoritesC" href="javascript:void(0)"><i class="icon-Favorites"> </i><?= $TTHelper->getSiteLang('product.addToFavorites')?></a>
				</div>
				
				<?php if((0&&isset($TT_TOKEN) && $TT_TOKEN != '') && (isset($TT_UUID) && $TT_UUID !='')):?>
					<a class="lineBlock dropshipC" href="javascript:void(0)"><i class="icon-dropship"> </i><?= $TTHelper->getSiteLang('product.addToMyDropship')?></a>
					<a class="lineBlock wholesaleC" href="javascript:void(0)"><i class="icon-wholesale"> </i><?= $TTHelper->getSiteLang('product.addToWholesaleList')?></a>
				<?php endif;?>
			</div>
		</div>
	</div>
</section>

<section class="contentInside proInfWarp lbBox">

	<!--Customers Who Bought This Item Also Bought-->
	<div id="AlsoBought" class="listPageWarp"> </div>
	<!--left-->
	<div class="productLeft lineBlock">


		<!--产品描述-->
		<?= $tabs?>

		<!--描述结束-->
		<!--Also Viewed-->
		<div class="AlsoBoughtWarp">
			<div id="AlsoViewed" class="listPageWarp"> </div>
		</div>
		<!--Also Viewed end-->

		<!--评论评分列表-->
		<?= $reviews?>
	</div>
	<!--right-->
	<div class="productRight lineBlock">
	<!--hotEvent列表-->
	<?= $hotEvent?>
	</div>
</section>
<section id="viewedFeatured" class="contentInside lbBox  historicalWarp"> </section>
<script type="text/javascript">
	<?php
		$jsonArr = [
			'sku' => $productInfo['sku'],
			'price' => $productDetailPrice['origprice'],
			'saleprice' => $productDetailPrice['nowprice'],
			'title' => $productInfo['title'],
			'currency' => $TTHelper->getCookie('TT_CURR'),
			'language' => $TTHelper->getCookie('PLAY_LANG')
		];
	?>
	var product = <?= Json::encode($jsonArr);?>
</script>

<script type="text/javascript">
	var mainContent = <?= $productMainContent?>;
</script>
