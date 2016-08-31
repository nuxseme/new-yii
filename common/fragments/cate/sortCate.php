<?php
$TTHelper = Yii::$container->get('TTHelper');
?>
<ul class="lbBox cateforySelect">
	<li class="lineBlock">
		<span class="sort"><?= $TTHelper->getSiteLang('catalog.sort')?></span>
		<div class="lineBlock selectWarp lbBox">
			<div class="lineBlock selectTxt"><?= $TTHelper->getSiteLang('catalog.featured')?></div>
			<a class="lineBlock selectBtn" href="javascript:void(0)"> </a>
			<ol class="selectValue">
				<li data-rel="featured"<?php if($sort == 'featured' || $sort == ''):?> class="active"<?php endif;?>><?= $TTHelper->getSiteLang('catalog.featured')?></li>
				<li data-rel="newest"<?php if($sort == 'newest'):?> class="active"<?php endif;?>><?= $TTHelper->getSiteLang('catalog.newest')?></li>
				<li data-rel="popular"<?php if($sort == 'popular'):?> class="active"<?php endif;?>><?= $TTHelper->getSiteLang('catalog.mostPopular')?></li>
				<li data-rel="reviews"<?php if($sort == 'reviews'):?> class="active"<?php endif;?>><?= $TTHelper->getSiteLang('catalog.mostReviews')?></li>
				<li data-rel="price_low"<?php if($sort == 'price_low'):?> class="active"<?php endif;?>><?= $TTHelper->getSiteLang('catalog.priceLowToHigh')?></li>
				<li data-rel="price_high"<?php if($sort == 'price_high'):?> class="active"<?php endif;?>><?= $TTHelper->getSiteLang('catalog.priceHighToLow')?></li>
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