<?php 
use yii\helpers\Json;
$TTHelper = Yii::$container->get('TTHelper');
?>
<script type="text/javascript">
	<?php
		$jsonArr = [
			'sku' => $productInfo['sku'],
			'title' => $productInfo['title'],
			'currency' => $TTHelper->getCookie('TT_CURR'),
			'language' => $TTHelper->getCookie('PLAY_LANG')
		];
	?>
	var product = <?= Json::encode($jsonArr);?>;
	var mainContent = <?= Json::encode($mainContent);?>;
</script>