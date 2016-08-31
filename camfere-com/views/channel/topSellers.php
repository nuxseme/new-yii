<?php
use yii\helpers\Url;
use common\components\AppAsset;
//排序
$sort = Yii::$app->request->get('sort');

$cpath = Yii::$app->request->get('cpath');

$TTHelper = Yii::$container->get('TTHelper');

//注册资源文件
AppAsset::register($this, 'topsellers');
?>
<!-- content-begin -->
<section class="contentInside lbBox"> 
 <div class="root-nav"> 
   <div class="w"> 
    <div class="breadcrumb"> 
     <strong><a href="<?= Url::home();?>" class="icon-home"></a></strong>
     <span><i class="icon-breadArr"></i>&nbsp;<a href="<?= Url::toRoute('channel/topsellers')?>" >Top Sellers</a></span> 
    </div> 
   </div> 
  </div>
 <!--左侧筛选条件-->
 <?= $leftFiltering?>
  
 <?php if($categoryToProduct):?>
 <div class="lineBlock categoryWarpRight"> 
 <?php 
  foreach ($categoryToProduct as $key => $value):
  $categoryInfo = explode('|',$key);
  ?>
  <h3><span><?= $categoryInfo[0]?></span><a href="<?= Url::toRoute(['channel/topsellers-list', 'cpath' => $categoryInfo[1]]);?>"><?= $TTHelper->getSiteLang('common.more'); ?>More</a></h3>
  <div class="p_list">
    <ul class="lbBox categoryProductList">
      <?php foreach ($value as $k => $item):?>
      <li class="lineBlock">
        <div class="productClass">
            <?php if($item['dlist'][0]['origprice'] > $item['dlist'][0]['nowprice']):?>
              <span class="icon-sale"><?= ceil(100 - ($item['dlist'][0]['nowprice'] / $item['dlist'][0]['origprice'] * 100)) ?></span>
            <?php endif;?>
            <a class="productImg" href="<?= $TTHelper->getProductUrl($item['url']);?>">
                <img class="lazy" alt="<?= $item['title']?>" src="<?= $TTHelper->staticPrefix();?>/icon/placeholder.gif" data-original="<?= $TTHelper->getThumbnailUrl('product', $item['imageUrl'], Yii::$app->params['productListImgWidth'], Yii::$app->params['productListImgHeight']);?>" style="display: inline-block;">
            </a>
            <a class="productTitle" href="<?= $TTHelper->getProductUrl($item['url']);?>"><?= $item['title']?></a>
            <div class="priceWarp">
              <?= $TTHelper->productPriceDisplay($item['dlist'][0]['origprice'], $item['dlist'][0]['nowprice'], $data['dlist'][0]['symbol']);?>
            </div>
            <?php if($TTHelper->freeShipingDisplay($item['dlist']) == true):?>
            <div class="label">
              <p class="freeShipping">Free Shipping</p>
            </div>
            <?php endif;?>
            <div class="reviewsWarp">
              <a href="<?= Url::toRoute(['review/addreview', 'listingId' => $item['listingId']]);?>">
                <?php if(intval($item['reviewCount'])>0):?>
                <div class="productReviews lineBlock">
                  <div class="productStar" style="width:<?= (100 / 5) * $item['avgScore']?>%;"> </div>
                </div>
                <p class="lineBlock">(<?= intval($item['reviewCount'])?>)</p>
                <?php else:?>
                  Write a Review
                <?php endif;?>
              </a>
              <div class="likes" data-rel="<?= $value['listingId']?>"><i class="icon-heartR"> </i>(<span class="addHeartNum"><?= intval($item['collectNum'])?></span>)</div>
            </div>
            <div class="warehouseList lbBox">
              <?php 
              $i = 1;
              foreach ($data['dlist'] as $wkey => $wearHostData): 
              ?>
                <span class="lineBlock <?php if($i == 1):?>active<?php endif;?>" us-origprice="<?= $TTHelper->getCurrentRatePrice($wearHostData['origprice']);?>" us-nowprice="<?= $TTHelper->getCurrentRatePrice($wearHostData['nowprice']);?>" data='<?= Json::encode($wearHostData)?>'>
                  <img title='Shipping From <?= $TTHelper->getCountryByCode($wearHostData['depotName'])?>' src="<?= $TTHelper->staticPrefix();?>/icon/<?= strtolower($wearHostData['depotName'])?>.png" />
                </span>
              <?php 
              $i++;
              endforeach;
              ?>
            </div>
          </div>
      </li>
      <?php endforeach;?> 
    </ul>
  </div>
  <?php endforeach;?>
</div> 
<?php else:?>
  <div class="searchNone">
    <p>Sorry, No Products Found!</p>
    <a class="btn btn-orange" href="http://www.tomtop.com">Continue Shopping</a>
  </div>
<?php endif;?>
</section> 
  <!-- conetent-end -->