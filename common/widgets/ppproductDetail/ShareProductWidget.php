<?php

namespace common\widgets\ppproductDetail;

use common\components\AppWidget;
use yii\helpers\Url;

class ShareProductWidget extends AppWidget
{
   
    public function run()
    {
        return $this->render('ppproduct/shareProduct');
    }
}
