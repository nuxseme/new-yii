<?php
use yii\helpers\Url;
use  common\components\AppAsset;

AppAsset::register($this,'register');
$metaParams = array('type'=>'register','title'=>'Login | Camfere.com');
$staticRoute = Yii::$container->get('TTHelper')->staticPrefix();

$TTHelper = Yii::$container->get('TTHelper');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<head>
    <title><?=$metaParams['title']?></title>
    <meta name="google-site-verification" content="a7E7XdgnGCQvAE0CT4T1RcaPbjLwTYmSAz5ydK_LUYA" />
    <link rel="icon" href="<?= $TTHelper->staticPrefix();?>/favicon.ico" type="image/x-icon">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody(); ?>
<header class="contentInside lbBox">
    <div class="lineBlock headerLogo">
        <a href="<?= Url::home();?>"><img src="<?=$staticRoute?>/icon/logo.png" /></a>
    </div>
</header>
<section class="LoginWarp">
    <div class="contentInside">
        <div class="signRegiser">
            <p class="logoTitle">Sign In to camfere.com</p>
            <div class="controls">
                <i class="icon-email"> </i>
                <input id="sign_email" type="text" placeholder="Enter your email" autocomplete="off">
                <span class="help-block"></span>
            </div>
            <div class="controls">
                <i class="icon-lock"> </i>
                <input id="sign_password" type="password" placeholder="Enter your password">
                <span class="help-block"></span>
            </div>
            <input type="button" value="LOGIN" class="btn btn-primary" id="signin">
            <a class="forgetPs" href="<?=\yii\helpers\Url::toRoute(['member/forgetpass'])?>">Forgot your password?</a>
            <!--
            <div class="other_login_methord">
                 <div class="or"><span>or</span></div>
                 <p>Sign in with social. Pow!</p>
                 <a href="" class="f"></a><a href="" class="p"></a><a href="" class="g"></a>
            </div>
            -->
            <div class="haveAccount">
                <p class="lineBlock">Don't have an account? </p>
                <a href="index.php?r=member/index&backUrl=<?=$backUrl?>" class="lineBlock">Create one</a>
            </div>
        </div>
    </div>
</section>
<input type="hidden" value="<?=$backUrl?>" name="backUrl">
<footer class="contentOut pu_footer bgff">
    <!-- Google Tag Manager -->
    <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-M85BXP"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-M85BXP');</script>
    <!-- End Google Tag Manager -->
    <div class="contentInside">
        <p class="pu_copyright"><?= Yii::$app->params['copyRight'];?></p>
    </div>
</footer>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage() ?>
