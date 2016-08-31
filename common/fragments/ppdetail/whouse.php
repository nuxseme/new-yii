<p class="tt">Choose your country:<span data-key="whouse"><?=$defaultWhouse['depotName']?></span></p>
  <ul class="lineBlockBox select_country selectAttribute">
  <?php foreach ($storage as $key => $value): ?>
  	<li data-attr-value="<?=$value['depotName'];?>" data-attr-id="<?= $value['depotId'];?>" <?php if($key == $defaultWhouse['depotName']){echo 'class="active"';}?>>
  		<span><?=$key?></span><i></i>
  	</li>
  <?php endforeach;?>
  </ul>