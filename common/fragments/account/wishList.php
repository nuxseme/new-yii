<?php
use yii\helpers\Url;
$TTHelper = Yii::$container->get('TTHelper');
?>
<?php if($wishList):?>
    <h6><?= $TTHelper->getSiteLang('common.myWishlist')?> <a class="morBT" href="<?= Url::toRoute('wish/index')?>"><?= $TTHelper->getSiteLang('common.more')?> >></a></h6>
    <table class="myRevi" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <th>&nbsp;</th>
            <th><?= $TTHelper->getSiteLang('product.item')?></th>
            <th class="capTh"><?= $TTHelper->getSiteLang('account.description')?></th>
            <th><?= $TTHelper->getSiteLang('account.price')?></th>
            <th><?= $TTHelper->getSiteLang('account.options')?></th>
        </tr>
        <?php foreach($wishList as $wLists):?>
            <tr id="iid_<?= $wLists['listingId']?>">
                <td class="tdRela"><a href="javascript:void(0);" class="rightThis"><span class=""></span></a></td>
                <td class="firImg descTd">
                    <a href="<?= $TTHelper::getProductUrl($wLists['url'])?>">
                        <img src="<?= $TTHelper::getThumbnailUrl('product', $wLists['imageUrl'], 60, 60);?>">
                    </a>
                </td>
                <td>
                    <a class="wisTT" href="<?= $TTHelper::getProductUrl($wLists['url'])?>"><?=$wLists['title'];?></a>
                    <p class="wisSku">SKU:<?=$wLists['sku'];?></p>
                    <div class="smallReviews">
                        <div class="smallStar"></div>
                    </div>     <p class="wisAdd">Added : <?= $TTHelper::dateFormat($wLists['collectDate']);?></p>
                </td>
                <td class="wisPri"><?=$wLists['symbol'] . $wLists['nowprice'];?></td>
                <td class="wisAddCar">
                    <a href="<?= $TTHelper::getProductUrl($wLists['url'])?>">View details</a>
                    <div class="removeX delete" dataid="<?= $wLists['listingId']?>">Remove        <div class="point dialogss_main">
                            <h3 class="point_title">Popover</h3>
                            <p class="point_info">OK</p>
                            <div class="point_but">
                                <button type="button" class="point_cancel others_close animate">Cancel</button>
                                <button type="button" class="point_ok others_close animate deleteYes">OK</button>
                            </div>
                            <i class="point_arrows"></i>
                            <span class="dialogss_close point_code"></span>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
    <ul class="choWishlist">
        <li class="allFirstLi">
            <a class="rightAll" href="javascript:void(0);"><span></span></a>
            <a class="rightAll delete" href="javascript:;">
                <p class="reMAll"><?= $TTHelper->getSiteLang('account.removeAll')?></p>
                <div class="point dialogss_main">
                    <h3 class="point_title"><?= $TTHelper->getSiteLang('account.popover')?></h3>
                    <p class="point_info"><?= $TTHelper->getSiteLang('account.ok')?></p>
                    <div class="point_but">
                        <button class="point_cancel others_close animate"><?= $TTHelper->getSiteLang('product.cancel')?></button>
                        <button class="point_ok others_close animate deleteYes"><?= $TTHelper->getSiteLang('account.ok')?></button>
                    </div>
                    <i class="point_arrows"></i>
                    <span class="dialogss_close point_code"></span>
                </div>
            </a>
        </li>
        <li class="wisFx"><span class="wisFF"></span><span class="wisGZ"></span><span class="wisGG"></span><span class="wisQQ"></span></li>
    </ul>
<?php endif;?>