<?php
use yii\helpers\Url;
$TTHelper = Yii::$container->get('TTHelper');
?>
<h6><?= $TTHelper->getSiteLang('account.myAccount')?></h6>
<div class="headLeft lineBlock" id="photo">
    <img id="user-photo" src="<?= (empty($userBaseInfo['cimageurl'])) ? $TTHelper->staticPrefix() . '/icon/HeadPic.jpg' : $userBaseInfo['cimageurl']?>">
    <input class="hsInput clicks" type="button" value="<?= $TTHelper->getSiteLang('account.editPicture')?>">
    <div class="upHead clickPop">
        <h6><?= $TTHelper->getSiteLang('account.createcustompicture')?></h6>
        Upload Picture:
        <form enctype="multipart/form-data" role="form" id="photo-form" method="POST" action="<?= Url::toRoute('account/uploadimg')?>">
        <div class="upFileHead">
                <input type="hidden" name="userHeadImage" value="">
                <input type="file" name="file"><a href="javascript:void(0);">Browse..</a>
        </div>
        <div class="throbber" id="loading"></div>
        <div style="color:red;" class="msg"></div>
        <p class="acc_imgtxt"><?= $TTHelper->getSiteLang('account.myProfileEditPicture')?></p>

            <input type="hidden" name="filePath" value="">
            <input type="button" value="Cancel" class="closePop">
            <input type="submit" value="Save" class="closePop picSave" disabled="disabled">
        </form>

        <div class="rightHead">
            <p>Preview</p>
            <div id="preview">
                <img width="120" height="120" src="<?= $TTHelper->staticPrefix();?>/icon/HeadPic.jpg">
            </div>
            120x120
        </div>
    </div>
</div>
<div class="headRight lineBlock">
    <p><b class="myName"><?= ($userBaseInfo['caccount'] != '') ? $userBaseInfo['caccount'] : $userBaseInfo['cemail'];?></b>, <?= $TTHelper->getSiteLang('account.welcometoMyAccount')?></p>
    <div><?= $TTHelper->getSiteLang('account.emailAddressConfirmation')?>:
        <?php if($userBaseInfo['bactivated']):?>(Verified)<?php else:?><a class="blue confirmc email-active-btn" href="javascript:void(0);">(unconfirmed)</a><?php endif;?>
        <div class="emailSub clickPop">
            <em class="closePop icon-Close"></em>
            <span class="emIco"></span>
            <b class="blue">Congratulations!</b>
            <p>Your verification email has been sent successfully,Please log in to your mailbox, and follow the instructions to complete the verification. </p>
            <a class="closePop blackInput" href="javascript:void(0);">Check it now</a>
        </div>
    </div>
    <ul class="accInf lbUl">
        <li class="infW"><p><em class="poi"></em><?= $TTHelper->getSiteLang('account.points')?></p><span><?= $userStatus['integral']?></span></li>
        <li class="infW"><p><em class="cou"></em><?= $TTHelper->getSiteLang('account.coupons')?></p><span><?= $userStatus['coupon']?></span></li>
        <li class="infW"><p><em class="wis"></em><?= $TTHelper->getSiteLang('common.myWishlist')?></p><span><?= $userStatus['collect']?></span></li>
        <li class="infW"><p><em class="revi"></em><?= $TTHelper->getSiteLang('account.myReviews')?></p><span><?= $userStatus['review']?></span></li>
        <li class="accInf accInfs">
            <ol class="lbUl">
                <li class="parents"><p><em class="ord"></em><?= $TTHelper->getSiteLang('account.myOrder')?></p><span><?= $orderStatus['all']?></span></li>
                <li><p><?= $TTHelper->getSiteLang('account.unpaid')?></p><span><?= $orderStatus['pending']?></span></li>
                <li><p><?= $TTHelper->getSiteLang('account.processing')?></p><span><?= $orderStatus['processing']?></span></li>
                <li><p><?= $TTHelper->getSiteLang('account.dispatched')?></p><span><?= $orderStatus['dispatched']?></span></li>
            </ol>
        </li>
    </ul>
</div>