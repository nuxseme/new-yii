<?php
use common\widgets\AdvertWidget;
?>

<?= AdvertWidget::widget([
    'items'         => $banners,
    'width'         => null,
    //'height'        => 350,
]);?>