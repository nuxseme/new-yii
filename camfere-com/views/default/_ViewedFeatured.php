<?php
/**
 * @desc 轮播式产品展示
 */
use yii\helpers\Html;
use common\widgets\ProductDisplayWidget;

$TTHelper = Yii::$container->get('TTHelper');

//历史浏览记录
$viewHistory = $TTHelper->getViewHistory();

//你可能喜欢产品推荐
$youMightLike = $TTHelper->getYouMightLike();

//获取WEB-history cookies
$webHistory = $TTHelper->getCookie('WEB-history');
?>
<?php if($youMightLike):?>
<div class="listPageTitle">
	<p><?= $TTHelper->getSiteLang('home.yourRecentlyAndFeatrued')?></p>
</div>

<!--历史记录左边-->
<div class="histLeftBox lineBlock">
	<p class="histTitle"><?= $TTHelper->getSiteLang('home.youViewed')?></p>
	<?= ProductDisplayWidget::widget([
	      'items'         => $viewHistory,
	      'displayType'   => ProductDisplayWidget::DISPLAY_TYPE_ROLL,
          'itemOptions'    => array(
               'class'     => 'viewedWarp',
          ),
	]);?>
</div>
<!--历史记录右边-->
<div class="histRightBox lineBlock">
	<p class="histTitle"><?= $TTHelper->getSiteLang('home.youMayAlsoLike')?></p>
	<?= ProductDisplayWidget::widget([
	      'items'         => $youMightLike,
	      'displayType'   => ProductDisplayWidget::DISPLAY_TYPE_AUTOPLAY,
	      'itemOptions'   => array('class' => 'alsoLike'),
	      'includeHeader' => false,
	]);?>
</div>
<?php endif;?>