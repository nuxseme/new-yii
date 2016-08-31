<?php
use common\components\AppAsset;

AppAsset::register($this, 'review');

$TTHelper = Yii::$container->get('TTHelper');
$this->title = 'Customer Reviews';
?>
<section class="contentInside reviewListWarp">
	<ul class="Bread_crumbs lbBox">
		<li class="Bread_home lineBlock">
			<a class="icon-home" href="/"> </a>
		</li>
		<li class="lineBlock">
			<i class="icon-breadArr"> </i>
			<a href="javascript:void(0);">Customer Reviews</a>
		</li>
	</ul>
	<!--Also Viewed end-->
	<p class="pulTitle">Customer Reviews</p>
	<ul class="lbUl reviewListTitle">
		<li>
			<a class="listImg" href="<?=$basic['url']?>">
				<img src="<?= $basic['defaultImg'];?>" />
			</a>
		</li>
		<li>
			<a class="listTitle" href="<?=$basic['url']?>">
				<h1><?=$basic['title'];?></h1>
			</a>
			<p class="listPrice">Sale Price:<?= $TTHelper->productPriceDisplay($basic['originprice'],$basic['nowprice']) ;?></p>
		</li>
	</ul>
	<?php if(empty($reviewList)):?>
		<!--无评论-->
		<p class="marT15">There are no customer reviews yet. </p>
		<div class="lbBox writeRiviewTitle">
			<ul class="lineBlock proportionStars">
				<li class="lbBox">
					<span class="lineBlock">5 stars</span>
					<div class="lineBlock proportionBox">
						<div> </div>
					</div>
					<span class="lineBlock">0%</span>
				</li>
				<li class="lbBox">
					<span class="lineBlock">4 stars</span>
					<div class="lineBlock proportionBox">
						<div> </div>
					</div>
					<span class="lineBlock">0%</span>
				</li>
				<li class="lbBox">
					<span class="lineBlock">3 stars</span>
					<div class="lineBlock proportionBox">
						<div> </div>
					</div>
					<span class="lineBlock">0%</span>
				</li>
				<li class="lbBox">
					<span class="lineBlock">2 stars</span>
					<div class="lineBlock proportionBox">
						<div> </div>
					</div>
					<span class="lineBlock">0%</span>
				</li>
				<li class="lbBox">
					<span class="lineBlock">1 stars</span>
					<div class="lineBlock proportionBox">
						<div> </div>
					</div>
					<span class="lineBlock">0%</span>
				</li>
			</ul>
			<div class="lineBlock writeRiviewBtn">
				<p>Share your thoughts with other customers and get <b>camfere Points</b>, the first 5 reviews get <b>DOUBLE</b> camfere Points!</p>
				<a class="btn btn-primary" href="<?=\yii\helpers\Url::toRoute(['review/addreview','listingId'=>Yii::$app->request->get('listingId')]);?>">Write a Customer Review</a>
			</div>
		</div>
		<!--无评论 end-->
	<?php else:?>
		<!--有评论-->
		<div class="averageWarp">
			<p class="lineBlock fon14">Average Rating:</p>
			<div class="bigReviews lineBlock">
				<div class="bigStar" style="width:<?=intval($basic['star_start']*20);?>%"> </div>
			</div>
			<b class="lineBlock fon18"><?=$basic['star_start'];?></b>
			<p class="lineBlock">based on <?=$basic['star_count'];?> <a class="fz_blue" href="javascript:;">Customer Review</a></p>
		</div>
		<div class="lbBox writeRiviewTitle">
			<ul class="lineBlock proportionStars">
				<?php foreach($basic['starTotal'] as $sk => $sv):?>
					<li class="lbBox">
						<span class="lineBlock fz_blue"><?=$sv['startNum'];?> stars</span>
						<div class="lineBlock proportionBox">
							<div style="width: <?=$sv['ptage'];?>%"> </div>
						</div>
						<span class="lineBlock"><?=$sv['ptage'];?>%</span>
					</li>
				<?php endforeach;?>
			</ul>
			<div class="lineBlock writeRiviewBtn">
				<p>Share your thoughts with other customers and get <b>camfere Points</b>, the first 5 reviews get <b>DOUBLE</b> camfere Points!</p>
				<a class="btn btn-primary" href="<?=\yii\helpers\Url::toRoute(['review/addreview','listingId'=>Yii::$app->request->get('listingId')]);?>">Write a Customer Review</a>
			</div>
		</div>
		<!--有评论 end-->
	<?php endif;?>
	<ul class="riviewsWarp">
		<?php foreach($reviewList as $key=>$list):
			var_dump($reviewList);exit();
			?>
			<li class="lbBox">
				<div class="riviewsStart lineBlock">
					<ol class="totalPparameter">
						<li>
							<p class="lineBlock">Overall:</p>
							<div class="productReviews lineBlock">
								<div class="productStar" style="width:<?= intval($list['overall']*20);?>%"> </div>
							</div>
						</li>
						<li>
							<p class="lineBlock">Usefulness:</p>
							<div class="productReviews lineBlock">
								<div class="productStar" style="width:<?= intval($list['usefulness']*20);?>%"> </div>
							</div>
						</li>
						<li>
							<p class="lineBlock">Shipping:</p>
							<div class="productReviews lineBlock">
								<div class="productStar" style="width:<?= intval($list['shipping']*20);?>%"> </div>
							</div>
						</li>
						<li>
							<p class="lineBlock">Price:</p>
							<div class="productReviews lineBlock">
								<div class="productStar" style="width:<?= intval($list['price']*20);?>%"> </div>
							</div>
						</li>
						<li>
							<p class="lineBlock">Quality:</p>
							<div class="productReviews lineBlock">
								<div class="productStar" style="width:<?= intval($list['quality']*20);?>%"> </div>
							</div>
						</li>
					</ol>
					<p class="fzDate">By <?= $TTHelper->displayEmail($list['email'])?></p>
					<p class="fzDate"><?= date('F j, Y H:i:s',strtotime($list['commentDate']))?></p>
				</div>
				<div class="riviewsTxt lineBlock">
					<?=$list['comment'];?>
					<ol class="writePic">
						<?php if(!empty($list['imgUrls'])):?>
							<?php foreach($list['imgUrls'] as $k => $img):?>
								<li class="lineBlock"><a href="javascript:;"><img src="<?=$img;?>"></a></li>
							<?php endforeach;?>
						<?php endif;?>
					</ol>
					<!--addPic-->
					<div class="writeAddPic blockPopup_box">
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
					</div>
				</div>
			</li>
		<?php endforeach;?>
	</ul>
	<?php if(!empty($page)):?>
		<ul class="lbBox pagingWarp">
			<?= $page->showpage();?>
		</ul>
	<?php endif;?>
	<!--end-->
</section>