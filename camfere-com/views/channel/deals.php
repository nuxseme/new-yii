<?php
use yii\helpers\Url;
use yii\helpers\Json;
use common\components\AppAsset;

//注册资源文件
AppAsset::register($this, 'deals');

$TTHelper = Yii::$container->get('TTHelper');
?>
<section class="contentInside lbBox deals_list">
  <div class="root-nav"> 
     <div class="w"> 
      <div class="breadcrumb"> 
       <strong><a href="<?= Url::home();?>" class="icon-home"></a></strong>
       <span><i class="icon-breadArr"></i>&nbsp;<a href="<?= Url::toRoute(['channel/deals'])?>" >Deals</a></span> 
      </div> 
     </div> 
    </div>
    <!-- end -->
    <div class="screen">
		<h2>Deals</h2>
		<?= $dealsCategory?>
	</div>
	<!-- end -->
   <div class="screens">
		<ul>
      <?php
      $currentSort = Yii::$app->request->get('sort');
      $currentCpath = Yii::$app->request->get('cpath');
      ?>
			<li<?php if($currentSort == 'newest' || empty($currentSort)){echo ' class="select"';}?>>
        <a href="<?= Url::toRoute(['channel/deals', 'sort' => 'newest', 'cpath' => $currentCpath])?>">Newest<i></i></a>
      </li>
			<li<?php if($currentSort == 'hottest'){echo ' class="select"';}?>><a href="<?= Url::toRoute(['channel/deals', 'sort' => 'hottest', 'cpath' => $currentCpath])?>">Hottest<i></i></a></li>
			<li<?php if($currentSort == 'price'){echo ' class="select"';}?>><a href="<?= Url::toRoute(['channel/deals', 'sort' => 'price', 'cpath' => $currentCpath])?>">Price<i></i></a></li>
			<li<?php if($currentSort == 'discount'){echo ' class="select"';}?>><a href="<?= Url::toRoute(['channel/deals', 'sort' => 'discount', 'cpath' => $currentCpath])?>">Discount<i></i></a></li>
		</ul>
	</div>
	<div class="p_list">
		<ul class="presaleListBox">
    		<div id="serverTime" class="hide"><?= $serverTime?></div>	
        <?php foreach ($productList as $key => $data):?>
    	  <li class="lineBlock">
            <div class="productClass">
              <?php if($data['dlist'][0]['origprice'] > $data['dlist'][0]['nowprice']):?>
                <span class="icon-sale"><?= ceil(100 - ($data['dlist'][0]['nowprice'] / $data['dlist'][0]['origprice'] * 100)) ?></span>
              <?php endif;?>
              <a class="productImg" href="<?= $TTHelper->getProductUrl($data['url']);?>">
                <img class="lazy" alt="<?= $data['title']?>" src="<?= $TTHelper->staticPrefix();?>/icon/placeholder.gif" data-original="<?= $TTHelper->getThumbnailUrl('product', $data['imageUrl'], Yii::$app->params['productListImgWidth'], Yii::$app->params['productListImgHeight']);?>" style="display: inline-block;">
              </a>
              <a title="<?= $data['title']?>" class="productTitle" href="<?= $TTHelper->getProductUrl($data['url']);?>"><?= $data['title']?></a>
              <div class="priceWarp">
                <?= $TTHelper->productPriceDisplay($data['dlist'][0]['origprice'], $data['dlist'][0]['nowprice'], $data['dlist'][0]['symbol']);?>
              </div>
              <div class="label">
                <span class="presale_label" style="display:none;">Presale</span>
                <?php if($TTHelper->freeShipingDisplay($data['dlist']) == true):?>
                  <p class="freeShipping">Free Shipping</p>
                <?php endif;?>
              </div>
              <div class="reviewsWarp">
                <a href="<?= Url::toRoute(['review/addreview', 'listingId' => $data['listingId']]);?>">
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
              </div>
                  <div class="warehouseList lbBox">
                    <?php 
                    $i = 1;
                    foreach ($data['dlist'] as $wkey => $wearHostData): 
                    ?>
                      <span class="lineBlock <?php if($i == 1):?>active<?php endif;?>" us-origprice="<?= $wearHostData['origprice'];?>" us-nowprice="<?= $wearHostData['nowprice'];?>" data='<?= Json::encode($wearHostData)?>'>
                        <img title='Shipping From <?= $TTHelper->getCountryByCode($wearHostData['depotName'])?>' src="<?= $TTHelper->staticPrefix();?>/icon/<?= strtolower($wearHostData['depotName'])?>.png" />
                      </span>
                    <?php 
                    $i++;
                    endforeach;
                    ?>
                  </div>
              <p class="productSKU">SKU:<?= $data['sku'];?></p>
              <a href="<?= $TTHelper->getProductUrl($data['url']);?>" class="viewDeatils">View details &gt;&gt;</a>
              <?php 
                $saleEndDate = $data['dlist'][0]['saleEndDate'];
                $countdown = strtotime($saleEndDate) - strtotime($serverTime);
                if(!empty($saleEndDate) && $countdown > 0):
              ?>
                <div class="countdown"><input type="text" value="<?= $countdown?>">Time left:<span>00d:00h:00m:00s</span></div>
              <?php else:?>
                <div class="countdown"><input type="text" value="0">Time left:<span>00d:00h:00m:00s</span></div>
              <?php endif;?>
          </div>
        </li>
        <?php endforeach;?>
  	</ul>
	</div>

  <?php if($pages):?>
	<div class="page">
		<ul class="lbBox pagingWarp">
            <?= $TTHelper->tomtopPageUrlRewrite($pages->bothNum, $pages->page, $pages->pageNum);?>
    </ul>
	</div>
  <?php endif;?>
</section>