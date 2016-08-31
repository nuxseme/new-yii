<?php
use yii\helpers\Url;

$TTHelper = Yii::$container->get('TTHelper');
$categories = $this->context->controller->categories;//分类列表
//print_r($categories);
?>

    <div class="tab_nav_container">
       <div class="w">
         <div class="scroll_wrap">
           <ul class="tab_nav lineBlockBox">
           <?php 
           $count = 0;
           foreach ($categories as $key=>$category):
              $pos = strrpos($category['cpath'], "/");
              $start = ($pos === false ? 0 : ($pos + 1));
              $cname = strtolower(mb_substr($category['cpath'], $start));
           ?>
            <a data-cpath="<?= $category['cpath'];?>" href="<?= Url::toRoute(['cate/index', 'cname' => $cname, 'cid' => $category['icategoryid'], 'eq' => $count]);?>">
                <li class="li<?=$key+1?> <?php if($category['icategoryid'] == Yii::$app->request->get('cid')){echo 'active';}?>">
                  <span></span><p><?=$category['cname']?></p>
                </li>
            </a>
           <?php 
              $count++;
           endforeach;
           ?>
           </ul>
         </div>
       </div>
    </div>
      
