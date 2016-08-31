<?php
use yii\helpers\Url;

$TTHelper = Yii::$container->get('TTHelper');
//print_r($products);
?>
<div class="tab_container w">
  <div class="tab_info">
        <div class="tag_nav">
          <ul class="lineBlockBox">
          <?php 
          foreach ($products as $key=>$value):?>
            <li><a href="#<?=$value['cname']?>"><?=$value['cname']?></a></li>
          <?php endforeach;
          ?>
          </ul>
        </div>
        <div class="product_container">

          <?php foreach ($products as $key => $value) : ?>

          <div class="category_tt">
            <h3><a name="<?=$value['cname']?>"></a><?=$value['cname']?></h3>
            <!--p>Successor to the Astro series, Amazon’s best-selling portable charger of all time.</p-->
          </div>
          <ul class="product lineBlockBox">
            <?php 
            foreach ($value['products'] as $item) 
            { 
            ?>
            <li>
              <div class="product_img">
                <a href="<?=$TTHelper->getProductUrl($item['url']);?>"><img src="<?= $TTHelper->getThumbnailUrl('product', $item['imageUrl'], Yii::$app->params['productListImgWidth'], Yii::$app->params['productListImgHeight']);?>" alt="<?= $item['title'];?>"></a>
                <span class="quick_view" data-title="<?= $item['title'];?>" data-cpath="<?= $item['url']?>"><i></i>Quick view</span>
              </div>
              <h3 class="quick_view_slibings"><a href="<?=$TTHelper->getProductUrl($item['url']);?>"><?=$item['title']?></a></h3>
            </li>
            <?php 
            }
            ?>
          </ul>
          <?php endforeach; ?>
        </div>
  </div>
</div>
      
