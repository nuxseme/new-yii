<?php
use common\components\AppAsset;
use yii\helpers\Url;
//注册资源文件
AppAsset::register($this, 'register');

?>
<!--main-->
<div id="main">
 <!--主体内容-->
 <div class="content w">
   <div class="login_wrap">
    <div class="tt_hd clearfix">
       <h3>Sign in</h3>
       <div class="tag"><i></i>Secure</div>
    </div>
    <div class="bd lineBlockBox">
      <div class="col_5">
        <span class="line"></span>
        <div class="login_box">
          <form>
              <div class="control_box">
                  <input type="text" placeholder="Email Address" class="text email">
              </div>
              <div class="control_box">
                   <input type="text" placeholder="Password" class="text psw">
              </div>
              <div class="rembMe">
                 <a class="forget_psw" href="sendEmail.html">Forgot Your Password</a>
                 <p class="tips_info"><span class="checkbox checkbox_checked"><i class="icon_check"></i></span>Remember Me</p>
              </div>
              <input type="button" value="sign in" class="signIn_btn blueBtn">
              <div class="other_login">
                 <div class="hd"><i>or</i></div>
                 <div class="bd">
                  <p>Sign In With An Existing Account</p>
                  <?php foreach ($thirdPartyLoginUrl as $key => $value) { ?>
                  <a class="<?=$value['type']?>" href="<?=$value['url']?>"><i class="icon_<?=$value['type']=='google'?'google-plus':$value['type']?>"></i></a>
                  <?php }?>
                 
                 </div>
              </div>
          </form>
        </div>
      </div>
      <div class="col_5">
        <div class="login_tips">
         <h3>You can use your Dodocool ID for other 
Dodocool services such as</h3>
         <ul>
           <li><i></i>Become a super user</li>
           <li><i></i>Extended warranty</li>
           <li><i></i>One-on-one service</li>
           <li><i></i>Receive special offers</li>
         </ul>
         <p><a href="<?=Url::toRoute('register/index');?>">Create Your Dodocool Account</a>Dont have an account yet?</p>
        </div>
      </div>
   </div>
    </div>
 </div>
   <!--主体内容 end-->        
</div>
<!--main end-->
