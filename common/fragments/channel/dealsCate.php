<?php
use yii\helpers\Url; 
$TTHelper = Yii::$container->get('TTHelper');
?>
<ul class="screen_c">
	<?php
		$categoryToIco = array(
		   'Tablet-PC-Cellphone'			=>	'cellphone',
	       'Computer-Networking'			=>	'pc',
	       'RC-Models-Hobbies'				=>	'rc',
	       'Test-Equipment-Tools'			=>	'tool',
	       'Cameras-Photo-Accessories'		=>	'camera2',
	       'Lighting-Flashlights-LEDs'		=>	'light',
	       'Home-and-Garden'				=>	'home',
	       'Apparel-Jewelry'				=>	'dress',
	       'Health-Beauty'					=>	'beauty',
	       'Sports-Outdoor'					=>	'outdoor',
	       'Car-Accessories'				=>	'car',
	       'Video-Audio'					=>	'video',
	       'Musical-Instruments'			=>	'music',
	       'Toys-Games'						=>	'game'
	    );
	    $currentCpath = Yii::$app->request->get('cpath');
	?>

	<?php
	foreach($dealsCategory as $key => $value):
	?>
	<li <?php if(Yii::$app->request->get('cpath') == $value['cpath']):?>class="select"<?php endif;?>>
		<a href="<?= $TTHelper->newArrivalReleaseTime(array('cpath' => $value['cpath']), 'cpath');?>">
			<i class="icon_<?= $categoryToIco[$value['cpath']]?>"></i>
			<span><?= $value['cname']?></span>
			<em></em>
		</a>
	</li>
	<?php
	endforeach; 
	?>
</ul>