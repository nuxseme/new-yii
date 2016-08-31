<?php 
	$TTHelper = Yii::$container->get('TTHelper');
	if(!empty($productAttrs))
	{//列出该商品的所有属性
		$attrHtml = '';
		foreach($productAttrs as $attrKey => $attrValues)
		{
			$default = '';
			$attrColor = ($attrKey == 'color') ? 'select_color' : '';
			$eachHtml = '<p class="tt">' . $attrKey . ':<span data-key="' . $attrKey . '"><##default##></span></p>' .
						'<ul class="lineBlockBox '.$attrColor.' selectAttribute">';
			foreach ($attrValues as $val => $setting) 
			{
				$eachHtml .= '<li data-attr-value="' . $val . '"';
				$classStr = ' class="<##class##>" ';
				$classes = [];
				$setting['default'] && $classes[] = 'active';
				$setting['default'] && $default = $val;
				$attrKey == 'color' && $classes[] = $val;
				$classStr = str_replace('<##class##>', implode(' ', $classes), $classStr);
				$eachHtml .= $classStr;
				$eachHtml .= '>';
				$eachHtml .= '<span>' . $val . '</span>';
				$eachHtml .= '<i></i>';
			}
			$eachHtml .= '</ul>';
			$eachHtml = str_replace('<##default##>', $default, $eachHtml);
			$attrHtml .= $eachHtml;
		}
		echo $attrHtml;
	}	
?>
