<?php  foreach ($storage as $key => $value): ?>
	<li data-attr-value="<?= $key?>" data-attr-id="<?= $value['depotId']?>" class="lineBlock<?php if($defaultWhouse['depotName'] == $key):?> selectActive<?php endif;?>">
		<i> </i>
		<?= $key;?>
	</li>
<?php endforeach;?>