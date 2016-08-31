<?php
use common\components\AppAsset;
use yii\helpers\Url;

$TTHelper = Yii::$container->get('TTHelper');

AppAsset::register($this,'register');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<head>
    <title>Registered Successfully | Camfere.com</title>
    <meta name="google-site-verification" content="a7E7XdgnGCQvAE0CT4T1RcaPbjLwTYmSAz5ydK_LUYA" />
    <link rel="icon" href="<?= $TTHelper->staticPrefix();?>/favicon.ico" type="image/x-icon">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody(); ?>
<header class="contentInside lbBox">
    <div class="lineBlock headerLogo">
        <a href="<?=Url::home();?>"><img src="<?=$TTHelper->staticPrefix();?>/icon/logo.png" /></a>
    </div>
</header>
<section class="succWarp">
    <div class="sendBox">
        <p class="sendTT">
            <em></em>
            <b>Congratulations! You have successfully registered!</b>
        </p>
        <p>An activated email has been sent to your email,
            Please follow the steps to active you account...
        </p>
        <?php
        $email = Yii::$app->request->get('email');
        if(strstr($email,'@gmail.com') || strstr($email,'@msn.com') || strstr($email,'@yahoo.com') || strstr($email,'@hotmail.com') || strstr($email,'@outlook.com')):
            $url = '';
            if(strstr($email,'@gmail.com')){
                $url = 'https://mail.google.com';
            }elseif(strstr($email,'@yahoo.com')){
                $url = 'https://login.yahoo.com';
            }else{
                $url = 'https://login.live.com';
            }
            ?>
            <a href="<?= $url;?>" target="_blank" class="Checlogin">Check Your Inbox</a>
        <?php endif;?>
    </div>
</section>
<footer class="contentOut pu_footer bgff">
    <div class="contentInside">
        <p class="pu_copyright">Copyright © 2016 rcmoment INC. All Rights Reserved. </p>
    </div>
</footer>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage() ?>