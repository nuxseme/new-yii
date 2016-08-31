<?php
use common\widgets\AdvertWidget;
echo AdvertWidget::widget(
				[
				  'langPkg'		  => $this->context->controller->langPkg,
			      'items'         => $banners,
			      'width'         => 950,
			      'height'        => 450,
				]
			);