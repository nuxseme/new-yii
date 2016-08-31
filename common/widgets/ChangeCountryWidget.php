<?php
namespace common\widgets;

use Yii;
use common\components\AppWidget;

/**
 * 切换国家小部件
 * @author caoxl
 */
class ChangeCountryWidget extends AppWidget
{ 
    /**
    * @var array countries 国家
    */
    public $countries = [];

    public function init()
    {
        parent::init();
    }
    
    public function run()
    {
        return $this->render(
                    'country/changeCountry',
                    [
                        'countries' => $this->countries
                    ]
                );
    }
}