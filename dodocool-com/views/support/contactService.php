<?php
use yii\helpers\Url;
use yii\helpers\Json;
use common\components\AppAsset;

//注册资源文件
AppAsset::register($this, 'contact_service');
?>
<!--main-->
<div id="main">
     <!--主体内容-->
     <div class="content">
          <div class="crumbs w">
             <ul class="lineBlockBox">
              <li><a href="<?= Url::home();?>">Home</a><span>/</span></li>
              <li><a href="<?= Url::toRoute('support/contactservice');?>">Contact servicce</a></li>
             </ul>
          </div>
          <div class="super_banner superBanner02">
              <div class="w">Contact Service</div>
          </div>
          <div class="container_wrap w">
               <div class="form_wrap">
                  <div class="col_one">
                      <form action="">
                      <h3>Send A Message</h3>
                      <div class="form_control">
                         <div class="control_box location data_subject">
                            <label>subject<span>*</span></label>
                            <div class="select_wrap">
                              <div placeholder="please Enter your Email" class="select_val" type="text"></div><span class="select_handle"><i class="sjx"></i></span>
                              <ul class="option_list">
                                <?php
                                foreach($subjects as $subject):
                                ?>
                                <li data-value="<?= $subject['value']?>"><?= $subject['name']?></li>
                                <?php 
                                endforeach;
                                ?>
                              </ul>
                           </div>
                        </div>
                         <div class="control_box data_address">
                            <label>address <span>*</span></label><input type="text" placeholder="please Enter your Email">
                         </div>
                         <div class="control_box data_attachment">
                            <label>Attachment<span>*</span></label><input type="text" placeholder="please Enter your Email">
                         </div>
                         <div class="control_box textarea data_detail">
                              <label>Describe your detailed requests here</label>
                              <textarea></textarea>
                         </div>
                         <div class="control_box">
                            <input type="button" value="submit" class="blueBtn submit_btn">
                         </div> 
                       </div>
                      </form>
                  </div>
               </div>
          </div>
     </div>
     <!--主体内容 end-->         
</div>
<!--main end-->