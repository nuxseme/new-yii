<?php
/**
 * 语言model类
 *
 * @author caoxl
 */
namespace common\models;

use Yii;
use common\components\AppModel;
use common\components\AppCurl;
use yii\helpers\Json;

class Lang  extends AppModel
{
	/**
    * @var int $_cacheTime 缓存时间
    */
    private $_cacheTime = 3600;


    /**
     * 获取站点语言包
	 *
     * @return array 
     */
    public function getLanguagePkg()
    {
        $TTHelper = Yii::$container->get('TTHelper');
    	$webSiteId = 10;

        $currencyKey = $TTHelper->getCookie('TT_CURR');
    	$currencyKey === null ? '_USD' : '_' . $currencyKey;

    	$langKey = $TTHelper->getCookie('PLAY_LANG');
    	$langKey === null ? '_en' : '_' . $langKey;

    	$cacheKey = __CLASS__ . __METHOD__ . $langKey . $currencyKey . '_' . $webSiteId;

    	$pkg = Yii::$app->cache->get($cacheKey);
    	if($pkg  === false)
    	{
    		$appCurl = new AppCurl;
            $re = $appCurl->get(
                                    array('api' => 'getLangPkg'), 
                                    ['website' => Yii::$app->params['website'], 'client' => Yii::$app->params['client']]
                                );
            $re = $appCurl->convertResError($re);
            $pkg = Json::decode($re);
    		Yii::$app->cache->set($cacheKey, $pkg, $this->_cacheTime, 'langPkg');
    	}
    	return $pkg;
    }

    /**
     * 获取请求中的语言
     *
     * @return array 
    */
    public function getReqLang()
    {
        //级别从高到低：$_GET['PLAY_LANG']->二级域名->已设cookie
        $webDefaultLang = Yii::$app->params['webDefaultLang'];
        $params = Yii::$app->request->getQueryParams();
        $reqLang = isset($params['lang']) ? $params['lang'] : '';
        if (!$reqLang)
        {
            $reqLang = explode('.', $_SERVER ['HTTP_HOST']);
            $reqLang = isset($reqLang[0]) ? $reqLang[0] : 'en';
            $reqLang = $reqLang == 'www' ? 'en' : $reqLang;
        } 
        $reqLang = in_array($reqLang, $webDefaultLang) ? $reqLang : 'en';
        return ['ret' => 1, 'data' => $reqLang];
    }

    /**
     * 获取语言列表
     *
     * @return mixed array|boolean 如果正常返回数组 否则返回false 
    */
    public function getLangList()
    {
        $cacheKey = __CLASS__ . __METHOD__ . '_langList';
        $data = Yii::$app->cache->get($cacheKey);
        if($data === false)
        {
            $appCurl = new AppCurl;
            $re = $appCurl->get(array('api' => 'getLangList'));
            $re = $appCurl->convertResError($re);
            $data = Json::decode($re);
            if ($data['ret'] == 1)
            {
                Yii::$app->cache->set($cacheKey, $data, $this->_cacheTime, 'langList');
            }
        }
        
        return $data;
    }
}