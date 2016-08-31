<?php
use common\components\AppAsset;
use common\widgets\AccountWidget;
use yii\helpers\Url;
//语言包
//注册资源文件
AppAsset::register($this, 'account');
$L = $this->context->langPkg;
?>
<section class="contentInside accInside">
    <?= AccountWidget::widget([
        'displayCount'  => $page->total,
        'displayName'   => Yii::$app->controller->action->id,
    ]);?>

    <?= $messageList ?>
</section>
