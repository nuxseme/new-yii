<?php
/**
 * @desc 轮播Banner展示
 */
?>
<?php if($items):?>
<div class="bannerwrap" style="<?php if($width !== null):?>width:<?=$width ?>px;<?php endif;?><?php if($height !== null):?>height:<?= $height?>px;<?php endif;?>">
	<ul class="banner lbBox">

        <?php foreach($items as $item):?>
        <li class="lineBlock imgBanner">
			<a href="<?= $item['url']?>">
			    <img alt="<?= $item['title']?>" src="<?= $item['imgUrl']?>" />
			</a>
		</li>
        <?php endforeach;?>

	</ul>
	<a href="javascript:void(0)" class="bannerLeft_click leftArr"> </a>
	<a href="javascript:void(0)" class="bannerRight_click rightArr"> </a>
	<div class="bannerPoint">
	   <?php for($i = 0, $_len = count($items); $i < $_len; $i++): ?>
	   <?php if($i == 0):?>
	   <b class="lineBlock point-on"> </b>
	   <?php else:?>
	   <b class="lineBlock"> </b>
	   <?php endif;?>
	   <?php endfor;?>
    </div>
</div>
<?php endif;?>