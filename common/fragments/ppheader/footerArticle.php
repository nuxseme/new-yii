<?php
$TTHelper = Yii::$container->get('TTHelper');
?>
<div class="foot_nav">
	<?php 
	$length = count($articleList);
	$count = 1;
	foreach((array)$articleList as $key => $data):
	?>
 	<a href="<?= $TTHelper->getArticleUrl($article['url']);?>"  title="<?= $article['title'];?>">
 		<?= $article['title'];?>
 	</a>
 	<?php 
 	if($count != $length):
 	?>
 		<span>|</span>
 	<?php
 	endif;
 	?>
 	<?php 
 	$count++;
 	endforeach;
 	?>
</div>