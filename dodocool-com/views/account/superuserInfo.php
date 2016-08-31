<?php
use common\components\AppAsset;
use common\widgets\ppaccount\AccountNavWidget;

//语言包
//注册资源文件
AppAsset::register($this, 'superuserinfo');
$TTHelper = Yii::$container->get('TTHelper');
?>

<!--main-->
<div id="main">
     <!--主体内容-->
     <div class="content">
        <?=$breadCrumbs?>
        <div class="w">
        <div class="acount_container">
           <?=AccountNavWidget::widget()?>
           <div class="acount_right">
            <div class="content_wrap">
              <h3 class="hd">Super User Information</h3>
                 <div class="form_wrap">
                 <form action="">
                    <?=$superuserInfo?>
                </form>
            </div>
            </div>
          </div>
        </div>
        </div>
     </div>
     <!--主体内容 end-->         
</div>
<!--main end-->
