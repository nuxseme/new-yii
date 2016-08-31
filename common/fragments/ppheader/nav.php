<?php
use yii\helpers\Url;

$TTHelper = Yii::$container->get('TTHelper');
$categories = $this->context->controller->categories;//分类列表
?>
<nav>
       <ul class="lineBlockBox">
         <li><a href="javascript:void(0)">Product</a>
           <div class="product_nav animate">
             <ul class="lineBlockBox">
            <?php 
            $count = 0;
            foreach ($categories as $category)
            {
              $pos = strrpos($category['cpath'], "/");
              $start = ($pos === false ? 0 : ($pos + 1));
              $cname = strtolower(mb_substr($category['cpath'], $start));
            ?>
            	<li><a href="<?= Url::toRoute(['cate/index', 'cname' => $cname, 'cid' => $category['icategoryid'], 'eq' => $count]);?>" class="animate"><img src="<?= $TTHelper->staticPrefix();?>/img/<?=$category['icategoryid']?>.png" alt=""></a><p><?= $category['cname']; ?></p></li>
            <?php 
              $count++;
            } 
            ?>
             </ul>
           </div>
         </li>
         <li><a href="<?= Url::toRoute('channel/newarrivals')?>">Support</a></li>
         <li><a href="<?= Url::toRoute(['superuser/index']) ?> ">Super User</a></li>
         <li class="myAcount"><a href="<?=Url::toRoute('account/index')?>">my account</a></li>
         <li class="logout"><a href="<?=Url::toRoute('member/logout')?>">logout</a></li>
       </ul>
     </nav>