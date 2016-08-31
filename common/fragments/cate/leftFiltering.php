<?php
use yii\helpers\Url;

$TTHelper = Yii::$container->get('TTHelper');
?>
<div class="lineBlock categoryWarpLeft">
	<div class="DepartmentBox">
		<p class="dirTitle"><i class="icon-minus"> </i><?= $L['chicuu.catalog.department']?></p>
		<div class="dirToggleFs">
			<?php
			foreach ((array)$breadCrumbs as $key => $value):
				$pos = strrpos($value['cpath'], "/");
				$cname = ($pos === false ? strtolower($value['cpath']) : strtolower(mb_substr($value['cpath'], $pos + 1)));
				$cateUrl = Url::toRoute(['cate/index', 'cname' => $cname, 'cid' => $value['categoryId']]);
			?>

				<?php if($value['level'] == 2):?>
					<a href="<?= $cateUrl;?>" title="<?= $value['name']?>" class="dirTitleList <?php if(count($breadCrumbs) == 2):?>dirAci<?php endif;?>"><?= $value['name']?></a>
				<?php elseif ($value['level'] == 3):?>
				<ul class="dirList block">
					<li><a href="<?= $cateUrl;?>" title="<?= $value['name']?>" class="dirTitles  <?php if(count($breadCrumbs) == 3):?>dirAci<?php endif;?>"><?= $value['name']?></a></li>
				</ul>
				<?php else:?>
					<a href="<?= $cateUrl;?>" title="<?= $value['name']?>" class="dirTitles"><?= $value['name']?></a>
				<?php endif;?>
			<?php endforeach;?>
			<?php 
			if($aggsMap['mutil.productTypes.productTypeId']):
			?>
				<?php if(count($breadCrumbs) == 1):?>
					<?php 
					foreach ($aggsMap['mutil.productTypes.productTypeId'] as $key => $value):
						$pos = strrpos($value['cpath'], "/");
						$cname = ($pos === false ? strtolower($value['cpath']) : strtolower(mb_substr($value['cpath'], $pos + 1)));
						$cateUrl = Url::toRoute(['cate/index', 'cname' => $cname, 'cid' => $value['id']]);
					?>
						<a href="<?= $cateUrl;?>" title="<?= $value['name']?>" class="dirTitles"><?= $value['name']?> <span>(<?= $value['count']?>)</span></a>
					<?php endforeach;?>
				<?php else:?>
				<ul class="dirList block">
					<?php 
						foreach ($aggsMap['mutil.productTypes.productTypeId'] as $key => $value):
							$pos = strrpos($value['cpath'], "/");
							$cname = ($pos === false ? strtolower($value['cpath']) : strtolower(mb_substr($value['cpath'], $pos + 1)));
							$cateUrl = Url::toRoute(['cate/index', 'cname' => $cname, 'cid' => $value['id']]);
					?>
					<li>
						<a href="<?= $cateUrl;?>" title="<?= $value['name']?>" class="dirTitles"><?= $value['name']?> <span>(<?= $value['count']?>)</span></a></li>
					<?php endforeach;?>
				</ul>
				<?php endif;?>
			<?php endif;?>
		</div>
    </div>
    
    <?php 
    $tagNameUrl = $_SERVER["QUERY_STRING"];

    $queryParmas = Yii::$app->request->getQueryParams();
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
				<a rel="nofollow" class="dirSelectList<?php if(strstr($tagNameUrl, $data['name'])):?> selectBlack<?php endif;?>"
					<?php if(strstr($tagNameUrl, $data['name'])):?>
					href="<?= $TTHelper->attrSelectUrl(array($tagName => $data['name']), false, $data['name']);?>"
					<?php else:?>
						href="<?= $TTHelper->attrSelectUrl(array($tagName => $data['name']));?>"
					<?php endif;?>
				>
				<i class="multi-select<?php if(strstr($tagNameUrl, $data['name'])):?> multiAci<?php endif;?>"> </i>
				<?php 
				if($key == 'yjPrice')
				{
					echo $TTHelper->displayAttrPrice($data['name']);
				}
				else
				{ 
					echo $TTHelper->displayAttrName($data['name']);
				}
				?>
				<span>(<?= $data['count']?>)</span></a>
			<?php endforeach;?>
		</div>
	</div>
	<?php endforeach;?>
</div>