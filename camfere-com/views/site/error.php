<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;
use common\components\AppAsset;

//注册资源文件
AppAsset::register($this, 'error');

$this->title = $name;

$TTHelper = Yii::$container->get('TTHelper');
?>

<div class="errorPage contentInside">
    <div class="errorTxt">
        <img src="<?= $TTHelper->staticPrefix();?>/icon/404.png">
        <b>The page you requested can not be found.</b>
        <span>But don't try so hard!</span>
        <div>
            <b>To proceed, you can:</b>
            <hr>
            Go to <a href="<?= Url::home();?>"><?= Yii::$app->request->hostInfo;?></a> front page.<br>
            If you need further help, Please contact our <a href="javascript:void(0);">Customer Service Express</a>.
        </div>
    </div>
</div>