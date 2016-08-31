<?php 
	$TTHelper = Yii::$container->get('TTHelper');
?>

<!--轮播bannner-->
   <div class="banner">
      <div class="scroll_container">
      <ul class="scroll_wrap">
      <?php 
      foreach ($banners as $banner) 
      { 
      ?>
        <li style="background:#f3f3f3">
          <a href="<?= $banner['url']?>">
            <img src="<?= $banner['imgUrl']?>" alt="<?= $banner['title'];?>">
          </a>
        </li>
      <?php 
      }
      ?>
      </ul>
      <div class="nav_btn"></div>
      <div class="pre_btn"><span></span></div>
      <div class="next_btn"><span></span></div>
   </div>
   </div>
   <!--轮播bannner end-->


