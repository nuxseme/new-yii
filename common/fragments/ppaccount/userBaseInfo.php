<?php
$TTHelper = Yii::$container->get('TTHelper');
?>
<div class="acount_right">
  <div class="welcome_info clearfix">
     <div class="smile"></div>
     <div class="info">
        <p class="tt">Hi <?=$userBaseInfo['caccount']?>!</p>
        <p class="tt">Welcome to the Dodocool Member Center.</p>
        <p>Last logged in: <?=$userBaseInfo['bactivated']?></p>
     </div>
  </div>
  <div class="myinfo">
     <div class="photo">
       <img src="<?=$TTHelper->staticPrefix();?>/img/photo.jpg" alt="your photo">   
     </div>
     <div class="detail_info">
      <ul>
        <li class="lineBlockBox">
            <div class="col-5"><lable>User Name: </lable><em><?=$userBaseInfo['caccount']?></em></div>
            <div class="col-5"><lable>Gender: </lable><em><?=$userBaseInfo['igender']?></em></div>
        </li>
        <li class="lineBlockBox">
            <div class="col-5"><lable>E-mail: </lable><em><?=$userBaseInfo['cemail']?></em></div>
             <div class="col-5"><lable>Birthday: </lable><em><?=$userBaseInfo['dbirthStr']?></em></div>
        </li>
        <li class="lineBlockBox">
            <div class="col-5"><lable>Location: </lable><em><?=$userBaseInfo['ccountry']?></em></div>
             <div class="col-5"><lable>User Name: </lable><em><?=$userBaseInfo['caccount']?></em></div>
        </li>
        <li class="lineBlockBox">
            <div class="one_col"><lable>About me: </lable><em><?=$userBaseInfo['caboutme']?></em></div>
        </li>
       </ul>
     </div>
     <input type="button" value="edit" class="edit_btn defaultBtn">
  </div>
</div>


