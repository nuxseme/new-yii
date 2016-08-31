<?php
/**
 * 布局文件
 * @author caoxl
 * @date 2016-07-11
 */

use yii\helpers\Html;
$TTHelper = Yii::$container->get('TTHelper');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<?php $this->head() ?>
	<meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="a7E7XdgnGCQvAE0CT4T1RcaPbjLwTYmSAz5ydK_LUYA" />
    <meta name="description" content="<?=!empty($this->context->meta['description'])?$this->context->meta['description']:'Shop for Action Camera,360 Degree Camera, Camcorders, Flashes, Tripod, and Camera Accessories at Bargain Price | Camfere.com';?>">
    <meta name="keywords" content="<?=!empty($this->context->meta['keywords'])?$this->context->meta['keywords']:'';?>">
    <title>
        <?=!empty($this->context->meta['title']) ? $this->context->meta['title'] : 'action camera,360 degree camera,360 panorama camera,VR camera,digital camcorder,flashes,speedlite,ringlight,tripod,monopod,digital photo frame,Binoculars,Telescopes,Mobile Photography Accessories';?>
    </title>
    <?= Html::csrfMetaTags() ?>
    <link rel="icon" href="<?= $TTHelper->staticPrefix();?>/favicon.ico" type="image/x-icon">
</head>
<body>
<?php
//开始body
$this->beginBody();

//导入头部
echo Yii::$app->view->renderFile('@layout/header.php');

//导入导航
echo $this->params['headerNav'];

//主体内容
echo $content;

//加载底部
echo Yii::$app->view->renderFile('@layout/footer.php');

//介绍body
$this->endBody();
?>
</body>
</html>
<?php $this->endPage() ?>
