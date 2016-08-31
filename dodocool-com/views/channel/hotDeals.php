<?php
use common\components\AppAsset;
//注册资源文件
AppAsset::register($this, 'hotdeals');

$TTHelper = Yii::$container->get('TTHelper');
?>
<!--main-->
<div id="main">
 <!--主体内容-->
 <div class="content">
 	<!--banner-->
    <div class="banner w">
         <a href="javascript:void(0)" style="background:url('images/hotdeals_banner.jpg') no-repeat center center"></a>
    </div>
    <!--banner-->
	
	<?php
	if(!empty($products)):
	?>
    <!--国家的国旗-->
    <div class="flag_nav_container">
       <span></span>
       <ul class="tab_nav lineBlockBox">
		<?php
		$countries = array_keys($products);
		$count = 1;
		foreach($countries as $country):
		?>
	    <li class="li<?= $count?>"><span><i></i></span><img src="<?= $TTHelper->staticPrefix();?>/icon/<?= $country?>.gif" alt="<?= $country?>"></li>
	    <?php 
	    	$count++;
	    endforeach;
	    ?>
       </ul>
    </div>
    <!--国家的国旗-->

    <div class="product_container w">
    	<!--楼层-->
    	<?php
    	foreach($countries as $country):
    	?>
        <div class="floor floor01">
          <div class="tt">
              <div class="share"><img src="<?= $TTHelper->staticPrefix();?>/icon/share_icon.jpg" alt=""></div>
              <div class="tag lineBlockBox">
                   <div class="hd"><i><img src="<?= $TTHelper->staticPrefix();?>/icon/<?= $country?>.jpg" alt="<?= $country?>"></i></div>
                   <em class="bd"><?= $country?></em>
                   <span class="ft"></span>
              </div>
          </div>
          <ul class="product lineBlockBox">
			<?php
			foreach($products[$country] as $product):
			?>
            <li>
                <a href="javascript:void(0)" class="product_img"><img src="?= $TTHelper->getThumbnailUrl('product', $product['imageUrl'], Yii::$app->params['productListImgHeight'], Yii::$app->params['productListImgWidth'])?>" alt="<?= $product['title']?>"></a>
                <div class="info">
                    <h3><a href="javascript:void(0)"><?= $product['title'];?></a></h3>
                    <div class="price">
                          <span class="origin_price"><?= $product['currencySymbol'] . $product['oldPrice'];?></span>
                          <span class="present_price"><?= $product['currencySymbol'] . $product['newPrice'];?></span>
                    </div>
                    <div class="coupon clearfix">
                          <input type="button" value="copy" class="copy_btn">
                          <p><span>Coupon: </span><em><?= $product['coupon'];?></em><input type="text" value="<?= $product['coupon'];?>" class="coupon_val"></p>
                    </div>
                    <div class="bt">
                          <p>End on <?= $product['endDate']?></p>
                          <input type="button" value="Buy at amazon">
                    </div>
                </div>
            </li>
			<?php 
			endforeach;
			?>
          </ul>
        </div>
        <?php
        endforeach;
        ?>
        <!--楼层-->
    </div>
	<?php
	else:
	?>
	no results
	<?php 
	endif;
	?>
</div>
 <!--主体内容 end-->        
</div>
<!--main end-->