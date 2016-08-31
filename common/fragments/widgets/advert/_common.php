<?php foreach($items as $item):?>
<li class="<?= isset($itemOptions['class']) ? $itemOptions['class'] : ''?>">
	<?php if($itemOptions['link'] == 'no'):?>
        <img alt="<?= $item['title']?>" class="lazy" src="<?= $item['imgUrl']?>" />
    <?php else:?>
	    <a href="<?= $item['url']?>" class="productImg">
	        <img alt="<?= $item['title']?>" class="lazy" src="<?= $item['imgUrl']?>" />
	    </a>
    <?php endif;?>
</li>
<?php endforeach;?>