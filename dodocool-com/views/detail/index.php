<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use common\components\AppAsset;
use common\widgets\ppproductDetail\ShareProductWidget;

//注册资源文件
AppAsset::register($this, 'detail');

//助手
$TTHelper = Yii::$container->get('TTHelper');

//货币
$currencyList = $this->context->currencies;

//登陆信息用户
$TT_TOKEN = $TTHelper->getCookie('TT_TOKEN');
$TT_UUID = $TTHelper->getCookie('TT_UUID');
?>

<?php if($productInfo === false): //404page?>
	<?php 
		//注册资源文件
		AppAsset::register($this, 'detail-special');
	?>
	<div class="errorPage contentInside">
		<div class="errorTxt">
			<img src="<?= $TTHelper->staticPrefix();?>/icon/404.png">
			<b>The page you requested can not be found.</b>
			<span>But don't try so hard!</span>
			<div>
				<b>To proceed, you can:</b>
				<hr>
				Go to <a href="<?= Url::home();?>"><?= Url::home();?></a> front page.<br>
				If you need further help, Please contact our <a href="javascript:void(0);">Customer Service Express</a>.
			</div>
		</div>
	</div>
	<?php return; endif;?>
<!--main-->
<div id="main">
     <!--主体内容-->
     <div class="content">
          <?=$breadCrumbs?>
          <div class="produc_detail">
               <div class="product_showcase w clearfix">
                  <?=$productShow?>
                    <div class="product_info">
                         <h3 class="tt"><?=$title?></h3>
                          <!--星级 评论总数开始-->
                         <?=$reviewsAndStarts?>
                          <!--星级 评论总数 结束-->

                          <!--第三方分享插件开始-->
                          <div class="share_wrap">
                            <p class="lineBlock shareTxt"><?= $TTHelper->getSiteLang('product.share')?>:</p>
                            <div class="lineBlock">
                              <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-532965a902fc0807" async="async"></script>
                              <div class="addthis_sharing_toolbox"> </div>
                            </div>
                          </div>
                          <!--第三方分享插件结束-->
                        
                        <div class="attribute">
                            <!--仓储开始-->
                            <?=$porductStorage?>
                            <!--仓储结束-->

                            <!--属性开始-->
                            <?=$productAttrs?>
                            <!--属性结束-->
                            
                            <?php
                              echo '<script type="text/javascript">' . Json::encode($platforms) . '</script>';
                            ?>
                            <a class="yellow_btn" href="javascript:void(0)">Buy at Amazon</a>
                        </div>
                    </div>
               </div>
            
              <!--商品详情开始-->
              <div class="product_intro">
                  <!--table选项卡-->
                  <div class="hd">
                      <div class="scroll_wrap w">
                          <ul class="lineBlockBox">
                            <li class="active">Overview<span></span></li>
                            <li>Specs / Downloads<span></span></li>
                            <!-- <li>FAQ<span></span></li> -->
                            <!-- <li>Reviews<span></span></li> -->
                            <li class="mayLike"><a href="#like">You may also like</a></li>
                          </ul>
                      </div>
                  </div>
                  <!--table选项卡-->

                  <!--table内容-->
                  <div class="bd w">
                      <!--商品详情-->
                      <div class="tab_info show pro_detail">
                        <article>
                          <?=$overview?>
                        </article>
                      </div> 
                      <!--商品详情-->

                      <!--驱动说明文档-->
                      <?= $drivers;?>
                      <!--驱动说明文档-->

                      <!--帮助信息-->
                      <!--<?= $faq;?>-->
                      <!--帮助信息-->
                      
                      <!--评论列表-->
                      <!--<?= $reviews ?>-->
                      <!--评论列表-->
                      
                  </div>
                  <!--table内容-->
              </div>
              <!--商品详情结束-->

          </div>
          <?=$youmaylike?>
     </div>
     <!--主体内容 end-->         
</div>
<!--js变量-->
<?= $jsvars ?>
<!--js变量-->
<!--main end-->
