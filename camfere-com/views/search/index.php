<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\components\AppAsset;
use common\widgets\AdvertWidget;
use common\widgets\CategoryDisplayWidget;
use common\widgets\ProductDisplayWidget;

//注册资源文件
AppAsset::register($this, 'cate');

//公用助手类
$TTHelper = Yii::$container->get('TTHelper');

//标题
$this->title = 'Search';

//排序
$sort = Yii::$app->request->get('sort');
?>
<section class="contentInside lbBox">
<?php if($productList != 'null'):?>
	<div class="lineBlock categoryWarpLeft">
		<div class="DepartmentBox">
			<?php if($aggsMap['mutil.productTypes.productTypeId']):?>
			<p class="dirTitle"><i class="icon-minus"> </i><?= $TTHelper->getSiteLang('catalog.department')?></p>
			<?php endif;?>
			<div class="dirToggleFs">
				<?php 
				$param = array(
								'sort', 
								'p',
								'yjprice',
								'tagname',
								'brand',
								'type',
								'cpath'
							);
				$searchPath = $_SERVER['REQUEST_URI'];
				foreach ($param as $key => $value)
				{ 
					if(Yii::$app->request->get($value) == '')
					{ 
						$searchPath = str_replace('&' . $value . '=', '', $searchPath);
					}
				}
				if(strstr($searchPath, '&cpath'))
				{ 
					$searchPath = str_replace('&cpath=' . Yii::$app->request->get('cpath') . '', '', $searchPath);
				}

				//删除name相同的参数
				$searchPath = str_replace('cpath=' . Yii::$app->request->get('cpath'), '', $searchPath);

				//获取对应的连接符"?" or "&"
				$connectSymbol = (strstr($searchPath, '?')) ? '&' : '?';
				$finalUrl = $searchPath . $connectSymbol;
				if(strstr($finalUrl, '?&'))
				{ 
					$finalUrl = str_replace('?&', '?', $finalUrl);
				}
				foreach ($aggsMap['mutil.productTypes.productTypeId'] as $key => $value):?>
					<a href="<?= $finalUrl.'cpath='.$value['cpath']?>" class="dirTitles"><?= $value['name']?> <span>(<?= $value['count']?>)</span></a>
				<?php endforeach;?>
			</div>
        </div>
        
        <?php 
        $tagNameUrl = $_SERVER["QUERY_STRING"];
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
					<a rel="nofollow" class="dirSelectList<?php if(strstr($tagNameUrl,$data['name'])):?> selectOrange<?php endif;?>" 
					<?php if(strstr($tagNameUrl, $data['name'])):?>
						href="<?= $TTHelper->searchAttrSelectUrl(array($tagName => $data['name']), false,$data['name']);?>"
					<?php else:?>
						href="<?= $TTHelper->searchAttrSelectUrl(array($tagName => $data['name']));?>"
					<?php endif;?>
				><i class="multi-select<?php if(strstr($tagNameUrl, $data['name'])):?> multiAci<?php endif;?>"> </i>
					<?php 
					if($key == 'yjPrice'){
						echo $TTHelper->displayAttrPrice($data['name']);
					}else{ 
						echo $data['name'];
					}?>
					<span>(<?= $data['count']?>)</span></a>
				<?php endforeach;?>
			</div>
		</div>
		<?php endforeach;?>
	</div>
	
	<div class="lineBlock categoryWarpRight">
		<!--面包屑-->
		<ul class="Bread_crumbs lbUl">
			<li class="Bread_home lineBlock">
				<a href="index.php" class="icon-home"> </a>
			</li>
			<li>
				<i class="icon-breadArr"> </i>
				<a href="javascript:void(0)">Search</a>
			</li>
		</ul>

		<!--导航条-->
		<div class="categoryNavWarp">
			<p><?= $displayNumber['startNumber']?>-<?= ($pages->total < 40) ? $pages->total : $displayNumber['toNumber'];?> of <?= $pages->total?> results for</p>
			<h1><?= str_replace('~D~', '.', $this->context->keyword)?></h1>
			<ul class="lbBox cateforySelect">
				<li class="lineBlock">
					<span><?= $TTHelper->getSiteLang('catalog.sort')?></span>
					
					<div class="lineBlock selectWarp lbBox">
						<div class="lineBlock selectTxt"><?= $TTHelper->getSiteLang('catalog.featured')?></div>
						<a class="lineBlock selectBtn" href="javascript:void(0)"> </a>
						<ol class="selectValue">
							<div style="display:none;"><?= $sort?></div>
							<li data-rel="featured"<?php if($sort == 'featured' || $sort == ''):?> class="active"<?php endif;?>><?= $TTHelper->getSiteLang('catalog.featured')?></li>
							<li data-rel="newest"<?php if($sort == 'newest'):?> class="active"<?php endif;?>><?= $TTHelper->getSiteLang('catalog.newest')?></li>
							<li data-rel="popular"<?php if($sort == 'popular'):?> class="active"<?php endif;?>><?= $TTHelper->getSiteLang('catalog.mostPopular')?></li>
							<li data-rel="reviews"<?php if($sort == 'reviews'):?> class="active"<?php endif;?>><?= $TTHelper->getSiteLang('catalog.mostReviews')?></li>
							<li data-rel="price_low"<?php if($sort == 'price_low'):?> class="active"<?php endif;?>><?= $TTHelper->getSiteLang('catalog.priceLowToHigh')?></li>
							<li data-rel="price_high"<?php if($sort == 'price_high'):?> class="active"<?php endif;?>><?= $TTHelper->getSiteLang('catalog.priceHighToLow')?></li>
						</ol>
					</div>
				</li>
				<li class="lineBlock">
					<a class="icon-showList active" href="javascript:void(0)"> </a>
				</li>
				<li class="lineBlock">
					<a class="icon-showBlock" href="javascript:void(0)"> </a>
				</li>
			</ul>
		</div>
		
		<!--纵向产品列表-->
		<?= CategoryDisplayWidget::widget([
		      'items'         => $productList,
		      'pages'         => $pages,
		      'displayType'   => CategoryDisplayWidget::DISPLAY_TYPE_LONGITUDINAL,
		      'itemOptions'   => array('class' => ''),
		]);?>
				
	</div>
	<?php else:?>
		<div class="searchNone">
			<p>Sorry, we have found 0 items that match <span class="fz_red"><?= str_replace('~D~', '.', str_replace('>', '', str_replace('<', '', $this->context->keyword)))?></span></p>
			<a class="btn btn-orange" href="<?= Url::home();?>">Continue Shopping</a>
		</div>
	<?php endif;?>
</section>
<section id="viewedFeatured" class="contentInside lbBox  historicalWarp"> </section>