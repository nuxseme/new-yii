<?php
$TTHelper = Yii::$container->get('TTHelper');
?>
<ul class="lbBox xxkClass xxkClick">
	<li class="lineBlock active"><?= $TTHelper->getSiteLang('product.description') ?></li>
	<li class="lineBlock"><?= $TTHelper->getSiteLang('product.shippingPayment') ?></li>
	<!-- <li class="lineBlock"><?= $TTHelper->getSiteLang('product.warranty') ?></li> -->
</ul>
<div id="description" class="proinfCon xxkBox block">
	<?= $description?>
</div>
<div class="proinfCon xxkBox">
	<?= $shippingPayment?>
</div>
<!-- <div class="proinfCon xxkBox">
	<?= $warranty?>
</div> -->