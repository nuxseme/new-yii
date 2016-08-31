<?php
use common\widgets\ProductDisplayWidget;
?>

<?= ProductDisplayWidget::widget([
		'items'         => $arrivals,
		'displayType'   => ProductDisplayWidget::DISPLAY_TYPE_AUTOPLAY,
		'title'         => Yii::$container->get('TTHelper')->getSiteLang('home.newArrivals'),
		'itemOptions'   => array('class' => 'newArrivals'),
]);?>