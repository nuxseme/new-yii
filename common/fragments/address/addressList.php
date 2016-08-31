<?php
use yii\helpers\Url;
$TTHelper = Yii::$container->get('TTHelper');
?>
<ul class="addressUL">
    <h6><?= $addressOption['title']?></h6>
    <?php foreach ($addressList as $key => $value):?>
        <li id="iid_<?= $value['id']?>">
            <a class="rightThis" href="javascript:void(0);"><span></span></a>
            <b><?= $value['fname'] . '&nbsp;&nbsp;' . $value['lname']?></b>
            <p><?= $value['street'] . ',' . $value['city'] . ',' . $value['province'] . ',' . $TTHelper::getCountryNameByCode($countryList,$value['country']) . '.&nbsp;&nbsp;' . $value['postalcode']?></p>
            <a class="defADD <?php if($value['isDef']):?>defActi<?php endif;?>" href="<?=Url::toRoute(['address/defaddress', 'type' => $addressOption['type'], 'id' => $value['id']]);?>">Default Address</a>
            <a class="deitADD" dataType="<?= $addressOption['type']?>" dataId="<?= $value['id']?>" href="javascript:void(0);"><?= $TTHelper->getSiteLang('account.edit')?></a>
            <div class="removeADD delete"><?= $TTHelper->getSiteLang('account.remove')?>
                <div class="point dialogss_main">
                    <h3 class="point_title"><?= $TTHelper->getSiteLang('account.popover')?></h3>
                    <p class="point_info"><?= $TTHelper->getSiteLang('account.oK')?></p>
                    <div class="point_but">
                        <button class="point_cancel others_close animate" type="button"><?= $TTHelper->getSiteLang('product.cancel')?></button>
                        <button class="point_ok others_close animate deleteYes" type="button"><?= $TTHelper->getSiteLang('account.ok')?></button>
                    </div>
                    <i class="point_arrows"></i>
                    <span class="dialogss_close point_code"></span>
                </div>
            </div>
        </li>
    <?php endforeach;?>
</ul>
<div class="addChAll">
    <div class="blackBK"></div>
    <a class="rightAll" href="javascript:void(0);"><span></span></a>
    <?php if($addressList): ?>
        <a class="rightAll delete" href="javascript:;"><p class="allRs"><?= $TTHelper->getSiteLang('account.removeAll')?></p>
            <div class="point dialogss_main">
                <h3 class="point_title"><?= $TTHelper->getSiteLang('account.popover')?></h3>
                <p class="point_info"><?= $TTHelper->getSiteLang('account.oK')?></p>
                <div class="point_but">
                    <button class="point_cancel others_close animate" type="button"><?= $TTHelper->getSiteLang('product.cancel')?></button>
                    <button class="point_ok others_close animate deleteYes" type="button"><?= $TTHelper->getSiteLang('account.ok')?></button>
                </div>
                <i class="point_arrows"></i>
                <span class="dialogss_close point_code"></span>
            </div>
        </a>
    <?php endif;?>
    <a class="newAddress" dataType='<?= $addressOption['type']?>' dataId="0" href="javascript:;">Add A New <?= $addressOption['title']?></a>
</div>

<div class="blockPopup_box clickPop" id="addressEdit">  </div>

<?php if($addressList):?>
    <ul class="lbBox pagingWarp">
        <?= $page->showpage();?>
    </ul>
<?php endif;?>