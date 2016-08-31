<?php
use yii\helpers\Url;
use yii\helpers\Json;
use common\components\AppAsset;

//注册资源文件
AppAsset::register($this, 'support');

$TTHelper = Yii::$container->get('TTHelper');
?>
<!--main-->
<div id="main">
     <!--主体内容-->
     <div class="content">
          <div class="crumbs w">
               <ul class="lineBlockBox">
                 <li><a href="<?= Url::home();?>">Home</a><span>/</span></li>
                 <li><a href="<?= Url::toRoute('superuser/index');?>">Support Center</a></li>
               </ul>
          </div>
          <div class="support_nav_bar">
               <div class="w">
                   <div class="support_center">
                         <h5>Support Center</h5>
                         <div class="input_box lineBlockBox">
                              <input class="text" placeholder="Search by product name" type="text">
                              <button type="button" class="submit_btn"><i class="icon_search"></i></button>
                         </div>
                   </div>
                   <div class="scroll_wrap">
                         <ul class="tab_nav lineBlockBox">
                             <li class="li1 active"><span></span><p>Download & Drivers</p></li>
                             <!-- <li class="li2"><a href="warrantyregistration.html"><span></span><p>Warranty Registration</p></a></li> -->
                             <li class="li3"><a href="<?= Url::toRoute('support/contactservice');?>"><span></span><p>Contact Service</p></a></li>
                         </ul>
                   </div>
               </div>
          </div>
          <div class="tab_container w">
               <div class="tab_info">
                    <div class="product_container">
                      <?php
                      if(!empty($products)):
                      ?>
                      <ul class="product lineBlockBox">
                          <?php
                          foreach($products as $product):
                          ?>
                          <li data-sku="<?= $product['sku'];?>" data-loaded="0">
                            <a href="javascript:void(0)" class="product_img">
                                <img src="<?= $TTHelper->getThumbnailUrl('product', $product['imageUrl'], Yii::$app->params['productListImgHeight'], Yii::$app->params['productListImgWidth'])?>" alt="<?= $product['title'];?>">
                            </a>
                            <h3>
                              <a href="javascript:void(0)"><?= $product['title'];?></a>
                              </h3>
                             <div class="bm_dialog downLoad_list">
                                 <s></s>
                                 <div class="dialog">
                                    <div class="hd"><p>Download list</p><span class="close"><i class="icon_cross"></i></span class="close"></div>
                                    <div class="bd"></div>
                                    <div class="ft"></div>
                                 </div>
                             </div>
                          </li>
                          <?php 
                          endforeach;
                          ?>
                      </ul>
                      <?php
                      else: 
                      ?>
                      no results!
                      <?php 
                      endif;
                      ?>
                    </div>
               </div>
          </div>
     </div>
     <!--主体内容 end-->         
</div>
<!--main end-->