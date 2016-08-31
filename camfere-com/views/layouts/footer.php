<?php
/**
* 布局文件脚部文件
* @author caoxl
*/
use yii\helpers\Url;
$TTHelper = Yii::$container->get('TTHelper');
?>
<footer class="contentOut pu_footer">
	<div class="contentInside">
		<div class="fixed_bottomWarp">
			<div class="fixed_bottom">
				<p class="fixedBTxt"></p>
				<div class="fixedRecently">
				</div>
				<div class="emailPop_right">
					<div class="emailPop_right_box">
						<div class="emailPop">
							<a href="https://www.chicuu.com/index.php?r=member/default/register" class="emailPop_register"></a>
							<div class="emailWarp">
								<form class="emailForm">
									<input class="subEmail" type="text" placeholder="your@email.com  " />
									<input class="btn" type="button" onclick="return ischeckemail(this)" value="SUBMIT" />
								</form>
								<div class="emailUs">
									<a href="https://www.facebook.com/CHICUUOFFICIAL/"></a>
									<a href="https://www.pinterest.com/chicuu1"></a>
									<a href="https://twitter.com/CHICUU_OFFICE"></a>
									<a href="https://www.instagram.com/chicuu_official/"></a>
									<a href="http://chicuu.polyvore.com/"></a>
									<a href="https://plus.google.com/u/0/116719380759276759685"></a>
									<a href="https://www.blogger.com/home"></a>
									<a href="https://www.youtube.com/channel/UCVvcFrAls5HVCDs6psY2NOg"></a>
								</div>
							</div>
						</div>
						<div class="emailPop_right_but">
							<span class="arrows"></span>
							<p class="title">Up to 35% off</p>
						</div>
					</div>
				</div>
				<a class="icon_move_zan" href="<?= Url::toRoute('wish/index');?>"></a>
				<a class="icon_move_cart" href="<?= Yii::$app->params['cartHost'];?>"></a>
				<a class="liveChat" href="http://tb.53kf.com/code/client/10140333/1" target="_blank"> </a>
				<div class="toTopButton"> </div>
			</div>
	    </div>
		
		<ul class="pu_join_sns lbUl">
			<li class="followUs">Connect with Us</li>
			<li class="spanFacebook">
				<a rel="nofollow" href="https://www.facebook.com/Camferefans/"  target="_blank">
					<span class="spans"> </span>
				</a>
			</li>
			<li class="spanTwitter">
				<a rel="nofollow" href="https://twitter.com/Camferefans"  target="_blank">
					<span class="spans"> </span>
				</a>
			</li>
			<li class="spanYoutube">
				<a rel="nofollow" href="https://www.youtube.com/channel/UCIou6wU2bZiCX0QUBrQZ_Yg" target="_blank">
					<span class="spans"> </span>
				</a>
			</li>
			<li class="spanGoogle">
				<a rel="nofollow" href="https://plus.google.com/u/2/b/103737338646914856944/103737338646914856944" target="_blank">
					<span class="spans"> </span>
				</a>
			</li>
			<li class="Instagram">
				<a rel="nofollow" href="https://www.instagram.com/CAMFERE/" target="_blank">
					<span class="spans"> </span>
				</a>
			</li>
        </ul>
        </div>
        <div class="content_footer">
          <div class="contentInside">
 		   <ul class="pu_siteMap lbBox">
 		   	<?= $this->params['footerArticle']?>
        	<li class="lineBlock">
        		<p>Newsletter</p>
				 <div><span>Enter Email Address get special discounts <br>
and exclusive promotions!</span></div>
               <div class="savings ">
					<input type="text"  placeholder="Email address">
					<input type="button" value="Subscribe"  class="btn btn-primary">
				</div>
			</li>
        </ul>
         <p class="pu_copyright"><?= Yii::$app->params['copyRight'];?></p>
        <ul class="lbUl pu_payment">
        	<li class="icPaypal"> </li>
        	<li class="icVisa"> </li>
        	<li class="icJcb"> </li>
        	<li class="icDisc"> </li>
        	<li class="icDiners"> </li>
        	<li class="icNorton"> </li>
        	<li class="icMca"><a href="javascript:void(0)" tabindex="-1"></a></li>
        </ul>
        </div>
       </div>
</footer>
<!--公用黑底弹层-->
<div class="mask"></div>
<!-- Google Tag Manager -->

<noscript><iframe id="google_count" src="//www.googletagmanager.com/ns.html?id=GTM-W7B6CT"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>
	var addHandler = function(element, eventName, handler){
		element.addEventListener ? element.addEventListener(eventName, handler, false) : element.attachEvent("on" + eventName, handler)
	}

	addHandler(window,'load',function () {
		(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-W7B6CT');

	});

</script>
<!-- End Google Tag Manager -->