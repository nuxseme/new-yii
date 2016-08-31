<?php
/**
 * @desc 产品弹窗详情
 */
use common\models\System;

//助手
$TTHelper = Yii::$container->get('TTHelper');

//货币
$currencyList = $this->context->currencies;

?>
<span class="close"></span>
<div class="lbBox showCaseWarp <?php if($imagesDisplayType == 1):?>square_img<?php endif;?>">
    <div class="showcase_head">
        <h1><?=$productBaseInfo['title']; ?><span> ( <?=$productBaseInfo['sku']; ?> )</span></h1>
    </div>
    <!--图片放大镜-->
    <?= $imgZoom?>
    <!--右边信息-->
    <div class="lineBlock showInformation">
        <div class="saleWarp"> </div>
        <span id="serverTime" class="hide"><?= str_replace('-', '/', substr($serverTime, 0, 10))?></span>
        <div class="priceWarp">
            <p class="lineBlock">Price:</p>
            <div class="lineBlock currency">
                <p><span class="symbolLab"><?= $detailPrice['symbol']?></span><i class="icon-arr"> </i></p>
                <ul class="lbUl currencyBox">
                    <?php foreach ($currencyList as $key => $value):?>
                        <li><a href="javascript:void(0)" data-currency="<?= $value['code']?>"><em><?= $value['code']?></em><span><?= $value['symbolCode'];?></span></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <p class="lineBlock price pricelab detailPrice" usvalue="<?= $detailPrice['us_nowprice']?>"><?= $detailPrice['us_nowprice']?></p>
        </div>
        <?php if($productBaseInfo['freeShipping']):?>
            <p class="freeShipping"><?= $TTHelper->getSiteLang('home.freeShipping')?></p>
        <?php endif;?>
        <p class="proColor lineBlock"><span data_key="whouse">Ship From</span></p>
        <ul class="selectAttribute lbUl lineBlock shippingFrom">
            <!--库存列表-->
            <?= $porductStorage;?>
        </ul>

        <!--库存状态-->
        <div class="sf_wrap">
            <?php
			//库存状态
			if($detailPrice['status'] == 1):?>
				<p class="shippTime"><?php if(($detailPrice['qty']) > 0):?><?= $TTHelper->getSiteLang('common.inStock', 'tomtop')?><?php else:?><?= $TTHelper->getSiteLang('common.outStock', 'tomtop')?><?php endif;?></p>
			<?php elseif($detailPrice['status'] == 2):?>
				<p class="shippTime"><?= $TTHelper->getSiteLang('common.stopSelling')?></p>
			<?php else:?>
				<p class="shippTime"><?= $TTHelper->getSiteLang('common.outStock')?></p>
			<?php endif;?>
        </div>

       <!--属性列表-->
        <?= $productAttrs?>

        <div class="qty">
            <p class="lineBlock">QTY:</p>
            <div class="lineBlock lbBox qty_wrap">
                <a href="javascript:void(0)" class="lineBlock prev">-</a>
                <input  class="lineBlock quantity" name="quantity" maxlength="3" value="1" onpaste="return false;" onkeypress="return IsNum(event)" type="text">
                <a href="javascript:void(0)" class="lineBlock next">+</a>
            </div>
        </div>

        <div class="toCart">
            <input type="hidden" name="storageid" id="storageid" value="<?= $defaultWhouse['depotId'];?>">
			<input type="hidden" name="whouse" id="whouse" value="<?= $defaultWhouse['depotName'];?>">
            <input name="listingId" id="listingId" value="<?= $productBaseInfo['listingId'];?>" type="hidden">
            <input name="productSku" id="productSku" value="<?= $productBaseInfo['sku'];?>" type="hidden">
            <input name="categoryId" id="categoryId" value="<?= $TTHelper->getCateIdBybreadCrumbs($breadCrumbs, 1)?>" type="hidden">
            <input name="parentId" id="parentId" value="<?= $TTHelper->getCateIdBybreadCrumbs($breadCrumbs, 2)?>" type="hidden">
            <div class="addCart lineBlock">
                <a class="btn btn-feng" href="javascript:void(0)"><i class="icon_cart"> </i>Add To Cart</a>
            </div>
            <!--<a class="lineBlock favoritesC" href="javascript:void(0)"><i class="icon_wishlist"> </i>Add to Favorites</a>-->
        </div>
        <a class="blue_color" href="<?= $TTHelper->getProductUrl($productBaseInfo['url']);?>">View Full Details >></a>
    </div>
</div>
<script type="text/javascript">
    var mainContent = <?= $productMainContent?>;
</script>
