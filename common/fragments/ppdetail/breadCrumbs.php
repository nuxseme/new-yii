<?php 
use yii\helpers\Url;
?>
<!--面包屑开始-->
<div class="crumbs w">
             <ul class="lineBlockBox">
             <li><a href="<?=Url::home();?>">Home</a><span>/</span></li>
				<?php 
				$count = count($breadCrumbs);
				foreach ($breadCrumbs as $key => $value) 
				{ 
					$pos = strrpos($value['cpath'], "/");
		            $start = ($pos === false ? 0 : ($pos + 1));
		            $cname = strtolower(mb_substr($value['cpath'], $start));
		            $url = Url::toRoute(['cate/index', 'cname' => $cname, 'cid' => $value['categoryId']]);
					if($key + 1 == $count)
					{ 
				?>
						<li><a href="<?= $url;?>"><?=$value['name']?></a></li>
				<?php 
					}
					else
					{ 
				?>
					 <li><a href="<?= $url;?>"><?=$value['name']?></a><span>/</span></li>
				<?php 
					}
				}
				?>
             </ul>
</div>
<!--面包屑结束-->