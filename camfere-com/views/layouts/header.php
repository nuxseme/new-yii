<?php
/**
* 布局文件头部文件
* @author caoxl
*/
use yii\helpers\Url;

$siteInfo = $this->context->siteInfo;//站点基本信息
$TTHelper = Yii::$container->get('TTHelper');
?>

<nav class="contentOut pu_topNav">
	<?php if($this->params['topBanners']){ echo $this->params['topBanners'];}?>
	<div class="contentInside lbBox">
		<div id="google_translate_element"></div>
		<div class="lineBlock">
			<div class="pu_langWarp">
				<div id="google_translate_element"></div>
			</div>
		</div>
		<p class="lineBlock"><?= $TTHelper->getSiteLang('common.shipTo')?></p>
		<?= $this->params['countryList'];?>
		<?= $this->params['currencyList']?>
		<ul class="topNav_right">
       <!--	登录部件开始	-->
		<?= \common\widgets\LoginWidget::widget([
		]);?>
       <!-- 登录部件结束 -->
			<li class="rightHover lineBlock">
				<div class="pu_navHover">
					<a rel="nofollow" href="<?=Url::toRoute('account/index') ?>"><?= $TTHelper->getSiteLang('common.myAccount')?></a>
					<i class="icon-arr"> </i>
				</div>
				<div class="account_nav pu_blockWarp">

					<a rel="nofollow" title="<?= $TTHelper->getSiteLang('common.myOrders')?>" href="<?=Url::toRoute('account/index') ?>"><?= $TTHelper->getSiteLang('common.myOrders')?></a>
					<a rel="nofollow" title="<?= $TTHelper->getSiteLang('common.myCoupons')?>" href="<?=Url::toRoute('order/index') ?>"><?= $TTHelper->getSiteLang('common.myCoupons')?></a>
					<a rel="nofollow" title="<?= $TTHelper->getSiteLang('common.myPoints')?>" href="<?=Url::toRoute(['wallet/point', 'type' =>'unused']) ?>"><?= $TTHelper->getSiteLang('common.myPoints')?></a>
					<a rel="nofollow" title="<?= $TTHelper->getSiteLang('common.accountSettings')?>" href="<?=Url::toRoute('account/profile') ?>"><?= $TTHelper->getSiteLang('common.accountSettings')?></a>

				</div>
			</li>
			<li class="rightHover lineBlock">
			<li class="chat lineBlock"><a class="lineBlock" href="<?= Url::home();?>help-center.html" target="_blank"><?= $TTHelper->getSiteLang('common.needHelp')?>&nbsp;&nbsp;</a></li>
<!--				<div class="pu_navHover">-->
<!--					--><?//= $TTHelper->getSiteLang('common.needHelp')?>
<!--					<i class="icon-arr"> </i>-->
<!--				</div>-->
<!--				<ul class="help_nav pu_blockWarp">-->
<!--					<li class="lbBox">-->
<!--						<i class="icon-pre lineBlock"> </i>-->
<!--						<p class="lineBlock">-->
<!--							<b>--><?//= $TTHelper->getSiteLang('common.preSales')?><!--</b><br>-->
<!--							--><?//= $TTHelper->getSiteLang('common.preSalesDesc')?><!--.-->
<!--							<a href="--><?//= Url::home();?><!--help-center.html" target="_blank">--><?//= $TTHelper->getSiteLang('common.startOnlineChat')?><!--</a>-->
<!--						</p>-->
<!--					</li>-->
<!--					--><?php //if (0):?>
<!--					<li class="lbBox">-->
<!--						<i class="icon-after lineBlock"> </i>-->
<!--						<p class="lineBlock">-->
<!--							<b>--><?//= $TTHelper->getSiteLang('common.afterSales')?><!--</b><br>-->
<!--							--><?//= $TTHelper->getSiteLang('common.afterSalesDesc')?><!--. -->
<!--							<a href="http://staging.chicuu.com/base/cms/detail/37">--><?//= $TTHelper->getSiteLang('common.submitRequest')?><!--</a>-->
<!--						</p>-->
<!--					</li>-->
<!--					<li class="lbBox">-->
<!--						<i class="icon-asked lineBlock"> </i>-->
<!--						<p class="lineBlock">-->
<!--							<a href="#">--><?//= $TTHelper->getSiteLang('common.frequentlyAskedQuestions')?><!--</a>-->
<!--						</p>-->
<!--					</li>-->
<!--				--><?php //endif;?>
<!--				</ul>-->
			</li>
			<li class="chat lineBlock"><a class="lineBlock" href="http://tb.53kf.com/code/client/10140333/1" target="_blank">LIVE CHAT</a><i class="icon-chat"></i></li>
		</ul>
	</div>
</nav>
<header class="contentInside lbBox">
	<div class="lineBlock headerLogo">
		<a title="CAMFERE" href="<?= Url::home();?>"><img alt="TOMTOP" src="<?= $TTHelper->staticPrefix();?>/icon/logo.png" /></a>
	</div>
	<div class="lineBlock headerSearch">
		<div class="searchWarp">
			<input type="text" value="" placeholder="<?= $TTHelper->getSiteLang('home.whatAreYouLookingFor')?>" />
			<input type="button" class="btn ani_bg"  value=""/>
		</div>
	</div>
	<div class="lineBlock lbBox pu_headerRight">
		<div class="lineBlock pu_cartHeader pu_cartHeader2">
			<div class="pu_navHover" id="cartNumber">
				<span class="icon-cart"><b id="num_cart">0</b></span><span class="ver_mid">
                   Cart
				</span><i class="icon-arr"> </i>
			</div>
			<div class="pu_blockWarp cart_content">
			
			</div>
		</div>
	</div>
</header>