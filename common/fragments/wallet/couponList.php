<?php
use yii\helpers\Url;
$TTHelper = Yii::$container->get('TTHelper');
?>
<div class="accountRight lineBlock accouReviewBox">
    <h6><?= $TTHelper->getSiteLang('common.myCoupons')?></h6>
    <div class="xxkDiv">
        <ul class="blackXXKS lbUl">
            <li <?php if($_GET['type'] == 'unused'):?>class="xxkActi"<?php endif;?>><a href="<?=Url::toRoute(['wallet/coupon', 'type' => 'unused']);?>"><?= $TTHelper->getSiteLang('account.unusedCoupons')?></a></li>
            <li <?php if($_GET['type'] == 'used'):?>class="xxkActi"<?php endif;?>><a href="<?=Url::toRoute(['wallet/coupon', 'type' => 'used']);?>"><?= $TTHelper->getSiteLang('account.usedCoupons')?></a></li>
        </ul>
        <div class="xxkBOX boxRa block">
            <table class="hsTable hsTable0" width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <th width="160"><?= $TTHelper->getSiteLang('account.couponCode')?></th>
                    <th width="120"><?= $TTHelper->getSiteLang('account.couponType')?></th>
                    <th width="130"><?= $TTHelper->getSiteLang('account.saving')?></th>
                    <th width="225"><?= $TTHelper->getSiteLang('account.conditionsOfUse')?></th>
                    <th width="120"><?= $TTHelper->getSiteLang('account.times')?></th>
                    <th><?= $TTHelper->getSiteLang('account.expiryDate')?></th>
                </tr>
                <?php foreach ($couponList as $key => $value):?>
                    <tr>
                        <td><?= $value['code']?></td>
                        <td><?php if($value['cash'] === true):?>Cash coupon<?php else:?>Discount coupon<?php endif;?></td>
                        <td class="blue"><?php if($value['cash'] === true):?><?= $value['currencyCode'] . '&nbsp;' . $value['value']?><?php else:?><?= $value['value']?><?php endif;?></td>
                        <td>Order <?= $value['currencyCode'] . '&nbsp;' . $value['minAmount']?>+</td>
                        <td><?= $value['times']?></td>
                        <td><?= substr($value['validStartDateStr'], 0, 10)?> to <?= substr($value['validEndDateStr'], 0, 10)?></td>
                    </tr>
                <?php endforeach;?>
            </table>
            <?php if($couponList):?>
                <ul class="lbBox pagingWarp">
                    <?= $page->showpage();?>
                </ul>
            <?php endif;?>
        </div>
    </div>
    <h6><?= $TTHelper->getSiteLang('account.couponRuler')?>:</h6>
    <ol class="coupon_tk">
        <li><?= $TTHelper->getSiteLang('account.myCouponP1')?></li>
        <li><?= $TTHelper->getSiteLang('account.myCouponP2')?></li>
        <li><?= $TTHelper->getSiteLang('account.myCouponP3')?></li>
        <li><?= $TTHelper->getSiteLang('account.myCouponP4')?></li>
        <li><?= $TTHelper->getSiteLang('account.myCouponP5')?></li>
        <li><?= $TTHelper->getSiteLang('account.myCouponP6')?></li>
        <li><?= $TTHelper->getSiteLang('account.myCouponP7')?></li>
        <li><?= $TTHelper->getSiteLang('account.myCouponP8')?></li>
        <li><?= $TTHelper->getSiteLang('account.myCouponP9')?></li>
    </ol>
</div>