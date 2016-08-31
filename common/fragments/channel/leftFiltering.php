<?php
$TTHelper = Yii::$container->get('TTHelper');

//排序
$sort = Yii::$app->request->get('sort');

//cpath
$cpath = Yii::$app->request->get('cpath');

//面包屑
$breadCrumbs = $TTHelper->breadCrumbs(Yii::$app->request->get('id'));

//传递的id
$id = Yii::$app->request->get('id');
?>
<div class="lineBlock categoryWarpLeft"> 
  <?php if($releaseDate):?>
    <div class="DepartmentBox">
        <p class="dirTitle"><i class="icon-minus"> </i>Release Date</p>
        <div class="dirToggleFs">
          <?php foreach ($releaseDate as $key => $value):?>
            <a class="dirTitles radioA<?php if($value['dateStr'] == Yii::$app->request->get('releaseTime')):?> radioSelect<?php endif;?>" 
                href="<?= $TTHelper->newArrivalReleaseTime(array('releaseTime' => $value['dateStr']), 'releaseTime');?>" 
                title="Select <?= $value['dateStr']?>">
                <?= $value['dateName']?>(<?= $value['num']?>)
                <span><b></b></span>
            </a>
          <?php endforeach;?>
        </div>
    </div>
  <?php endif;?>
  
  <div class="DepartmentBox">
      <p class="dirTitle"><i class="icon-minus"> </i><?= $TTHelper->getSiteLang['catalog.department']?></p>
      <div class="dirToggleFs">
          <a class="dirTitles <?php if(empty($cpath)):?>selectOrange<?php endif;?>" 
            title="All Categories" 
            href="<?= str_replace('cpath=' . $cpath . '&id=' . $id, '', $_SERVER['REQUEST_URI'])?>">
            <?php if(empty($cpath)):?><i class="icon-point"> </i><?php endif;?>
            All Categories
          </a>
          <?php 
          foreach ($breadCrumbs as $key => $value):
          ?>
            <?php if($value['level'] == 2):?>
              <a href="<?= $TTHelper->newArrivalReleaseTime(
                                                                array(
                                                                       'cpath' => $value['cpath'], 
                                                                       'id' => $value['categoryId']
                                                                      ),
                                                                'cpath'
                                                              );?>" 
                  title='<?= $value['name']?>' 
                  class="dirTitleList <?php if(count($breadCrumbs) == 2):?>dirAci<?php endif;?>">
                  <i class="icon-point <?php if(count($breadCrumbs) == 2):?>icon-pointG<?php endif;?>"> </i>
                  <?= $value['name']?>
              </a>
            <?php elseif ($value['level'] == 3):?>
            <ul class="dirList block">
              <li>
                <a href="<?= $TTHelper->newArrivalReleaseTime(array(
                                                                        'cpath'=>$value['cpath'],
                                                                        'id'=>$value['categoryId']
                                                                      ),
                                                                  'cpath'
                                                                );?>" 
                  title='<?= $value['name']?>' 
                  class="dirTitles  <?php if(count($breadCrumbs) == 3):?>dirAci<?php endif;?>">
                    <i class="icon-point <?php if(count($breadCrumbs) == 3):?>icon-pointG<?php endif;?>"> </i>
                    <?= $value['name']?>
                </a>
              </li>
            </ul>
            <?php else:?>
              <a href="<?= $TTHelper->newArrivalReleaseTime(array(
                                                                      'cpath' => $value['cpath'],
                                                                      'id' => $value['categoryId']
                                                                    ),
                                                                'cpath'
                                                            );?>" 
                  title='<?= $value['name']?>' 
                  class="dirTitles">
                    <?= $value['name']?>
              </a>
            <?php endif;?>
          <?php endforeach;?>
          <?php if($aggsMap['mutil.productTypes.productTypeId']):
            $category = $TTHelper->findParentCategories($cpath);
            $currentName = str_replace(' ', '-', str_replace('&', '', $category['cname']));
            $categoryName = ($category['ilevel'] > 1) ? '/' . $currentName : $category['cpath'];
            $cpathUrl = str_replace($categoryName, '', $_SERVER['REQUEST_URI']);
          ?>
          <?php if($breadCrumbs[count($breadCrumbs) - 1]['level'] == 2):?>
          <ul class="dirList block">
          <?php endif;?>
          <?php foreach ($aggsMap['mutil.productTypes.productTypeId'] as $key => $value):?>
            <a  href="<?= $TTHelper->newArrivalReleaseTime(array(
                                                                'cpath' => $value['cpath'],
                                                                'id' => $value['id']
                                                              ),
                                                          'cpath');?>" 
                title='<?= $value['name']?>' 
                class="dirTitles">
              <i class="icon-point"> </i>
              <?= $value['name']?>
              <span>(<?= $value['count']?>)</span>
            </a>
          <?php endforeach;?>
          <?php if($breadCrumbs[count($breadCrumbs)-1]['level'] == 2):?></ul><?php endif;?>
         <?php endif;?>
      </div>
  </div>

  <?php 
  $depotname = Yii::$app->request->get('depotname');
  $tagNameUrl = str_replace($depotname, strtoupper($depotname), $_SERVER["QUERY_STRING"]);
  unset($aggsMap['mutil.productTypes.productTypeId']);
  foreach ($aggsMap as $key => $value):
    if(empty($value)) continue;
  ?>
  <div class="DepartmentBox">
      <p class="dirTitle"><?= $TTHelper->displayCateAttrName($key)?><i class="icon-minus"> </i></p>
      <div class="dirToggle">
        <?php 
        $tagName = '';
        foreach ($value as $j => $data):
          $tagName = $TTHelper->extractAttrName(strtolower($key));
        ?>
          <a rel="nofollow" class="dirSelectList<?php if(strstr($tagNameUrl, $data['name'])):?> selectOrange<?php endif;?>" 
          <?php if(strstr($tagNameUrl, $data['name'])):?>
            href="<?= $TTHelper->attrSelectUrl(array($tagName => $data['name']), false, $data['name']);?>"
          <?php else:?>
            href="<?= $TTHelper->attrSelectUrl(array($tagName => $data['name']));?>"
          <?php endif;?>
        ><i class="multi-select<?php if(strstr($tagNameUrl, $data['name'])):?> multiAci<?php endif;?>"> </i>
          <?php 
          if($key == 'yjPrice')
          {
            echo $TTHelper->displayAttrPrice($data['name']);
          }
          else
          { 
            echo $TTHelper->displayAttrName($data['name']);
          }?>
          <span>(<?= $data['count']?>)</span></a>
        <?php endforeach;?>
      </div>
    </div>
    <?php endforeach;?>
 </div>