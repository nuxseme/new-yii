<?php
$TTHelper = Yii::$container->get('TTHelper');
?>
<div class="lineBlock">
    <!--小图片点击切换-->
    <div class="showCaseSmall_box moveWarp lbBox">
        <a style="display: inline-block;" href="javascript:void(0)" class="showCaseL moveLeftClick lineBlock leftArrAci"><i class="icon-smallL"> </i></a>
        <div class="productSmallPic moveHidden lineBlock">
            <ul style="height: 576px;" class="productSmallmove lbUl moveBox">
                <?php foreach ($slideImgList as $key => $imgList):?>
                    <li class="moveList  <?php if($key == 0):?>cpActive<?php endif;?>">
                        <a href="<?= $TTHelper->getThumbnailUrl('product', $imgList['imgUrl'], Yii::$app->params['productDetailLargeImgWidth'], Yii::$app->params['productDetailLargeImgHeight'], true);?>" class="cloud-zoom-gallery" rel="useZoom: 'zoom2', smallImage: '<?= $TTHelper->getThumbnailUrl('product', $imgList['imgUrl'], Yii::$app->params['productDetailMediumImgWidth'], Yii::$app->params['productDetailMediumImgHeight']);?>' ">
                            <img class="zoom-tiny-image" src="<?= $TTHelper->getThumbnailUrl('product', $imgList['imgUrl'], Yii::$app->params['productDetailSmallImgWidth'], Yii::$app->params['productDetailSmallImgHeight']);?>">
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
        <a style="display: inline-block;" href="javascript:void(0)" class="showCaseR moveRightClick lineBlock rightArrAci"><i class="icon-smallR"> </i></a>

    </div>
    <!--大图展示-->
    <div class="productBigPic_box">
        <ul class="hoverBig">
            <li class="zoom-small-image">
                <div class="wrap" style="top:0px;z-index:80;position:relative;text-align:center;width:100%;height:100%">
                    <a style="position: relative; display: inline-block;" href="<?= $TTHelper->getThumbnailUrl('product', $slideImgList[0]['imgUrl'], Yii::$app->params['productDetailLargeImgWidth'], Yii::$app->params['productDetailLargeImgHeight'], true);?>" class="cloud-zoom" id="zoom2" rel="adjustX:10, adjustY:-4">
                        <img style="display: inline-block;" src="<?= $TTHelper->getThumbnailUrl('product', $slideImgList[0]['imgUrl'], Yii::$app->params['productDetailMediumImgWidth'], Yii::$app->params['productDetailMediumImgHeight']);?>">
                    </a>
                    <span class="empty"></span>
                </div>
            </li>
        </ul>
    </div>

</div>