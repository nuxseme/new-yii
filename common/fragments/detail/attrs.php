<?php 
	$TTHelper = Yii::$container->get('TTHelper');
	if(!empty($productAttrs))
	{//列出该商品的所有属性
		$attrHtml = '';
		foreach($productAttrs as $attrKey => $attrValues)
		{
			$default = '';
			$attrColor = ($attrKey == 'color') ? 'selectColor' : '';
			$eachHtml = '<p class="proColor"><span data_key="' . $attrKey . '">' . $attrKey . '</span><##default##></p>' .
						'<ul class="selectAttribute lbUl '.$attrColor.'">';
			foreach ($attrValues as $val => $setting) 
			{
				$eachHtml .= '<li data-attr-value="' . $val . '"';
				$setting['default'] && $eachHtml .= 'class="selectActive"';
				$eachHtml .= '><i></i>';
				$eachHtml .= ($attrKey == 'color' ? '<img src="' . $TTHelper->getThumbnailUrl('product', $setting['value'], Yii::$app->params['productDetailSmallImgWidth'], Yii::$app->params['productDetailSmallImgHeight']) . '" />' : $setting['value']);
				$setting['default'] && $default = ':<b>' . $val . '</b>';
			}
			$eachHtml .= '</ul>';
			$eachHtml = str_replace('<##default##>', $default, $eachHtml);
			$attrHtml .= $eachHtml;
		}
		echo $attrHtml;
	}	
?>