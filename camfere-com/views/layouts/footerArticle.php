<?php
$TTHelper = Yii::$container->get('TTHelper');
?>
<?php foreach((array)$articleList as $key => $data):?>
<li class="lineBlock">
	<p><?= $key?></p>
	<?php foreach($data as $article):?>
		<div><a rel="nofollow" title="<?= $article['title'];?>" target="_blank" href="<?= $TTHelper->getArticleUrl($article['url']);?>"><?= $article['title'];?></a></div>
	<?php endforeach;?>
</li>
<?php endforeach;?>