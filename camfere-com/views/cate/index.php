<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\components\AppAsset;
use common\widgets\CategoryDisplayWidget;
use common\widgets\ProductDisplayWidget;

//助手类
$TTHelper = Yii::$container->get('TTHelper');

//排序
$sort = $this->context->sort;

//注册资源文件
AppAsset::register($this, 'cate');
?>
<section class="contentInside lbBox">
<?php if($productList):?>
	<!--左侧筛选条件-->
	<?= $leftFiltering?>
	
	<div class="lineBlock categoryWarpRight">
		<?= ProductDisplayWidget::widget([
		      'items'         => $breadCrumbs,
		      'displayType'   => ProductDisplayWidget::DISPLAY_TYPE_BREADCRUMBS,
		]);?>
		<!--banner-->
		<?= $bannerSlider?>
		<!--end banner-->
		
		<!--导航条-->
		<div class="categoryNavWarp">
			<p><?= $displayNumber['startNumber']?>-<?= ($pages->total < 40) ? $pages->total : $displayNumber['toNumber'];?> of <?= $pages->total?> results for</p>
			<h1><?= ($subCategories['cname'] == '') ? $breadCrumbs[2]['name'] : $subCategories['cname'];?></h1>
			<?= $sortCate;?>
		</div>
		
		<!--纵向产品列表-->
		<?= CategoryDisplayWidget::widget([
		      'items'         => $productList,
		      'pages'         => $pages,
		      'displayType'   => CategoryDisplayWidget::DISPLAY_TYPE_LONGITUDINAL,
		      'itemOptions'   => array('class' => ''),
		]);?>
	<?php else:?>
		<div class="searchNone">
			<p>Sorry, No Products Found!</p>
			<a class="btn btn-orange" href="<?= Url::home();?>">Continue Shopping</a>
		</div>
	<?php endif;?>
</section>
<section id="viewedFeatured" class="contentInside lbBox  historicalWarp"> </section>