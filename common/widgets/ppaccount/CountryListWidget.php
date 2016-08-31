<?php
/**
* @author hyd
* @date 2016-08-16 16:57:17
* @todo 品牌网站 用户资料  国家选择列表
*/

namespace common\widgets\ppaccount;
use common\components\AppWidget;

class CountryListWidget extends AppWidget{

  /**
    * @var array countries 国家
    */
    public $countries = [];
    public function run(){
        // 渲染视图
        return $this->render(
        	'ppaccount/countryList.php',
        	['countries' => $this->countries]
        	);
    }
}