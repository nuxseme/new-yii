<?php
use common\components\AppAsset;
AppAsset::register($this,'forgetpass');
?>
<!--main-->
<div id="main">
     <!--主体内容-->
     <div class="content w">
       <div class="find_psw_wrap sendSuccess">
        <div class="tt_hd clearfix">
           <h3>Password Reset</h3>
        </div>
        <div class="bd">
          <p>To change your password, please enter the email address currently associated with DODOCOOL member.</p>
          <div class="form_box">
           <form>
            <div class="control_box">
                <input type="text" placeholder="Your Email" class="text email">
                <input type="button" value="Send" class="send_btn blueBtn" href="sendsuccsess.html">
                <p class="erro_info"></p>
            </div>
            </form>
          </div>
       </div>
      </div>
     </div>
     <!--主体内容 end-->         
</div>
<!--main end-->
