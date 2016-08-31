<?php
use common\widgets\ChangeCountryWidget;
$countries = $this->context->controller->countries;//国家列表
?>
<div class="lineBlock selectFlag">
	<div class="pu_navHover tt_ns_shipping_to">
		<span id="current_country_flage" class=""><em> </em></span> 
		<span class="flag_Txt"></span>
		<i class="icon-arr"> </i>
	</div>
	<?php
		echo ChangeCountryWidget::widget(['countries' => $countries]);
	?>
</div>