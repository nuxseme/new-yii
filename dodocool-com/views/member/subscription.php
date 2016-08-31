<?php
use common\components\AppAsset;

AppAsset::register($this,'account');
$staticRoute = Yii::$container->get('TTHelper')->staticPrefix();
?>
<section class="contentInside">
    <div class="container subEmail">
        <h2 class="SuperDeals category">Subscription</h2>
        <p class="subBanTT"><a href="javascript:void(0);"><?= $_GET['email']?></a>To ensure that you only receive the emails you are interested in, customize your settings here:</p>
        <b class="subemB">Show me hot deals on these products:</b>
        <ul class="email_Banner">
            <li data-format="dresses"><span></span><img src="<?=$staticRoute ?>/icon/accessor20160329.jpg"></li>
            <li data-format="tops"><span></span><img src="<?=$staticRoute ?>/icon/tops20160329.jpg"></li>
            <li data-format="bottoms"><span></span><img src="<?=$staticRoute ?>/icon/dress20160329.jpg"></li>
            <li data-format="shoes"><span></span><img src="<?=$staticRoute ?>/icon/bottoms20160329.jpg"></li>
            <li data-format="jewelry"><span></span><img src="<?=$staticRoute ?>/icon/jewelry20160329.jpg"></li>
            <li data-format="accessories"><span></span><img src="<?=$staticRoute ?>/icon/shoes20160329.jpg"></li>
            <li data-format="newarrivals"><span></span><img src="<?=$staticRoute ?>/icon/new20160329.jpg"></li>
            <div class="clear"></div>
        </ul>
        <form class="subBotInp">
            <input class="inputTxt" name="email" type="text" value="<?= $_GET['email']?>">
            <input class="blackInput submit-btn" type="button" value="Submit">
            <div class="emailSub clickPop">
                <em class="closePop"></em>
                <span class="emIco"><img src="icon/email.png" /></span>
                <b class="blue">Congratulations! Welcome to join chicuu.com !</b>
                <p>Your account will be shortly received our 35% OFF coupon.<br />
                    Please check your email box.<br />
                    You will receive up-to-date events and promotions from CHICUU.com<br /> by subscribing our Newsletter Exclusive.
                </p>
            </div>
        </form>
        <a class="subEmailBanner" href="javascript:;"><img src="<?=$staticRoute ?>/icon/subEmailBanner.jpg"></a>
    </div>
</section>