<?php
use common\widgets\ChangeCountryWidget;
$TTHelper = Yii::$container->get('TTHelper');
?>
<div class="logistics">
	<span><?= $TTHelper->getSiteLang('shipping.shipping');?>Shipping:</span>

	<span class="logistics_loading">
		<i><?= $TTHelper->getSiteLang('common.loading');?>Loading...</i>
	</span>
	<span class="loading_defeated" style="display:none;">The request failed!<a href="javascript:void(0);">Please try again.</a></span>
	<span class="logistics_info" style="display:none;">
		<em class="shipping"><b>Unavailable</b></em>
		<em class="super_saver">Unavailable<i></i></em>
		<em class="state">to<b>Unknown</b></em>
	</span>
</div>
<div class="dialogs logistics_c">
	<i></i>
	<span class="dialogs_c">
		<div class="failure"><?= $TTHelper->getSiteLang('shipping.noshippingMethod2');?>"Sorry, it seems that there are no available shipping methods for your location."
Please <a href="http://tb.53kf.com/code/client/10140333/1">contact us</a> for further assistance.</div>
		<div class="loading">
			<i></i>
			<p>Loading<?= $TTHelper->getSiteLang('common.loading');?>...</p>
		</div>
		<div class="select_state">
			<p><?= $L['tomtop.common.shipTo']?></p>
			<div class="lineBlock selectFlag">
			<div class="pu_navHover tt_ns_shipping_to">
				<span id="current_country_flage" class="flag_AI"><em> </em></span>
				<span class="flag_Txt">Anguilla</span>
				<i class="icon-arr"> </i>
			</div>
			<?php echo ChangeCountryWidget::widget(['countries' => $this->context->controller->countries]);?>
		</div>
		</div>
		<div class="newshopping_address orderD_con" style="display:none;">
			<h2><?= $L['tomtop.common.shippingMethod']?></h2>
			<div class="method_table_c">
				<table cellpadding="0" class="method_table">
				<thead>
				<tr>
					<td width="27%">Options<?= $TTHelper->getSiteLang('common.options');?></td>
					<td width="25%">Estimated Shipping Time<?= $TTHelper->getSiteLang('shipping.esshippingTime');?></td>
					<td width="20%">Tracking Number<?= $TTHelper->getSiteLang('shipping.trackingNumber');?></td>
					<td width="28%">Shipping Cost<?= $TTHelper->getSiteLang('shipping.shippingCost');?></td>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td colspan="4">Sorry,no result!<?= $TTHelper->getSiteLang('shipping.notes');?></td>
				</tr>
				</tbody>
			</table>
			</div>
			<p class="note"><?= $TTHelper->getSiteLang('shipping.notes');?></p>
		</div>
		<i class="close_dialogs"></i>
	</span>
</div>