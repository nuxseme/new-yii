<?php
/**
 * 布局文件
 * @author nuxseme
 * @date 2016-08-3
 */

use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<?php $this->head() ?>
	<meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="s0bTLnFLZTQOrc3AqLghx05_TOJo38NwR3J2vv7cTfc" />
    <meta name="description" content="<?=!empty($this->context->meta['description'])?$this->context->meta['description']:'description';?>">
    <meta name="keywords" content="<?=!empty($this->context->meta['keywords'])?$this->context->meta['keywords']:'keywords';?>">
    <title>
        <?=!empty($this->context->meta['title']) ? $this->context->meta['title'] : 'dodocool.com';?>
    </title>
    <?= Html::csrfMetaTags() ?>
    <link rel="icon" href="<?= Yii::$container->get('TTHelper')->staticPrefix();?>/favicon.ico" type="image/x-icon">
</head>
<body>
<script type="text/javascript">
  (function(){//html5标签兼容低版本游览器。
       if (!
       /*@cc_on!@*/
       0) return;
       var e = "abbr, article, aside, audio, canvas, datalist, details, dialog, eventsource, figure, footer, header, hgroup, mark, menu, meter, nav, output, progress, section, time, video".split(', ');
       var i= e.length;
       while (i--){
           document.createElement(e[i])
       }
  })()
</script>

<?php
//开始body
$this->beginBody();

//导入头部
echo Yii::$app->view->renderFile('@layout/header.php');

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
