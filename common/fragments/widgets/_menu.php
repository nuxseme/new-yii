<?php
use yii\helpers\Url;
?>

<ul class="accountLeft lineBlock">
    <li class="leftCategory"><em></em>Account</li>
    <li <?php if($displayName == 'myprofile'):?>class="leftAct"<?php endif;?>><a href="<?=Url::toRoute(['account/profile']);?>">My Profile</a></li>
    <li <?php if($displayName == 'mymessage'):?>class="leftAct"<?php endif;?>><a href="<?=Url::toRoute(['message/index']);?>">My Message</a></li>
    <li <?php if($displayName == 'shipaddress'):?>class="leftAct"<?php endif;?>><a href="<?=Url::toRoute(['address/shipping']);?>">Shipping Address</a></li>
    <li <?php if($displayName == 'billaddress'):?>class="leftAct"<?php endif;?>><a href="<?=Url::toRoute(['address/billing']);?>">Billing Address</a></li>
    <li <?php if($displayName == 'mycoupons'):?>class="leftAct"<?php endif;?>><a href="<?=Url::toRoute(['wallet/coupon','type'=>'unused']);?>">My Coupons</a></li>
    <li <?php if($displayName == 'mypoints'):?>class="leftAct"<?php endif;?>><a href="<?=Url::toRoute(['wallet/point','type'=>'unused']);?>">My Points</a></li>
    <li class="leftCategory"><em></em>Order</li>
    <li <?php if($displayName == 'myorder'):?>class="leftAct"<?php endif;?>><a href="<?=Url::toRoute(['order/index']);?>">My Order</a></li>
<li class="leftCategory"><em></em>Shopping</li>
<li <?php if($displayName == 'mywishlist'):?>class="leftAct"<?php endif;?>><a href="<?=Url::toRoute(['wish/index']);?>">My Wishlist</a></li>
<li class="leftCategory"><em></em>Community</li>
<li <?php if($displayName == 'myreviews'):?>class="leftAct"<?php endif;?>><a href="<?=Url::toRoute(['review/index']);?>">My Reviews</a></li>
</ul>