<?php
use yii\helpers\Url;
$TTHelper = Yii::$container->get('TTHelper');

?>
<!-- 登录开始 -->
<li id="loginBox" class="lineBlock">
    <div class="rightHover">
        <div class="pu_navHover">
            <?= $TTHelper->getSiteLang('common.signInOrJoinFree')?>
            <i class="icon-arr"> </i>
        </div>
        <div class="signJoin pu_blockWarp lbBox">
            <div class="lineBlock">
                <p class="marB5"><?= $TTHelper->getSiteLang('common.signInWithTomTopAccount')?></p>
                <div class="controls">
                    <i class="icon-email"> </i>

                    <input class="span10" type="text" placeholder="<?= $TTHelper->getSiteLang('common.enterYourEmail')?>" id="sign_email" />
                    <span class="help-block"></span>
                </div>
                <div class="controls">
                    <i class="icon-lock"> </i>
                    <input class="span10" type="password" placeholder="<?= $TTHelper->getSiteLang('common.enterYourPassword')?>" id="sign_password" />
                    <span class="help-block"></span>
                </div>
                <input type="button" value="SIGN IN" class="btn btn-primary" id="signin" />
                <a rel="nofollow" class="forgetPs" href="<?= Url::toRoute('member/forgetpass');?>"><?= $TTHelper->getSiteLang('common.forgotPassword')?></a>
                <div class="other_Login_c">
                    <div class="or_c">
                        <i></i>
                        <span>or</span>
                    </div>
                    <div class="other_Login">
                        <p>Sign in with social account</p>
                        <?php foreach ($thirdPartyLoginUrl as $key => $value):?>
                            <a class="<?= $value['type']?>" href="<?= $value['url']?>"></a>
                        <?php endforeach;?>

<!--                        --><?php //\yii\base\Event::trigger($this::MOUNT_CLASS, $this::E_THIRD_LOGIN); ?>
                    </div>
                </div>
            </div>
            <div class="lineBlock rJoinToday">
                <p><?= $TTHelper->getSiteLang('common.newToTomTop')?></p>
                <a rel="nofollow" href="<?=\yii\helpers\Url::toRoute('member/index') ?>" class="btn btn-primary joinToday txt_upper">
                    <?= $TTHelper->getSiteLang('common.joinToday')?>
                    <i class="icon-free"> </i>
                </a>
                <p class=""><?= $TTHelper->getSiteLang('common.membersOnlyService')?></p>
                <ol class="onlyService">
                    <li><?= $TTHelper->getSiteLang('common.membersOnlyService1')?></li>
                    <li><?= $TTHelper->getSiteLang('common.membersOnlyService2')?></li>
                    <li><?= $TTHelper->getSiteLang('common.membersOnlyService3')?></li>
                    <li>4.Permanent Shopping Cart</li>
                    <li><?= $TTHelper->getSiteLang('common.membersOnlyService5')?></li>
                </ol>
            </div>
        </div>
    </div>
</li>
<!-- 登录结束-->