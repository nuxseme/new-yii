<?php
use yii\helpers\Url;
//排序
$sort = Yii::$app->request->get('sort');

$cpath = Yii::$app->request->get('cpath');

$TTHelper = Yii::$container->get('TTHelper');
?>
<div class="lineBlock categoryWarpLeft"> 
    <?php if($categoryToProduct):?>
    <div class="DepartmentBox">
      <div class="dirToggleFs">
        <a href="<?= Url::toRoute('channel/topsellers');?>" class="dirTitles radioA <?php if(empty($cpath)){echo 'radioSelect';}?>" title="All Category">
          All Category<span><b></b></span>
        </a>
        <?php 
        foreach ($categoryToProduct as $key => $value):
          $cateName = explode('|',$key);
        ?>
        <a href="<?= Url::toRoute(['channel/topsellers-list', 'cpath' => $cateName[1]]);?>" class="dirTitles radioA <?php if($cateName[1] == $cpath){echo 'radioSelect';}?>" title="<?= $cateName[0]?>">
          <?= $cateName[0]?>
          <span><b></b></span>
        </a>
        <?php endforeach;?>
      </div>
    </div>
    <?php endif;?> 
    <?php if($whatHot):?>
    <div class="DepartmentBox">
      <p class="RightTitle"><?= $TTHelper->getSiteLang['home.whatHot']?></p>
      <ul class="lbBox rightBanner">
        <?php foreach($whatHot as $item):?>
        <li>
            <a href="<?= $item['url']?>">
                <img alt='<?= $item['title']?>' src="<?= $item['imgUrl']?>" />
            </a>
        </li>
        <?php endforeach;?>
      </ul>
    </div>
    <?php endif;?>
 </div>