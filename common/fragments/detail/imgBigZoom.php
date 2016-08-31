<?php
$TTHelper = Yii::$container->get('TTHelper');
?>
<div class="lineBlock">
    <!--小图片点击切换-->
    <div class="showCaseSmall_box moveWarp lbBox" id="showCaseSmallPic">
        <a href="javascript:void(0)" class="showCaseL moveLeftClick lineBlock leftArrAci" style="display: inline-block;"><i class="icon-smallL"> </i></a>
        <div class="productSmallPic moveHidden lineBlock">
            <ul class="productSmallmove lbBox moveBox" style="height: 576px;">
                <?php foreach ($slideImgList as $key => $imgList):?>
                    <li class="lineBlock moveList <?php if($key == 0):?>cpActive<?php endif;?>">
                        <i></i><a href='<?= $TTHelper->getThumbnailUrl('product', $imgList['imgUrl'], Yii::$app->params['productDetailLargeImgWidth'], Yii::$app->params['productDetailLargeImgHeight'],true);?>' class='cloud-zoom-gallery' rel="useZoom: 'zoom1', smallImage: '<?= $TTHelper->getThumbnailUrl('product', $imgList['imgUrl'], Yii::$app->params['productDetailMediumImgWidth'], Yii::$app->params['productDetailMediumImgHeight']);?>' ">
                            <img class="zoom-tiny-image" src="<?= $TTHelper->getThumbnailUrl('product', $imgList['imgUrl'], Yii::$app->params['productDetailSmallImgWidth'], Yii::$app->params['productDetailSmallImgHeight']);?>" />
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
        <a href="javascript:void(0)" class="showCaseR moveRightClick lineBlock rightArrAci" style="display: inline-block;"><i class="icon-smallR"> </i></a>
    </div>
    <!--大图展示-->
    <div class="productBigPic_box">
        <ul class="hoverBig">
            <li class="zoom-small-image">
                <a href='<?= $TTHelper->getThumbnailUrl('product', $slideImgList[0]['imgUrl'], Yii::$app->params['productDetailLargeImgWidth'], Yii::$app->params['productDetailLargeImgHeight'], true);?>' class = 'cloud-zoom' id='zoom1' rel="adjustX:10, adjustY:-4">
                    <img src="<?= $TTHelper->getThumbnailUrl('product', $slideImgList[0]['imgUrl'], Yii::$app->params['productDetailMediumImgWidth'], Yii::$app->params['productDetailMediumImgHeight']);?>" />
                </a><span class="empty"></span><div class="mousetrap"></div>
            </li>
        </ul>
    </div>

    <!--弹出框-->
    <div class="productBigPop_box blockPopup_box" id="procuctPOP">
        <div class="customer_popBox">
            <div class="close"> </div>
            <div class="customer_popTitle"><?= $productTitle?></div>
            <div class="scrollBox" style="width: 0px;">
                <div class="customer_popPicBox">
                    <ul class="customer_bigPic">
                        <li class="zoom-small-image" id="bigBacks">
                            <div class="wrap" style="top:0px;z-index:80;position:relative;text-align:center;width:100%;height:100%">
                                <a href='<?= $TTHelper->getThumbnailUrl('product', $slideImgList[0]['imgUrl'], Yii::$app->params['productDetailLargeImgWidth'], Yii::$app->params['productDetailLargeImgHeight'], true);?>' class='cloud-zoom' id="zoom2" rel="position:'inside',showTitle:false,adjustX:-4,adjustY:-4">
                                <img src="<?= $TTHelper->getThumbnailUrl('product', $slideImgList[0]['imgUrl'], Yii::$app->params['productDetailMediumImgWidth'], Yii::$app->params['productDetailMediumImgHeight']);?>" />
                                </a>
                                <span class="empty"></span>
                                <div class="mousetrap" style="background-image:url(&quot;.&quot;);z-index:999;position:absolute;width:100%;height:100%;left:0px;top:0px;"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <ul class="customerSmallmove lbBox" id="smallClickUrl" style="overflow-y: hidden; width: 205px;">
                <?php foreach ($slideImgList as $key => $imgList):?>
                    <li class="productSmallImg lineBlock">
                        <a href='<?= $TTHelper->getThumbnailUrl('product', $imgList['imgUrl'], Yii::$app->params['productDetailLargeImgWidth'], Yii::$app->params['productDetailLargeImgHeight'], true);?>' class='cloud-zoom-click' rel="useZoom: 'zoom2', smallImage: '<?= $TTHelper->getThumbnailUrl('product', $imgList['imgUrl'], Yii::$app->params['productDetailMediumImgWidth'], Yii::$app->params['productDetailMediumImgHeight']);?>' ">
                            <img src="<?= $TTHelper->getThumbnailUrl('product', $imgList['imgUrl'], Yii::$app->params['productDetailSmallImgWidth'], Yii::$app->params['productDetailSmallImgHeight']);?>" />
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
            <div class="customer_popTxt"> </div>
        </div>
        <div class="black"> </div>
    </div>
</div>