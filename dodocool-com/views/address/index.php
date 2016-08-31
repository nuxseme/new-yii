
<?php
use common\components\AppAsset;
use common\widgets\AccountWidget;
use yii\helpers\Url;

//语言包
//注册资源文件
AppAsset::register($this, 'account');
$TTHelper = Yii::$container->get('TTHelper');
$countryList = $this->context->countries;//国家列表
$this->title = $addressOption['title'];

?>

<section class="contentInside accInside">
    <?= AccountWidget::widget([
        'displayCount'  => $page->total,
        'displayName'   => Yii::$app->controller->action->id,
    ]);?>

    <div class="accountRight lineBlock addressBookBox">
        <h6><?= $addressOption['title']?></h6>
<!--   地址列表开始         -->
        <?=$addressList ?>
<!--   地址列表结束    -->
    </div>
</section>