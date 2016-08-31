<?php
use common\components\AppAsset;
use common\widgets\AccountWidget;

//语言包
//注册资源文件
AppAsset::register($this, 'account');
$this->title ='My Wish';
$TTHelper = Yii::$container->get('TTHelper');
?>
<section class="contentInside accInside">
    <?= AccountWidget::widget([
        'displayCount'  => $page->total,
        'displayName'   => Yii::$app->controller->action->id,
    ]);?>

    <div class="accountRight accouHomeBox lineBlock">

        <h6><?=$TTHelper->getSiteLang('common.myWishlist')?></h6>
        <p class="marT"><?=$TTHelper->getSiteLang('account.myWishlistP1')?></p>
        <p class="marT"><?=$TTHelper->getSiteLang('account.myWishlistP2')?> </p>
        <form class="topSearch_search" action="index.php" id="wishSearch" method="GET">
            <input type="hidden" name="r" value="wish/index">
            <ul class="reviewTT_ul wisSelect lbUl">
                <li>
                    <?=$TTHelper->getSiteLang('account.categories')?>: <select name="categoryId">
                        <option value="0"><?=$TTHelper->getSiteLang('account.allCategories')?></option>
                        <?php foreach ($categories as $key => $data):?>
                            <option value="<?= $data['icategoryid']?>" <?php if($_GET['categoryId'] == $data['icategoryid']):?>selected<?php endif;?>><?= $data['cname']?></option>
                        <?php endforeach;?>
                    </select>
                </li>
                <li>
                    Sort By: <select name="sort">
                        <option value=""><?=$TTHelper->getSiteLang('account.dateAdded')?></option>
                        <option value="priceAsc" <?php if($_GET['sort'] == 'priceAsc'):?>selected<?php endif;?>><?=$TTHelper->getSiteLang('account.price:LowToHigh')?></option>
                        <option value="priceDesc" <?php if($_GET['sort'] == 'priceDesc'):?>selected<?php endif;?>><?=$TTHelper->getSiteLang('account.price:HighToLow')?></option>
                    </select>
                </li>
                <li class="searchInp">
                    <input class="search_txt" type="text" name="productKey" placeholder="<?=$TTHelper->getSiteLang('account.productName')?>" value="<?= trim($_GET['productKey'])?>" >
                    <input class="orderSearch" type="submit" value="<?=$TTHelper->getSiteLang('account.search')?>">
                </li>
            </ul>
        </form>
        <?php if($collectList):?>
            <ul class="choWishlist">
                <li class="allFirstLi">
                    <a class="rightAll" href="javascript:;"><span></span></a>
                    <a class="rightAll delete" href="javascript:void(0);">
                        <p class="reMAll"><?=$TTHelper->getSiteLang('account.removeAll')?></p>
                        <div class="point dialogss_main">
                            <h3 class="point_title"><?=$TTHelper->getSiteLang('account.popover')?></h3>
                            <p class="point_info"><?=$TTHelper->getSiteLang('product.ok')?>?</p>
                            <div class="point_but">
                                <button class="point_cancel others_close animate" type="button"><?=$TTHelper->getSiteLang('account.cancel')?></button>
                                <button class="point_ok others_close animate deleteYes" type="button"><?=$TTHelper->getSiteLang('product.ok')?></button>
                            </div>
                            <i class="point_arrows"></i>
                            <span class="dialogss_close point_code"></span>
                        </div>
                    </a>
                </li>
            </ul>
            <table class="myRevi" width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <th>&nbsp;</th>
                    <th><?=$TTHelper->getSiteLang('product.item')?></th>
                    <th class="capTh"><?=$TTHelper->getSiteLang('account.description')?></th>
                    <th><?=$TTHelper->getSiteLang('account.price')?></th>
                    <th><?=$TTHelper->getSiteLang('account.options')?></th>
                </tr>
                <?php foreach ($collectList as $key => $value):?>
                <tr id="iid_<?= $value['listingId']?>">
                <td class="tdRela"><a href="javascript:void(0);" class="rightThis"><span class=""></span></a></td>
                <td class="firImg descTd"><a href="<?= $TTHelper::urlRewrite($value['url'],'product')?>"><img src="<?= $TTHelper::getThumbnailUrl('product',$value['imageUrl'],60,60);?>"></a></td>
                <td>
                    <a class="wisTT" href="<?= $TTHelper::urlRewrite($value['url'],'product')?>"><?= $value['title']?></a>
                    <p class="wisSku">SKU:<?= $value['sku']?></p>
                    <div class="smallReviews">
                        <div class="smallStar"></div>
                    </div> <?php if($value['reviewNum']>0):?>(<span class="orange"><?= $value['reviewNum']?></span>reiews)  <?php endif;?>
                    <p class="wisAdd">Added : <?= date("F j, Y",substr($value['collectDate'],0,-3));?></p>
                </td>
                <td class="wisPri"><?= $value['symbol'].$value['nowprice']?></td>
                <td class="wisAddCar">
                    <a href="<?= $TTHelper::urlRewrite($value['url'],'product')?>"><?= $TTHelper->getSiteLang('catalog.viewDetails')?></a>
                    <div class="removeX delete" dataid="<?= $value['listingId']?>"><?= $TTHelper->getSiteLang('account.remove')?>
                        <div class="point dialogss_main">
                            <h3 class="point_title"><?= $TTHelper->getSiteLang('account.popover')?></h3>
                            <p class="point_info"><?= $TTHelper->getSiteLang('account.ok')?></p>
                            <div class="point_but">
                                <button type="button" class="point_cancel others_close animate"><?= $TTHelper->getSiteLang('product.cancel')?></button>
                                <button type="button" class="point_ok others_close animate deleteYes"><?= $TTHelper->getSiteLang('account.ok')?></button>
                            </div>
                            <i class="point_arrows"></i>
                            <span class="dialogss_close point_code"></span>
                        </div>
                    </div>
                </td>
                </tr>
                <?php endforeach;?>
            </table>
            <ul class="lbBox pagingWarp">
                <?= $page->showpage();?>
            </ul>
        <?php else:?>
            <ul style="margin:10px;">*No Wishlist</ul>
        <?php endif;?>
    </div>
</section>