<?php
use common\components\AppAsset;
//注册资源文件
AppAsset::register($this, 'newarrivals');
$TTHelper = Yii::$container->get('TTHelper');
?>
<!--main-->
<div id="main">
 <!--主体内容-->
 <div class="content">
    <?=$breadCrumbs?>
    <div class="tab_nav_container">
       <div class="w">
         <div class="scroll_wrap">
           <ul class="tab_nav lineBlockBox">
            <?=$topFiltering?>
           </ul>
         </div>
       </div>
    </div>
      <div class="tab_container w">
       <div class="tab_info">
      <?=$products?>       
        </div>
      </div>
 </div>
 <!--主体内容 end-->        
</div>
<!--main end-->

