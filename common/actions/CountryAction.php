<?php
/*
* 获取国家相关操作的action
*
*/
namespace common\actions;

use Yii;
use common\components\AppAction;
use yii\web\Cookie;

class CountryAction extends AppAction{

	/**
     * 设置国家的动作
     * @param void
     * @return array 
     */
    public function run($lang)
    {
        $TTHelper = Yii::$container->get('TTHelper');
    	$reqCountry = Yii::$container->get('CountryModel')->getCountryByLanguage($lang)['data'];
        $country = $TTHelper->getCookie('country');
        $country === null && $country = '';
        $country = $country ? explode('|', $country) : array(0=>'', 1=>'');
        if($reqCountry != $tmp = $country[1]) 
        {
            $tmp = $reqCountry; 
            $TTHelper->setCookie('country', $reqCountry . '|US');
        }
        return array('country' => $tmp, 'countryCode' => 'US');
    }
}
