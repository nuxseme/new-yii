<?php
use yii\bootstrap\ActiveForm;
use common\components\AppAsset;
use yii\helpers\Url;

AppAsset::register($this,'register');

//站点SEO信息
$metaParams = array('type'=>'register','title'=>'register');
$staticRoute = Yii::$container->get('TTHelper')->staticPrefix();
?>

<!--main-->
<div id="main">
     <!--主体内容-->
     <div class="content w">
           <div class="login_wrap">
              <div class="tt_hd clearfix">
                   <h3>Register</h3>
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
                             <input type="text" placeholder="Enter your Password" class="text psw">
                        </div>
                        <div class="control_box">
                             <input type="text" placeholder="Confirm your Password" class="text confirmPsw">
                        </div>
                        <div class="control_box verifiCode">
                            <input placeholder="please Enter code" type="text" class="text verifycode">
                            <span class="code"><img src="index.php?r=member/code" alt="请输入验证码" onclick="javascript:this.src='index.php?r=member/code&tm='+Math.random();"></span>
                            <!--a class="refresh" href="javascript:void(0)"></a-->
                        </div>
                        <div class="rembMe">
                             <p class="tips_info"><span class="checkbox checkbox_checked"><i class="icon_check"></i></span>Subscribe to the Dodocool Newsletter</p>
                        </div>
                        <p class="other_erro_info"></p>
                        <input type="button" value="Submit" class="register_btn blueBtn">
                        <a class="link" href="<?=Url::toRoute(['member/userlogin','backUrl'=>'account/index'])?>">Sign in</a>
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
                  </div>
                </div>
          </div>
          </div>
     </div>
     <!--主体内容 end-->         
</div>
<!--main end-->


