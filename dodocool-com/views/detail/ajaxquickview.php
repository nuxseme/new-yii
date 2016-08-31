<?php
$TTHelper = Yii::$container->get('TTHelper');
?>

<div class="bd clearfix">
     <div class="pic">
          <img src="<?= $TTHelper->getThumbnailUrl('product', $imageUrl, Yii::$app->params['productListImgWidth'], Yii::$app->params['productListImgHeight']);?>" alt="">
     </div>
     <div class="attribute">
          <?= $porductStorage; ?>
          <?= $productAttrs; ?>
          <a class="yellow_btn" href="javascript:void(0)">Buy at Amazon</a>
      </div>
</div>
<!-- js变量 -->
<?= $jsvars?>
<!-- js变量 -->