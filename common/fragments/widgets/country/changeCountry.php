<div class="pu_blockWarp country_all">
	<div class="search_country">
		<input type="text" name="country_filter">
	</div>
	<ul class="country_list">
	    <?php 
	    	foreach($countries as $country):
	    ?>
		<li class="country_item flag_<?= $country['isoCodeTwo']; ?>">
		    <em></em>
		    <span data="<?= $country['isoCodeTwo']; ?>"><?=$country['name']; ?></span>
		</li>
		<?php endforeach;?>
	</ul>
</div>
<select id="country_list" style="display:none;">
    <?php 
	   foreach($countries as $country):
	?>
	<option value="<?= $country['isoCodeTwo']; ?>"><?= $country['name']; ?></option>
	<?php endforeach;?>
</select>