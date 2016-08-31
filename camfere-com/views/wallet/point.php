<?php
use common\components\AppAsset;
use common\widgets\AccountWidget;
use yii\helpers\Url;

//语言包
//注册资源文件
AppAsset::register($this, 'account');
$this->title ='My coupon';
$TTHelper = Yii::$container->get('TTHelper');
?>
<section class="contentInside accInside">
    <?= AccountWidget::widget([
        'displayCount'  => $page->total,
        'displayName'   => Yii::$app->controller->action->id,
    ]);?>
<!--point开始-->
    <?=$pointsList ?>
<!--point结束-->

</section>