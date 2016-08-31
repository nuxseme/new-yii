<?php
use yii\helpers\Url;

$TTHelper = Yii::$container->get('TTHelper');
 ?>
 <div class="youlike w">
            <h3 class="hd"><a name="like"></a>You May Also Like</h3>
            <div class="listMoveWarp alsoLike">
              <a class="leftArr" href="javascript:void(0)"></a> 
              <a class="rightArr" href="javascript:void(0)"></a>  
              <div class="moveHidden">
                  <div class="feed-scrollbar">
                      <span class="feed-scrollbar-track">
                            <span class="feed-scrollbar-thumb"></span>
                      </span>
                  </div>
                  <ul class="lineBlockBox moveBox">
                  <?php foreach ($youMayLike as $key => $value): ?>
                    <li class="moveList productClass">
                        <a class="productImg" href="<?=$TTHelper->getProductUrl($value['url']);?>">
                            <img src="<?= $TTHelper->getThumbnailUrl('product', $value['imageUrl'], Yii::$app->params['productDetailMediumImgWidth'], Yii::$app->params['productDetailMediumImgHeight']);?>">
                        </a>       
                        <h3 class="productTitle"><a href="<?=$TTHelper->getProductUrl($value['url']);?>" title="<?=$value['title']?>"><?=$value['title']?></a>
                        </h3>
                    </li>
                 <?php endforeach;?>
                  </ul>
              </div>
           </div>
          </div>