<?php 
	$TTHelper = Yii::$container->get('TTHelper');
?>
<div class="product_container">
<ul class="product lineBlockBox">
<?php foreach ($products as $key => $value) : ?>
  <li>
      <a href="<?=$TTHelper->getProductUrl($value['url']);?>" class="product_img"><img src="<?= $TTHelper->getThumbnailUrl('product', $value['imageUrl'], Yii::$app->params['productListImgWidth'], Yii::$app->params['productListImgHeight']);?>" alt=""></a>
      <h3><a href="<?=$TTHelper->getProductUrl($value['url']);?>"><?=$value['title']?></a></h3>
   </li>
<?php endforeach;?>
  
</ul>
</div>