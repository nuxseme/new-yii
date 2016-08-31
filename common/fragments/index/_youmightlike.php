<?php
/**
 * @desc 轮播式产品展示
 */
use yii\helpers\Html;
use common\tomtop\TTCommon;
use common\components\TomtopHelper;

//助手类
$TTHelper = Yii::$container->get('TTHelper');
?>
<?php if($youMightLike):?>
    <?php if($position == 'top'):?>
        <div class="lbBox listPageTitle">
            <p class="lineBlock">PRODUCTS YOU MIGHT LIKE</p>
            <p class="lineBlock text-right">
                <span class="page">1</span>/<span class="pages"><?= ceil(count($youMightLike) / 5)?></span>
            </p>
        </div>
    <?php endif;?>
    <?php if($position == 'top'):?>
        <div class="listMoveWarp mightLike">
    <?php endif;?>
    <?= Html::a('', 'javascript:void(0)', ['class' => 'moveLeftClick leftArr']);?>
    <?= Html::a('', 'javascript:void(0)', ['class' => 'moveRightClick rightArr']);?>
    <div class="moveHidden">
        <div class="feed-scrollbar">
			<span class="feed-scrollbar-track">
				<span class="feed-scrollbar-thumb"> </span>
			</span>
        </div>
        <ul class="moveBox lbUl">
            <?php
            foreach($youMightLike as $item):?>
                <li class="moveList productClass">
                    <?php if($item['origprice'] > $item['nowprice']):?>
                        <span class="icon-sale">
				   <?= ceil(100-($item['nowprice'] / $item['origprice'] * 100)) ?>
				</span>
                    <?php endif;?>
                    <?= Html::beginTag('a', ['class' => 'productImg', 'href' => $TTHelper->getProductUrl($item['url'])]) ?>
                    <img alt="<?= $item['title']?>" class="lazy" data-original="<?= $TTHelper->getThumbnailUrl('product', $item['imageUrl'], Yii::$app->params['homeDailyDealsImgWidth'], Yii::$app->params['homeDailyDealsImgHeight']);?>" />
                    <?= Html::endTag('a')?>
                    <?= Html::a(
                        $item['title'] ? $item['title'] : $item['title_default'], $TTHelper->getProductUrl($item['url']),
                        ['class' => 'productTitle','title'=>$item['title']]
                    );?>

                    <?= $isShowPrice == true ? $TTHelper->productPriceDisplay($item['origprice'], $item['nowprice'], $item['symbol']) : "";?>
                    <?php if($item['reviewCount'] > 0):?>
                        <div class="productReviews lineBlock">
                            <div class="productStar" style="width:<?= (100 / 5) * $item['avgScore']?>%;"> </div>
                        </div>
                        <p class="lineBlock">(<?= $item['reviewCount']?>)</p>
                    <?php endif;?>
                </li>
            <?php endforeach;?>
        </ul>
    </div>
    <?php if($position == 'top'):?>
        </div>
    <?php endif;?>
<?php endif;?>