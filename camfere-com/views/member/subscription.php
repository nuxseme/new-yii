<?php
use common\components\AppAsset;

AppAsset::register($this,'account');
$staticRoute = Yii::$container->get('TTHelper')->staticPrefix();
$categories = $this->context->getCategories();

?>
<section class="contentInside">
    <div class="container subEmail">
        <h2 class="SuperDeals category">Subscription</h2>
        <div class="container_wrap">
            <p class="dear_friend">Dear friend,</p>
            <p class="subBanTT">To ensure that you only receive the emails you are interested in, customize your settings here:</p>
            <b class="subemB">Show me hot deals on these products:</b>
            <ul class="email_Banner">
                <?php if(!empty($categories)):?>
                    <?php foreach($categories as $k => $v):?>
                        <li data-format="<?= $v['cname']?>"><a rel="nofollow" class="dirSelectList" href="javascript:void(0)"><i class="multi-select"> </i><?= $v['cname']?></a>
                        </li>
                    <?php endforeach;?>
                <?php endif;?>
                <div class="clear"></div>
            </ul>
        </div>

        <form class="subBotInp">
            <input class="inputTxt" name="email" type="text" value="<?= $_GET['email']?>">
            <input class="blackInput submit-btn" type="button" value="Submit">
            <p class="ensure_email">Ensure delivery by adding cservice@camfere.com to your Address Book.</p>
            <div class="emailSub clickPop">
                <em class="closePop"></em>
                <span class="emIco"><img src="<?=$staticRoute;?>/icon/email.png" /></span>
                <b class="blue">Congratulations! Welcome to join camfere.com !</b>
                <p>
                    Please check your email box.<br />
                    You will receive up-to-date events and promotions from camfere.com<br /> by subscribing our Newsletter Exclusive.
                </p>
            </div>
        </form>
    </div>
</section>