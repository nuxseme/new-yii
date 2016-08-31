<?php
use yii\helpers\Url;

$TTHelper = Yii::$container->get('TTHelper');
?>
<span id="reviewsDetail" name="reviewsDetail"> </span>
<p class="pulTitle"><?= $TTHelper->getSiteLang('product.customerReviews') ?></p>
<?php if($reviewAndStartTotal['result']['count'] == 0):?>
	<!--无评论-->
	<p class="marT15"><?= $TTHelper->getSiteLang('product.thereAreNoReviews') ?></p>
	<!--无评论 end-->
<?php else:?>
	<!--有评论-->
	<div class="averageWarp">
		<p class="lineBlock fon14"><?= $TTHelper->getSiteLang('product.averageRating') ?>:</p>
		<div class="bigReviews lineBlock">
			<div class="bigStar" style="width:<?= (100 / 5) * $reviewAndStartTotal['result']['start']?>%;"> </div>
		</div>
		<b class="lineBlock fon18"><?= $reviewAndStartTotal['result']['start']?></b>
		<p class="lineBlock"><?= $TTHelper->getSiteLang('common.basedOn')?> <?= $reviewAndStartTotal['result']['count']?> <a class="color666" href="http://www.chicuu.com/review/product/<?= $productInfo['listingId']?>"><?= $TTHelper->getSiteLang('product.customerReviews') ?></a></p>
	</div>
<?php endif;?>
<div class="lbBox writeRiviewTitle">
	<ul class="lineBlock proportionStars">
		<?php for ($i = 5; $i > 0; $i--){?>
			<li class="lbBox">
				<span class="lineBlock color999"><?= $i?> <?= $TTHelper->getSiteLang('common.stars')?></span>
				<div class="lineBlock proportionBox">
					<div style="width: <?= $reviewAndStartTotal['startToPtage'][$i]?>%"> </div>
				</div>
				<?php if((int)$reviewAndStartTotal['startToPtage'][$i] > 0):?>
					<span class="lineBlock color6d"><?= $reviewAndStartTotal['startToPtage'][$i]?>%</span>
				<?php endif;?>
			</li>
		<?php }?>
	</ul>
	<div class="lineBlock writeRiviewBtn">
		<p><?= $TTHelper->getSiteLang('product.shareYourThoughts')?></p>
		<a class="btn btn-primary" href="<?= Url::toRoute(['review/addreview', 'listingId' => $listingId]);?>"><?= $TTHelper->getSiteLang('product.writeCustomerReview') ?></a>
	</div>
</div>
<!--有评论 end-->
<ul class="riviewsWarp">
	<?php foreach ($reviewList as $key => $data):?>
		<li class="lbBox">
			<div class="riviewsStart lineBlock">
				<ol class="totalPparameter">
					<li>
						<p class="lineBlock"><?= $TTHelper->getSiteLang('product.overall') ?>:</p>
						<div class="productReviews lineBlock">
							<div class="productStar" style="width:<?= $data['overall'] * 20;?>%"> </div>
						</div>
					</li>
					<li>
						<p class="lineBlock"><?= $TTHelper->getSiteLang('product.usefulness') ?>:</p>
						<div class="productReviews lineBlock">
							<div class="productStar" style="width:<?= $data['usefulness'] * 20;?>%"> </div>
						</div>
					</li>
					<li>
						<p class="lineBlock"><?= $TTHelper->getSiteLang('product.shipping') ?>:</p>
						<div class="productReviews lineBlock">
							<div class="productStar" style="width:<?= $data['shipping'] * 20;?>%"> </div>
						</div>
					</li>
					<li>
						<p class="lineBlock"><?= $TTHelper->getSiteLang('product.price') ?>:</p>
						<div class="productReviews lineBlock"> 
							<div class="productStar" style="width:<?= $data['price'] * 20;?>%"> </div>
						</div>
					</li>
					<li>
						<p class="lineBlock"><?= $TTHelper->getSiteLang('product.quality') ?>:</p>
						<div class="productReviews lineBlock">
							<div class="productStar" style="width:<?= $data['quality'] * 20;?>%"> </div>
						</div>
					</li>
				</ol>
				<p class="fzDate">By <?= $TTHelper->displayEmail($data['email'])?></p>
				<p class="fzDate"><?= date('F j, Y H:i:s', strtotime($data['commentDate']))?></p>
			</div>
			<div class="riviewsTxt lineBlock">
				<?= $data['comment']?>
				<ol class="writePic">
					<?php foreach ((array)$data['imgUrls'] as $imgData):?>
						<li class="lineBlock"><a href="javascript:void(0)"><img src="<?= $imgData?>"></a></li>
					<?php endforeach;?>
				</ol>
				<!--addPic-->
				<!--<div class="writeAddPic blockPopup_box">
                     <div class="writeAddPicBox">
                            <div class="close"> </div>
                            <div class="AddPicLClick leftArr"> </div>
                            <div class="AddPicRClick rightArr"> </div>
                            <ul class="customer_bigPic">
                                <li><img class="lazy" data-original="img/product_01.jpg" /></li>
                                <li><img class="lazy" data-original="img/product_02.jpg" /></li>
                                <li><img class="lazy" data-original="img/product_03.jpg" /></li>
                            </ul>
                    </div>
                    <div class="black"> </div>
                </div>-->
			</div>
			<!--<div class="reviewsHelpfu lineBlock">
                <p>Was this review helpful to you?</p>
                <a class="lineBlock" href="javascript:void(0)">Yes<span><i class="iconLArr"> </i>1223</span></a>
                <a class="lineBlock" href="javascript:void(0)">No<span><i class="iconLArr"> </i>12</span></a>
            </div>-->
		</li>
	<?php endforeach;?>
</ul>
<?php if($reviewAndStartTotal['result']['count']>0):?>
	<a class="seeAll_A" href="<?= Url::toRoute(['review/productreviews','listingId'=>$listingId])?>"><?= $TTHelper->getSiteLang('product.seeAllCustomerReviews')?></a>
<?php else:?>
	<a class="seeAll_A" href="<?= Url::toRoute(['review/productreviews','listingId'=>$listingId])?>"><?= $TTHelper->getSiteLang('product.beTheFirstToReview')?></a>
<?php endif;?>
<!--end-->