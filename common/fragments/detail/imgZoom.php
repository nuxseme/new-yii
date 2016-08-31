<?php
$TTHelper = Yii::$container->get('TTHelper');
?>
<div class="lineBlock">
	<!--大图展示-->
	<div class="productBigPic_box">
		<ul class="hoverBig">
			<li class="zoom-small-image">
				<a href='<?= $TTHelper->getThumbnailUrl('product', $slideImgList[0]['imgUrl'], Yii::$app->params['productDetailLargeImgWidth'], Yii::$app->params['productDetailLargeImgHeight'], true);?>' class = 'cloud-zoom' id='zoom1' rel="adjustX:10, adjustY:-4">
					<img src="<?= $TTHelper->getThumbnailUrl('product', $slideImgList[0]['imgUrl'], Yii::$app->params['productDetailMediumImgWidth'], Yii::$app->params['productDetailMediumImgHeight']);?>" />
				</a>
			</li>
		</ul>
	</div>
	<!--小图片点击切换-->
	<div class="showCaseSmall_box moveWarp lbBox" id="showCaseSmallPic">
			<a href="javascript:void(0)" class="showCaseL moveLeftClick lineBlock"><i class="icon-smallL"> </i></a>
			<div class="productSmallPic moveHidden lineBlock">
				<ul class="productSmallmove lbBox moveBox">
					<?php foreach ($slideImgList as $key => $imgList):?>
						<li class="lineBlock moveList <?php if($key == 0):?>cpActive<?php endif;?>">
							<a href='<?= $TTHelper->getThumbnailUrl('product', $imgList['imgUrl'], Yii::$app->params['productDetailLargeImgWidth'], Yii::$app->params['productDetailLargeImgHeight'],true);?>' class='cloud-zoom-gallery' rel="useZoom: 'zoom1', smallImage: '<?= $TTHelper->getThumbnailUrl('product', $imgList['imgUrl'], Yii::$app->params['productDetailMediumImgWidth'], Yii::$app->params['productDetailMediumImgHeight']);?>' ">
								<img class="zoom-tiny-image" src="<?= $TTHelper->getThumbnailUrl('product', $imgList['imgUrl'], Yii::$app->params['productDetailSmallImgWidth'], Yii::$app->params['productDetailSmallImgHeight']);?>" />
							</a>
						</li>
					<?php endforeach;?>
				</ul>
			</div>
			<a href="javascript:void(0)" class="showCaseR moveRightClick lineBlock"><i class="icon-smallR"> </i></a>
	</div>
	<!--弹出框-->
	<div class="productBigPop_box blockPopup_box" id="procuctPOP">
		<div class="customer_popBox">
			<div class="close"> </div>
			<div class="customer_popTitle"><?= $productTitle?></div>
			<div class="scrollBox">
				<div class="customer_popPicBox">
					<ul class="customer_bigPic">
						<li class="zoom-small-image" id="bigBacks">
							<a href='<?= $TTHelper->getThumbnailUrl('product', $slideImgList[0]['imgUrl'], Yii::$app->params['productDetailLargeImgWidth'], Yii::$app->params['productDetailLargeImgHeight'], true);?>' class='cloud-zoom' id="zoom2" rel="position:'inside',showTitle:false,adjustX:-4,adjustY:-4">
								<img src="<?= $TTHelper->getThumbnailUrl('product', $slideImgList[0]['imgUrl'], Yii::$app->params['productDetailMediumImgWidth'], Yii::$app->params['productDetailMediumImgHeight']);?>" />
							</a>
						</li>
					</ul>
				</div>
			</div>
			<ul class="customerSmallmove lbBox" id="smallClickUrl">
				<?php foreach ($slideImgList as $key => $imgList):?>
					<li class="productSmallImg lineBlock">
						<a href='<?= $TTHelper->getThumbnailUrl('product', $imgList['imgUrl'], Yii::$app->params['productDetailLargeImgWidth'], Yii::$app->params['productDetailLargeImgHeight'], true);?>' class='cloud-zoom-click' rel="useZoom: 'zoom2', smallImage: '<?= $TTHelper->getThumbnailUrl('product', $imgList['imgUrl'], Yii::$app->params['productDetailMediumImgWidth'], Yii::$app->params['productDetailMediumImgHeight']);?>' ">
							<img src="<?= $TTHelper->getThumbnailUrl('product', $imgList['imgUrl'], Yii::$app->params['productDetailSmallImgWidth'], Yii::$app->params['productDetailSmallImgHeight']);?>" />
						</a>
					</li>
				<?php endforeach;?>
			</ul>
			<div class="customer_popTxt"> </div>
		</div>
		<div class="black"> </div>
	</div>
</div>