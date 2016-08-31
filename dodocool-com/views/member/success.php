<?php
use common\components\AppAsset;
AppAsset::register($this,'findPassword');
?>
<!--main-->
<div id="main">
     <!--主体内容-->
     <div class="content w">
         <div class="find_psw_wrap">
           <div class="sendSuccess_info lineBlockBox">
              <div class="icon"><i class="icon_check"></i></div>
              <div class="info">
                 <p>An e-mail has been sent to</p>
                 <p>Please check your E-mail box.
                <?php
                $email = Yii::$app->request->get('email');
                if(strstr($email,'@gmail.com') || strstr($email,'@msn.com') || strstr($email,'@yahoo.com') || strstr($email,'@hotmail.com') || strstr($email,'@outlook.com') || strstr($email,'@qq.com')):
                    $url = '';
                    if(strstr($email,'@gmail.com')){
                        $url = 'https://mail.google.com';
                    }elseif(strstr($email,'@yahoo.com')){
                        $url = 'https://login.yahoo.com';
                    }elseif(strstr($email,'@qq.com')){
                        $url = 'https://mail.qq.com';
                    }
                 ?>
            <a class="link" href="<?=$url?>"><?=$email?></a></p>
        <?php endif;?>
                 <p>An activated email has been sent to your email,
            Please follow the steps to active you account...</p>
              </div>
            </div>
          </div>
     </div>
     <!--主体内容 end-->         
</div>
<!--main end-->
