<?php
use common\components\AppAsset;
use yii\helpers\Url;

$this->title = 'Write a review';
$TTHelper = Yii::$container->get('TTHelper');

//注册资源文件
AppAsset::register($this, 'review');
?>
<section class="contentInside">
		<ul class="Bread_crumbs lbBox">
			<li class="Bread_home lineBlock">
				<a class="icon-home" href="/"> </a>
			</li>
			<li class="lineBlock">
				<i class="icon-breadArr"> </i>
				<a href="javascript:void(0);">Write a review</a>
			</li>
		</ul>
		<!--Also Viewed end-->
		<ul class="lbUl writeReviewWarp">
			<li class="writeLeft">
				<a class="writeImg" href="<?=$basic['url']?>"><img src="<?=$basic['defaultImg'];?>" /></a>
				<a class="writeTitle" href="<?=$basic['url']?>"><?=$basic['title'];?> </a>
				<p class="writePrice">Sale Price:<?= $TTHelper->productPriceDisplay($basic['originprice'],$basic['nowprice']) ;?></p>
				<h5>Average Customer Review</h5>
				<div class="averageWarp">
					<div class="bigReviews lineBlock">
				        <div class="bigStar" style="width:<?=$basic['star_start']*20?>%"> </div>
				    </div>
				    <b class="lineBlock fon18"><?=$basic['star_start']?></b>
					<p>based on <?=$basic['star_count'];?>Customer Review</p>
				</div>
				<div class="lbBox writeRiviewTitle">
					<ul class="lineBlock proportionStars">
						<?php foreach($basic['starTotal'] as $starTotal):?>
						<li class="lbBox">
							<span class="lineBlock fz_blue"><?=$starTotal['startNum'];?> stars</span>
							<div class="lineBlock proportionBox">
								<div style="width: <?=$starTotal['ptage']?>%"> </div>
							</div>
							<span class="lineBlock"><?php if($starTotal['ptage']):?><?=$starTotal['ptage']?>%<?php endif;?></span>
						</li>
						<?php endforeach;?>
					</ul>
				</div>
				<div class="writeReview_leftB">
                	<h5>Tips for writing reviews</h5>
                    <p>Your review should focus on specific features of the product and your experience with it. For video reviews, we recommend that you write a brief introduction. </p>
                    <p>We welcome your honest opinion about the product--positive or negative.We believe all helpful information can inform our customers' buying decisions. </p>
                    <h5>Contents for what's not allowed</h5>
                    <ul>
                    	<li>Obscene or distasteful content.</li>
                    	<li>Profanity or spiteful remarks. </li>
                    	<li>Any comments of racial or religious discrimination. </li>
                    	<li>Promotion of illegal or immoral conduct. </li>
                    	<li>Phone numbers, postal mailing addresses. </li>
                    </ul>
                </div>
			</li>

			<li class="writeRight">
				<form action="<?= Url::toRoute(['review/write'])?>" id="editReviewInfo" method="POST" enctype="multipart/form-data">
			    <input type="hidden" name="listingId" value="<?= $basic['listingId']?>">
			    <input type="hidden" name="sku" value="<?= $basic['sku']?>">
			    <input type="hidden" name="oid" value="<?= $_GET['oid']?>">
			    <input type="hidden" name="source" value="add">
				<p class="writeRtitle">
					<b>Write a review </b>
					<span> (*Indicates required fields)</span>
				</p>
				<table cellpadding="0" cellspacing="0" border="0" class="writeTable">
					<tr>
						<td colspan="2">
							<ul class="startUL">
				                <li class="startTxt">Price:</li>
				                <li class="startEdi">
				                	<input type="hidden" value="5" name="ipriceStarWidth">
				                    <div id="ipriceStarWidth" class="product_Reviews start5">
				                        <em class="starOne"></em>
				                        <em class="starTwo"></em>
				                        <em class="starThree"></em>
				                        <em class="starFour"></em>
				                        <em class="starFive"></em>
				                    </div> 
				                </li>
				                <li class="startTxt">Quality:</li>
				                <li class="startEdi">
				                	<input type="hidden" value="5" name="iqualityStarWidth">
				                    <div id="iqualityStarWidth" class="product_Reviews start5">
				                        <em class="starOne"></em>
				                        <em class="starTwo"></em>
				                        <em class="starThree"></em>
				                        <em class="starFour"></em>
				                        <em class="starFive"></em>
				                    </div> 
				                </li>
				                <li class="startTxt">Usefulness:</li>
				                <li class="startEdi">
				                	<input type="hidden" value="5" name="iusefulness">
				                    <div id="iusefulness" class="product_Reviews start5">
				                        <em class="starOne"></em>
				                        <em class="starTwo"></em>
				                        <em class="starThree"></em>
				                        <em class="starFour"></em>
				                        <em class="starFive"></em>
				                    </div> 
				                </li>
				                <li class="startTxt">Shipping:</li>
				                <li class="startEdi">
				                	<input type="hidden" value="5" name="ishippingStarWidth">
				                    <div id="ishippingStarWidth" class="product_Reviews start5">
				                        <em class="starOne"></em>
				                        <em class="starTwo"></em>
				                        <em class="starThree"></em>
				                        <em class="starFour"></em>
				                        <em class="starFive"></em>
				                    </div> 
				                </li>
				                <li class="startTxt startAll">Overall Rating:</li>
				                <li class="startAll">
				                    <div class="product_Reviews">
				                        <input type="hidden" value="5" name="foverallratingStarWidth">
				                        <div style="width:100%" class="product_Start" id="foverallratingStarWidth"></div>
				                    </div> 
				                </li>
				            </ul>
						</td>
					</tr>
					<tr class="controls">
						<td>Reviews:<span class="red">*</span></td>
						<td>
							<textarea class="reviews emptys" autocomplete="off" name="ccomment" required="required" oninvalid="setCustomValidity('Can not be empty')" oninput="setCustomValidity('')"></textarea>
							<span class="help-block"></span>
						</td>
					</tr>
				</table>
				<p class="writeRtitle">
					<b>Write a review </b>
				</p>
				<ul id="result" class="addPic_Box lbUl">
            		<li class="addPic lineBlock add-pic-btn" id="addPic"></li>
                </ul>
                <p class="picmax">Max 4 images, 5MB per image，Format: jpeg/jpg/gif/png/bmp Clear photos are much appreciated!</p>
                <table cellpadding="0" cellspacing="0" border="0" class="writeTable writevideo">
                	<tr>
                		<td>Video:</td>
                		<td><input type="text" autocomplete="off" name="commentVideoUrl" placeholder="Paste Your YouTube Video URL" /></td>
                	</tr>
                	<tr class="writepad">
                		<td></td>
                		<td>Share a video with your review, please make sure your video is related to the product </td>
                	</tr>
                	<tr>
                		<td>Video Title:</td>
                		<td><input type="text" autocomplete="off" name="videoTitle" /></td>
                	</tr>
                	<tr>
                		<td></td>
                		<td>
                			<input id="subWrite" class="btn btn-orange" type="submit" value="Submit" />
                		</td>
                	</tr>
                </table>
				</form>
			</li>
		</ul>
		<!--end-->
</section>