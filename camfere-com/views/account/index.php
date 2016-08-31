<?php
use common\components\AppAsset;
use common\widgets\AccountWidget;

//语言包
//注册资源文件
AppAsset::register($this, 'account');
$this->title = 'My Account';
$TTHelper = Yii::$container->get('TTHelper');
?>
<section class="contentInside accInside">
    <?= AccountWidget::widget([
        'displayCount' => $page->total,
        'displayName' => Yii::$app->controller->action->id,
    ]); ?>
    <div class="accountRight accouHomeBox lineBlock">

        <!--用户状态表开始  -->
        <?= $allStatus; ?>
        <!--用户状态表结束  -->

        <!-- reviewList开始   -->
        <?= $reviewList; ?>
        <!-- reviewList结束   -->

        <!-- wishList开始   -->
        <?= $wishList; ?>
        <!-- wishList结束   -->

    </div>
</section>
<section id="viewedFeatured" class="contentInside lbBox  historicalWarp"></section>
