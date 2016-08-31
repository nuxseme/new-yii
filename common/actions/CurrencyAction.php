<?php
/*
* 获取和设置货币相关操作的action
*
*/
namespace common\actions;

use Yii;
use common\components\AppAction;

class CurrencyAction extends AppAction{

	/**
     * 获取和设置货币的动作
     * @param void
     * @return array 
     */
    public function run()
    {
    }

    /**
     * 设置货币符号
     * @param string $currency
     * @return array  $symbolCode
     */
    public function setSymbolCode($currency)
    {
        //设置货币符号
        $symbolCode = array();
        if($currency)
        { 
            $list = Yii::$container->get('CurrencyModel')->getCurrencies()['data'];
            foreach($list as $key => $value)
            { 
                if($value['code'] == $currency)
                {
                    $symbolCode = $value['symbolCode'];
                    break;
                }
            }
        }

        return $symbolCode;
    }

    /**
     * 设置货币
     * @param string $lang 语言
     * @return string  $currency
     */
    public function setCurrency($lang)
    {
        $TTHelper = Yii::$container->get('TTHelper');

        //设置当前货币(优先级从高到低：地址栏传参 -> cookie即当前货币 -> 根据国家识别)
        $cookieCurrency = $TTHelper->getCookie('TT_CURR');
        $cookieCurrency === null && $cookieCurrency = '';
        $enCurrency = Yii::$app->params['currency'];
        $localCurrency = Yii::$app->params['localCurrency'];
        $getCurrency = Yii::$app->request->getQueryParams();
        $getCurrency = isset($getCurrency['currency']) ? $getCurrency['currency'] : '';
        $getCurrency = in_array($getCurrency, $localCurrency) ? $getCurrency : '';
        $currency = $enCurrency[$lang];

        if($getCurrency) 
        {
           $currency = $getCurrency;
        }
        elseif($cookieCurrency) 
        {
           $currency = $cookieCurrency;
        }

        if($currency != $cookieCurrency) 
        {
            $TTHelper->setCookie('TT_CURR', $currency);
        }

        return $currency;
    }
}
