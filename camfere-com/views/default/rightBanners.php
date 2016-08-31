<?php
use common\widgets\AdvertWidget;
?>

<div class="banner_right">
	<ul class="banner_rightList">
	<?= AdvertWidget::widget([
        'items'         => $banners,
        'displayType'   => AdvertWidget::DISPLAY_TYPE_COMMON,
    ]);?>
	</ul>
</div>