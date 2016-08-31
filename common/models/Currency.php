<?php
/**
 * @desc 货币汇率model
 * @author caoxl
 */
namespace common\models;

use Yii;
use common\components\AppModel;
use common\components\AppCurl;
use yii\helpers\Json;

class Currency extends AppModel{
    /**
    * @var int $_cacheTime 缓存时间
    */
    private $_cacheTime = 86400;

    /**
     * 根据国家获取货币
     * @param string $code 国家代码
     * @return array
     */
    public function getCountryCurrency($code)
    {
        $currentcy = 'USD';
        $countries = Yii::$container->get('CountryModel')->getCountriesWithIndex();
        isset($currencies[$code]) && $currentcy = $currencies[$code];
        return ['ret' => 1, 'data' => $currentcy];
    }

    /**
     * 获取货币列表
     * @return array
     */
    public function getCurrencies()
    {
        $cacheKey = __CLASS__ . 'currencies';
        $lists = Yii::$app->cache->get($cacheKey);
        if($lists === false)
        {
            $lists = [];
            $appCurl = new AppCurl;
            $re = $appCurl->get(array('api' => 'getCurrencies'));
            $re = $appCurl->convertResError($re);
            $lists = Json::decode($re);
            if ($lists['ret'] == 1)
            {
                Yii::$app->cache->set($cacheKey, $lists, $this->_cacheTime, 'allCurrencies');
            }
        }
        return $lists;
    }


    /**
     * 获取货币的汇率(以货币代码为键名)
     * @return array $list
     */
    public function getCurrenciesWithIndex()
    {
        $data = $this->getCurrencies();
        if($data['ret'] != 1)
        {
            return ['ret' => $data['ret'], 'data' => []];
        }
        $lists = array();
        foreach ((array)$data['data'] as $each) 
        {
            $lists[$each['code']] = $each;
        }
        return ['ret' => 1, 'data' => $lists];
    }

    /**
     * 获取货币的汇率
     * @param string $code 货币代码
     * @return array
     */
    public function getRate($code)
    {
        $rate = false;
        $code = trim($code);
        $currencies = $this->getCurrenciesWithIndex()['data'];
        isset($currencies[$code]) && $rate = $currencies[$code]['currentRate'];
        return ['ret' => 1, 'data' => $rate];
    }
}
