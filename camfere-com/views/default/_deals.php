<?php
/**
 * @desc 轮播式产品展示
 */
use yii\helpers\Url;

//助手类
$TTHelper = Yii::$container->get('TTHelper');

$countdown = $TTHelper->dailyDealsCountdown();
?>
<div class="dailyActivity">
    <div class="dailyAct_tltle"> Deals & Promotions<a href="<?= Url::toRoute(['channel/deals']);?>">More...</a></div>
    <div class="dailyAct_wrap">
		<?php if(!empty($dailyDeal)):?>
	    <div class="dailyAct_left">
	             <span class="dailyAct_left_title">Daily Deals</span>
	             <a href="<?= $TTHelper->getProductUrl($dailyDeal['url']);?>"><img src="<?= $TTHelper->getThumbnailUrl('product', $dailyDeal['imageUrl'], Yii::$app->params['homeDailyDealsImgWidth'], Yii::$app->params['homeDailyDealsImgHeight']);?>"></a>
	             <div class='dailyAct_txtGroup'>
	                <a class="productTitle2" title="<?= $dailyDeal['title'];?>" href="<?= $TTHelper->getProductUrl($dailyDeal['url']);?>"><?= $dailyDeal['title'];?></a>
	                <?= $TTHelper->productPriceDisplay($dailyDeal['origprice'], $dailyDeal['nowprice'], $dailyDeal['symbol']);?>
	                <span class="productOff">(<i><?= ceil(100 - ($dailyDeal['nowprice'] / $dailyDeal['origprice'] * 100));?>%</i> off)</span>
	             </div>
	             <div class="time_">
	             	<?php 
	             		$seconds =  $countDown['hours'] * 3600 + $countDown['mins'] * 60 + $countdown['secs'];
	             		$displayCountDown = '';
	             		$displayCountDown = (intval($countDown['hours']) <= 0 ? '00' : $countDown['hours']);
	             		$displayCountDown .= ':';
	             		$displayCountDown .= (intval($countDown['mins']) <= 0 ? '00' : $countDown['mins']);
	             		$displayCountDown .= ':';
	             		$displayCountDown .= (intval($countDown['secs']) <= 0 ? '00' : $countDown['secs']);
	             	?>
	                <div class="time_countDown" data-val="<?= $seconds?>" id="time_countDown"><span><?= $displayCountDown;?></span></div>
	             </div>
	    </div>
	    <?php endif;?>
	
	 	<?php if(!empty($promotionDeals)):?>
	    <div class="dailyAct_right">
	         <ul class="dailyAct_right_list">
				<?php foreach($promotionDeals as $item):?>
	            <li>
	               <a href="<?= $TTHelper->getProductUrl($item['url']);?>">
	               	<img src="<?= $TTHelper->getThumbnailUrl('product', $item['imageUrl'], Yii::$app->params['productListImgWidth'], Yii::$app->params['productListImgHeight']);?>">
	               </a>
	               <div class="dailyAct_txtGroup">
							 <div class="productTitle3"> 
							 	<a title="<?= $item['title']?>" href="<?= $TTHelper->getProductUrl($item['url']);?>"><?= $item['title']?></a>
							</div>
	                    <?php 
	                        $info = $item['dlist'][0];//取数组第0个为默认
	                    ?>
	                    <?= $TTHelper->productPriceDisplay($info['origprice'], $info['nowprice'], $info['symbol']);?>
	                    <?php if($info['nowprice'] < $info['origprice']):?>
	                    <span class="productOff">(<i><?= ceil(100 - ($info['nowprice'] / $info['origprice'] * 100)) ?>%</i> off)</span>
	               		<?php endif;?>
	               </div>
	            </li>
	            <?php endforeach;?>
	         </ul>
	    </div>
	    <?php endif; ?>
    </div>
</div>