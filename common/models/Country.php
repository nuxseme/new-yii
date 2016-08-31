<?php
/**
 * @desc 国家管理
 * @author caoxl
 */
namespace common\models;

use Yii;
use common\components\AppModel;
use common\components\AppCurl;
use yii\helpers\Json;

class Country extends AppModel{
    /**
    * @var int $_cacheTime 缓存时间
    */
    private $_cacheTime = 86400;

    /**
     * 获取国家列表 默认缓存一周
     * @return array $lists
     */
    public function getCountries()
    {
        $cacheKey = __CLASS__ . 'countryList';
        $lists = Yii::$app->cache->get($cacheKey);
        if($lists === false)
        {
            $lists = [];
            $appCurl = new AppCurl;
            $re = $appCurl->get(array('api' => 'getCountries'));
            $re = $appCurl->convertResError($re);
            $lists = Json::decode($re);
            if ($lists['ret'] == 1)
            {
                Yii::$app->cache->set($cacheKey, $lists, $this->_cacheTime, 'allCountries');
            }
        }
        return $lists;
    }

    /**
     * 获取国家列表 默认缓存一周(使用国家代码作为键名)
     * @return array $lists
     */
    public function getCountriesWithIndex()
    {
        $data = $this->getCountries();
        if($data['ret'] != 1)
        {
            return ['ret' => $data['ret'], 'data' => []];
        }
        $data = $data['data'];
        $list = array();
        foreach ((array)$data as $each) 
        {
            $list[$each['name']] = $each;
        }
        return ['ret' => 1, 'data' => $list];
    }

    
    /**
     * 根据语言获取国家
     * @param string $code
     */
    public static function getCountryByLanguage($code)
    {
        $data = isset(Yii::$app->params['langToCountry'][$code]) ? Yii::$app->params['langToCountry'][$code] : Yii::$app->params['defaultCountry'];
        return ['ret' => 1, 'data' => $data];
    }
}
