<?php
use yii\helpers\Url;
$TTHelper = Yii::$container->get('TTHelper');
?>
<div class="accountRight lineBlock pointBox">
    <h6>My Points</h6>
    <p class="marT"><?= $TTHelper->getSiteLang('account.myPointsP1')?></p>

    <p class="marT"><?= $TTHelper->getSiteLang('account.myPointsP2')?></p>

    <p class="marT"><?= $TTHelper->getSiteLang('account.myPointsP3')?> <a href="javascript:void(0);"><?= $TTHelper->getSiteLang('account.myPointsP18')?> >></a> </p>
    <ul class="myReviewsList lbUl">
        <li>
            <ol><?= $TTHelper->getSiteLang('account.accountName')?>: <?= $accountBaseInfo['caccount']?> </ol>
            <ol><?= $TTHelper->getSiteLang('account.emailAddress')?>: <?= $accountBaseInfo['cemail']?></ol>
        </li>
        <li>
            <ol class="fontB14"><?= $TTHelper->getSiteLang('account.myCurrentPointsBalance')?>: <b class="bHs"><?= $totalPoint['data']?></b></ol>
            <ol class="hsTxt"><?= $TTHelper->getSiteLang('account.myPointsP4')?> </ol>
        </li>
        <li class="listBut">
            100 <?= $TTHelper->getSiteLang('common.chicuuPoints')?> = US $1.00
        </li>
    </ul>

    <div class="xxkDiv">
        <ul class="blackXXKS lbUl">
            <li <?php if($_GET['type']=='unused'):?>class="xxkActi"<?php endif;?>><a href="<?=Url::toRoute(['wallet/point', 'type' => 'unused']);?>"><?= $TTHelper->getSiteLang('account.availablePoints')?></a></li>
            <li <?php if($_GET['type']=='used'):?>class="xxkActi"<?php endif;?>><a href="<?=Url::toRoute(['wallet/point', 'type' => 'used']);?>"><?= $TTHelper->getSiteLang('account.usedPoints')?></a></li>
        </ul>
        <div class="xxkBOX boxRa block">
            <table class="hsTable hsTable0" width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <th width="110"><?= $TTHelper->getSiteLang('account.date')?></th>
                    <th width="140"><?= $TTHelper->getSiteLang('account.points')?></th>
                    <th width="220"><?= $TTHelper->getSiteLang('account.from')?></th>
                </tr>
                <?php foreach ($pointsList as $key => $value):?>
                    <tr>
                        <td><?= $value['createDateStr']?></td>
                        <td><?= $value['integral']?></td>
                        <td class="blue"><?= $value['source']?></td>
                    </tr>
                <?php endforeach;?>
            </table>
            <?php if($pointsList):?>
                <ul class="lbBox pagingWarp">
                    <?= $page->showpage();?>
                </ul>
            <?php endif;?>
        </div>
    </div>
    <h6 class="marT"><?= $TTHelper->getSiteLang('account.gainingPoints')?></h6>
    <ul class="gainingPoints">
        <li class="signsUp">
            <em></em>
            <p><?= $TTHelper->getSiteLang('account.signsUp')?></p>
            <p><?= $TTHelper->getSiteLang('account.myPointsP5')?></p>
        </li>
        <li class="upVideo">
            <em></em>
            <p><?= $TTHelper->getSiteLang('account.uploadingVideo')?></p>
            <p><?= $TTHelper->getSiteLang('account.myPointsP6')?></p>
        </li>
        <li class="newsletter">
            <em></em>
            <p><?= $TTHelper->getSiteLang('account.joiningNewsletter')?></p>
            <p><?= $TTHelper->getSiteLang('account.myPointsP7')?></p>
        </li>
        <li class="Picture">
            <em></em>
            <p><?= $TTHelper->getSiteLang('account.modifyYourAccountPicture')?></p>
            <p><?= $TTHelper->getSiteLang('account.myPointsP8')?></p>
        </li>
        <li class="Review">
            <em></em>
            <p><?= $TTHelper->getSiteLang('account.writeProductReview')?></p>
            <p><?= $TTHelper->getSiteLang('account.myPointsP9')?></p>
        </li>
        <li class="Share">
            <em></em>
            <p><?= $TTHelper->getSiteLang('account.sharePhoto/Video')?></p>
            <p><?= $TTHelper->getSiteLang('account.myPointsP10')?></p>
        </li>
        <li class="Report">
            <em></em>
            <p><?= $TTHelper->getSiteLang('account.productPriceReport')?></p>
            <p><?= $TTHelper->getSiteLang('account.myPointsP11')?></p>
        </li>
        <li class="Product">
            <em></em>
            <p><?= $TTHelper->getSiteLang('account.uploadingProductPhoto')?></p>
            <p><?= $TTHelper->getSiteLang('account.myPointsP12')?></p>
        </li>
        <li class="everyday">
            <em></em>
            <p><?= $TTHelper->getSiteLang('account.myPointsP13')?></p>
            <p><?= $TTHelper->getSiteLang('account.myPointsP14')?></p>
        </li>
        <li class="fromUs">
            <em></em>
            <p><?= $TTHelper->getSiteLang('account.myPointsP16')?></p>
            <p><?= $TTHelper->getSiteLang('account.myPointsP17')?></p>
        </li>
        <li class="fromBir">
            <em></em>
            <p><?= $TTHelper->getSiteLang('account.onBirthday')?></p>
            <p><?= $TTHelper->getSiteLang('account.myPointsP15')?></p>
        </li>
    </ul>
</div>