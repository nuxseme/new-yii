<?php
use common\components\AppAsset;

AppAsset::register($this,'register');
$TTHelper = Yii::$container->get('TTHelper');

$staticRoute = Yii::$container->get('TTHelper')->staticPrefix();
$metaParams = array('type'=>'register','title'=>'Change Password | Camfere.com');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<head>
    <title><?=$metaParams['title']?></title>
    <link rel="icon" href="<?= $TTHelper->staticPrefix();?>/favicon.ico" type="image/x-icon">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody(); ?>
<header class="contentInside lbBox">
    <div class="lineBlock headerLogo">
        <a href="<?= \yii\helpers\Url::home() ?>"><img src="<?=$staticRoute?>/icon/logo.png" /></a>
    </div>
</header>
<section class="succWarp">
    <div class="login_page contentInside changePass">
        <div class="passwordReset signRegiser">
            <div class="passwordSent">
                <h3>Password Reset</h3>
                <p>To change your password, please enter the email address currently associated with CAMFERE member.</p>

                <input class="e_Address" type="text" placeholder="Email address">
                <input class="inputBtn sentEmail" type="button" value="Send">
                <p class="e_errorIN">The Email Address was not found in our records; please try again.</p>
            </div>
            <div class="passwordHide">
                <p><em></em>Please check your E-mail box. <br>
                    An e-mail has been send.<br>
                    Please follow the instructions in the e-mail to set your new password.
                </p>
                <!--<div class="passwordReset_inp">
                <a class="pasCheck inputBtn" href="javascript:">Check it now</a>
                </div>-->
            </div>
        </div>
    </div>
</section>
<footer class="contentOut pu_footer bgff">
    <div class="contentInside">
        <p class="pu_copyright"><?= Yii::$app->params['copyRight'];?></p>
    </div>
</footer>
<?php $this->endBody(); ?>
</body>
<html>
<?php $this->endPage() ?>
