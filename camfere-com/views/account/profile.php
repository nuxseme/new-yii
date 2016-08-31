<?php
use common\components\AppAsset;
use yii\helpers\Url;
//注册资源文件
AppAsset::register($this, 'account');
$TTHelper = Yii::$container->get('TTHelper');
?>
<section class="contentInside accInside">
    <?= \common\widgets\AccountWidget::widget([
        'displayCount' => $page->total,
        'displayName' => Yii::$app->controller->action->id,
    ]); ?>

    <div class="accountRight lineBlock">
        <h6><?= $L['chicuu.account.personalProfile'] ?></h6>
        <div class="xxkDiv">
            <ul class="blackXXK lbUl">
                <li class="xxkActi"><?= $TTHelper->getSiteLang('account.changeyourProfile')?></li>
                <li><?= $TTHelper->getSiteLang('account.changeyourpassword')?></li>
            </ul>
            <!--编辑开始-->
            <?= $profileEdit; ?>
            <!--编辑结束 -->
        </div>
    </div>
</section>