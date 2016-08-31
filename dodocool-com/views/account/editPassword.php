<?php
use common\components\AppAsset;
use common\widgets\ppaccount\AccountNavWidget;
//语言包
//注册资源文件
AppAsset::register($this, 'changePassword');
$TTHelper = Yii::$container->get('TTHelper');
?>
<!--main-->
<div id="main">
 <!--主体内容-->
 <div class="content">
  <!--面包屑开始-->
   <?=$breadCrumbs?>
   <!--面包屑结束-->
    <div class="w">
    <div class="acount_container">
       <!--左侧导航栏开-->
        <?= AccountNavWidget::widget(); ?>
        <!--左侧导航栏结束-->
       <div class="acount_right">
          <div class="profile_wrap">
           <h3 class="hd">Change Password</h3>
           <div class="form_wrap">
             <div class="col_one">
              <form action="">
                <div class="form_control">
                  <div class="control_box first">
                    <label>Email Address</label><em><?=$email?></em>
                  </div>
                  <div class="control_box ">
                    <label>Old Password <span>*</span></label><input type="text" placeholder="Old Password" class="oldpassword">
                      <p class="erro_info"></p>
                  </div>
                 <div class="control_box">
                    <label>New Password <span>*</span></label><input type="text" placeholder="New Password" class="newpassword">
                    <p class="erro_info"></p>
                 </div>
                 <div class="control_box">
                    <label>Confirm Password <span>*</span></label><input type="text" placeholder="Confirm Password" class="confirmpassword">
                    <p class="erro_info"></p>
                 </div>
                 <div class="control_onecol">
                   <div class="control_box">
                        <input type="button" value="submit" class="blueBtn submit_btn">
                        <p class="erro_info"></p>
                   </div> 
                 </div> 
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
    </div>
    </div>
 </div>
 <!--主体内容 end-->         
</div>
<!--main end-->


