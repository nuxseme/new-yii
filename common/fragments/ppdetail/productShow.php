 <?php 
use yii\helpers\Url;
$TTHelper = Yii::$container->get('TTHelper');
 ?>
 <div class="product_container">
                      <div class="product_pic_wrap">
                         <div class="product_pic">
                              <img src="<?= $TTHelper->getThumbnailUrl('product', $imgList[0]['imgUrl'], Yii::$app->params['productDetailMediumImgWidth'], Yii::$app->params['productDetailMediumImgHeight']);?>" alt="">
                         </div>
                         <div class="view_icon">
                             <span><i></i>View gallery</span>
                         </div>
                      </div>
                    </div>
                   <!--轮播-->
                   <div class="product_swiper">
                       <div class="banner">
                          <div class="scroll_container">
                              <ul class="scroll_wrap">
                              <?php foreach ($imgList as $key => $value): ?>
                                     <li><img src="<?= $TTHelper->getThumbnailUrl('product', $value['imgUrl'], Yii::$app->params['productDetailMediumImgWidth'], Yii::$app->params['productDetailMediumImgHeight']);?>" alt=""></li>
                              <?php endforeach;?>
                                
                              </ul>
                              <div class="nav_btn"></div>
                              <div class="pre_btn"><span></span></div>
                              <div class="next_btn"><span></span></div>
                              <div class="close_btn"><span></span></div>
                          </div>
                       </div>
                   </div>
     <!--轮播-->