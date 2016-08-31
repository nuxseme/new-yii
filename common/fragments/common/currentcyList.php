<?php
$currencies = $this->context->controller->currencies;//货币列表
?>
<div class="lineBlock">
	<div class="pu_navHover">
		<?php $this->context->controller->siteInfo->symbolCode;?>
		<i class="icon-arr"> </i>
	</div>
	<div class="pu_notranslate pu_blockWarp">
	    <?php
	    	foreach($currencies as $currency):
	    ?>
	    <a data-currency="<?= $currency['code']?>" href="javascript:void(0)">
	        <em><?=  $currency['code']?></em><span><?= $currency['symbolCode']?></span>
	    </a>
		<?php endforeach;?>
	</div>
</div>