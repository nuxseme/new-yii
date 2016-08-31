<?php
use common\components\AppAsset;


//注册资源文件
AppAsset::register($this, 'index');

$TTHelper = Yii::$container->get('TTHelper');
?>

<section class="contentInside lbBox">
	<div class=" lineBlock">
		<div class="banner_total">
			<!--banner-->
			<?= $sliderBanners?>
			<!--end banner-->
			<!--banner_right-->
			<?= $rightBanners?>
			<!--end banner_right-->
		</div>

		<div class="dailyActivity dailyDeals">
		</div>
		
		<!-- <div class="dailyDeals"> </div> -->

		<!--New Arrivals -->
		<?php if($newArrivals){ echo $newArrivals;}?>
			
    <!--Featured-->
		<?php
			if($featured){ echo $featured;}
		?>
		<!--Products You Might Like -->
		</div>
		<div class="home_banner">
            <p>Why<br><span>Choose us?</span></p>
            <img alt="TOMTOP" src="<?= $TTHelper->staticPrefix();?>/icon/logo.png">
            <ul class="home_banner_txt">
               <li>
                  <strong>Focus on Digital Photography Line</strong>
                  <span>Camera Accessories</span>
               </li>
                <li>
                  <strong>Worldwide Shipping</strong>
                  <span>3 - 25 Business Days Delivered</span>
               </li>
                <li>
                  <strong>Shop Safely</strong>
                  <span>Secured by Godaddy and Paypal</span>
               </li>
                <li>
                  <strong>Return & Exchange</strong>
                  <span>Easy 30-Day Return Policy</span>
               </li>
            </ul>
		</div>
</section>
