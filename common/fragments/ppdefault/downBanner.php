<?php
use yii\helpers\Url;
$TTHelper = Yii::$container->get('TTHelper');
?>
<!--主体内容-->
   <div class="content">
      <ul class="colum_wrap lineBlockBox">
      <?php 
      $count = 0;
      foreach ($banners as $banner) : 
      ?>
       <li <?php if($count == 1){echo 'class="second"';}?>><h3><?=$banner['name']?></h3><a href="<?=$banner['url']?>" class="animate"><img src="<?=$banner['imgUrl']?>" alt=""></a></li>
      <?php 
      $count++;
      endforeach; 
      ?>
      </ul>
   </div>
   <!--主体内容 end--> 