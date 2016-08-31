<?php
use yii\helpers\Url;
$TTHelper = Yii::$container->get('TTHelper'); 

$sort = Yii::$app->request->get('sort');
?>
<div class="root-nav"> 
 <div class="w"> 
  <div class="breadcrumb"> 
   <strong><a href="<?= Url::home();?>" class="icon-home"></a></strong>
   <span><i class="icon-breadArr"></i>&nbsp;<a href="<?= $breadcrumbUrl;?>" ><?= $breadcrumbName;?></a></span> 
  </div> 
 </div> 
</div>
<div class="categoryNavWarp">
  <p>
    <?php $toNumber = ($pages->total * 1 < 40) ? $pages->total : $displayNumber['toNumber'];?>
    <?= $displayNumber['startNumber']?>-<?= ($toNumber < $pages->total) ? $toNumber : $pages->total?> of <?= $pages->total?> results      
  </p>
  <ul class="lbBox cateforySelect">
    <li class="lineBlock">
        <?= $TTHelper->getSiteLang('catalog.sort')?>        
        <div class="lineBlock selectWarp lbBox">
          <div class="lineBlock selectTxt"><?= $TTHelper->getSiteLang('catalog.featured')?></div>
          <a class="lineBlock selectBtn" href="javascript:void(0)"> </a>
          <ol class="selectValue">
            <li data-rel="featured"<?php if($sort == 'featured' || $sort == ''):?> class="active"<?php endif;?>><?= $TTHelper->getSiteLang('catalog.featured')?></li>
                <li data-rel="releaseTime"<?php if($sort == 'releaseTime'):?> class="active"<?php endif;?>><?= $TTHelper->getSiteLang('catalog.newest')?></li>
                <li data-rel="salesVolume"<?php if($sort == 'salesVolume'):?> class="active"<?php endif;?>><?= $TTHelper->getSiteLang('catalog.mostPopular')?></li>
                <li data-rel="reviewCount"<?php if($sort == 'reviewCount'):?> class="active"<?php endif;?>><?= $TTHelper->getSiteLang('catalog.mostReviews')?></li>
                <li data-rel="pirceAsc"<?php if($sort == 'pirceAsc'):?> class="active"<?php endif;?>><?= $TTHelper->getSiteLang('catalog.priceLowToHigh')?></li>
                <li data-rel="pirceDesc"<?php if($sort == 'pirceDesc'):?> class="active"<?php endif;?>><?= $TTHelper->getSiteLang('catalog.priceHighToLow')?></li>
          </ol>
        </div>
    </li>
    <li class="lineBlock">
      <a class="icon-showList active" href="javascript:void(0)"> </a>
    </li>
    <li class="lineBlock">
      <a class="icon-showBlock" href="javascript:void(0)"> </a>
    </li>
  </ul>
</div> 