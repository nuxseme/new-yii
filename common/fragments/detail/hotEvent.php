<?php
$TTHelper = Yii::$container->get('TTHelper');
?>
<p class="RightTitle"><?= $TTHelper->getSiteLang('product.hotEvent') ?>
	<!-- <a class="color666" href="<?= $TTHelper->TomtomHrefLink('collections')?>"><?= $TTHelper->getSiteLang('common.more') ?></a> -->
</p>
<ul class="lbBox rightBanner">
	<?php foreach ($hotEvents as $key => $value):?>
<!--		<li class="lineBlock">-->
<!--			<a href="--><?//= $value['htmlUrl']?><!--" title="--><?//= $value['title']?><!--"><img alt="--><?//= $value['title']?><!--" class="lazy" data-original="http://www.chicuu.com/collections/image/--><?//= $value['id']?><!--" /></a>-->
<!--		</li>-->

		<li class="lineBlock">
			<a href="<?= $value['url']?>" title="<?= $value['title']?>"><img alt="<?= $value['title']?>" class="lazy" data-original="<?= $value['imgUrl']?>" /></a>
		</li>
	<?php endforeach;?>
</ul>