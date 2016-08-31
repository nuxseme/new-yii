<?php
/**
* 布局文件头部导航文件
* @author caoxl
*/
use yii\helpers\Url;

$categories = $this->context->controller->categories;//所有分类
?>
<nav class="pu_mainNav_Warp lbBox insideNav">
<div class="contentInside">
   <div class="classifyNav lineBlock">
		<ul class="pu_classifyNavWarp" style="display: block">
			<?php
			foreach($categories as $category):
			?>
				<li class="sidelist">
					<a class="sidelistA" title="<?= $category['cname']?>" href="<?= Url::toRoute(['cate/index', 'cname' => strtolower(mb_substr($category['cpath'], strrpos($category['cpath'], "/"))), 'cid' => $category['icategoryid']]);?>"><?= $category['cname'];?> <i class="icon-arr-R"> </i></a>
					<div class="submenu lbBox">
						<div class="lineBlock subSecond list01">
						<?php 
						if(isset($category['son'])):
							foreach((array)$category['son'] as $k => $category2):
						?>
							<dl class="lineBlock subThird <?= ($k == 0 ? 'thirdBlock' : '')?>">
								<dt>
									<a title="<?= $category2['cname'];?>" class="subSecondA <?= ($k==0 ? 'subSecondAci' : '');?>" href="<?= Url::toRoute(['cate/index', 'cname' => strtolower(mb_substr($category2['cpath'], strrpos($category2['cpath'], "/") + 1)), 'cid' => $category2['icategoryid']]);?>">
										<?= $category2['cname']?>
									</a>
								</dt>
									<?php if(isset($category2['son'])):?>
										<?php foreach((array)$category2['son'] as $category3):?>
								<dd><a title="<?= $category3['cname']?>" href="<?= Url::toRoute(['cate/index', 'cname' => strtolower(mb_substr($category3['cpath'], strrpos($category3['cpath'], "/") + 1)), 'cid' => $category3['icategoryid']]);?>"><?= $category3['cname']?></a></dd>
										<?php endforeach;?>
									<?php endif;?>
							</dl>

						<?php 
							endforeach;
						endif;
						?>
						</div>

						<div class="specialOffer_box">
							<div class="lineBlock specialOffer">
								<p class="lineBlock">Special Offer</p>
								<a href="<?=Url::toRoute('channel/newarrivals') ?>">New Arrivals</a>
							</div>
							<?php 
							foreach((array)$categoryBg as $bk => $bg):
								if($bg['categoryId'] == $category['icategoryid']):
							?>
								<div class="cc_hover_navimg"><a href="<?= $bg['url']?>"><img src="<?= $bg['imgUrl']?>" alt="<?= $bg['title']?>"></a></div>
							<?php 
								endif;
							endforeach;
							?>
						</div>
					</div>
				</li>
			<?php
			endforeach;?>
		</ul>
	</div></div>
	
</nav>
<div class="header_ad">
	<ul class="clear">
	     <li>
			<a href="javascript:void(0);">
				<i class="gou"></i>
				<p><span>Photo Productivity-oriented</span></p>
			</a>
		</li>
		<li>
			<a href="javascript:void(0);">
				<i class="free"></i>
				<p><span>Weekly New Arrival</span></p>
			</a>
		</li>
		<li>
			<a href="javascript:void(0);">
				<i class="off"></i>
				<p><span>30-Day Return Policy</span></p>
			</a>
		</li>
		<li>
			<a href="/new-arrivals">
				<i class="new"></i>
				<p><span>Worldwide Shipping</span></p>
			</a>
		</li>
	</ul>
</div>