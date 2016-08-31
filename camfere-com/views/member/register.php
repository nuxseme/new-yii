<?php
use yii\bootstrap\ActiveForm;
use common\components\AppAsset;
use yii\helpers\Url;

AppAsset::register($this,'register');

//站点SEO信息
$metaParams = array('type'=>'register','title'=>'Register | Camfere.com ');
$staticRoute = Yii::$container->get('TTHelper')->staticPrefix();
$TTHelper = Yii::$container->get('TTHelper');


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<head>
    <?php $this->head() ?>
    <meta name="google-site-verification" content="a7E7XdgnGCQvAE0CT4T1RcaPbjLwTYmSAz5ydK_LUYA" />
    <link rel="icon" href="<?= $TTHelper->staticPrefix();?>/favicon.ico" type="image/x-icon">
    <title><?=$metaParams['title']?></title>
</head>
<body>
<?php $this->beginBody(); ?>
<header class="contentInside lbBox">
    <div class="lineBlock headerLogo">
        <a href="<?= Url::home();?>"><img src="<?=$staticRoute ?>/icon/logo.png" /></a>
    </div>
</header>
<section class="registerWarp">
    <?php $form = ActiveForm::begin(['id' => 'register-form']); ?>
    <div class="contentInside">
        <div class="signRegiser">
            <p class="logoTitle">Create your account</p>
            <div class="controls">
                <i class="icon-email"> </i>
                <input type="text" id="register_email" placeholder="Enter your email" autocomplete="off">
                <span class="help-block"></span>
            </div>
            <div class="controls">
                <i class="icon-lock"> </i>
                <input type="password" id="register_password" placeholder="Enter your password">
                <span class="help-block"></span>
            </div>
            <ul class="lbUl passLevel">
                <li class="passLow">LOW</li>
                <li class="passMedium">MEDIUM</li>
                <li class="passHigh">HIGH</li>
            </ul>
            <p class="passLen">This should be at least 6 characters long and will be case sensitive.</p>
            <div class="controls">
                <i class="icon-lock"></i>
                <input type="password" id="register_passwordAgain" placeholder="Confirm your password">
                <span class="help-block"> </span>
            </div>
            <div class="controls">
                <input class="codeInput" type="text" autocomplete="off" name="code" maxlength="4">
                <div class="code lineBlock"><img src="index.php?r=member/code" alt="Click the refresh verification code" onclick="javascript:this.src='index.php?r=member/code&tm='+Math.random();" /></div>
                <span class="help-block"></span>
            </div>
            <label class="selectLabel iAgree">
                <i class="multi-select"> </i>I agree to the camfere  <a href="<?=Url::home();?>terms---conditions.html">Terms & Conditions</a>
                <span class="help-block"></span>
            </label>
            <label class="selectLabel">
                <i class="multi-select multiAci"> </i>I'd like to receive exclusive discounts and news from camfere by email
                <span class="help-block"></span>
            </label>
            <input type="button" value="CREATE ACCOUNT" id="createAccount" class="btn btn-primary">
            <span id="error" class="help-inline"></span>
            <div class="haveAccount">
                <p class="lineBlock">Already have an account? </p>
                <a href="index.php?r=member/userlogin" class="lineBlock">Sign in</a>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</section>
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
