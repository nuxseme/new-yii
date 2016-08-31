 <?php 
use yii\helpers\Url;
 ?>
 	<div class="crumbs w">
         <ul class="lineBlockBox">
           <li><a href="<?=Url::home()?>">Home</a><span>/</span></li>
           <li><a href="<?=Url::toRoute('channel/'.$channelName)?>"><?=$channelName?></a></li>
         </ul>
    </div>