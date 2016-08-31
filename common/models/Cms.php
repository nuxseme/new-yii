<?php
/**
 * 分类model
 * @author caoxl
 */
namespace common\models;

use Yii;
use common\components\AppModel;
use common\components\AppCurl;
use yii\helpers\Json;

class Cms extends AppModel
{
	/**
    * @var int $_cacheTime 缓存时间
    */
    private $_cacheTime = 604800;
    
	/**
     * 获取首页底部文章列表
     * @return array
     */
    public function getFootArticle()
    {
    	$cacheKey = __CLASS__ . __METHOD__ . '_footArticle';
        $lists = Yii::$app->cache->get($cacheKey);
        if($lists === false)
        {
            $lists = [];
            $appCurl = new AppCurl;
            $re = $appCurl->get(array('api' => 'getFootArticle'));
            $re = $appCurl->convertResError($re);
            $lists = Json::decode($re);
            Yii::$app->cache->set($cacheKey, $lists, $this->_cacheTime, 'footArticle');
        }
        return $lists;
    }
    
    /**
     * 获取首页底部文章列表
     * @return array
     */
    public function getArticleDetails($url)
    {
    	$cacheKey = __CLASS__ . __METHOD__ . '_article_' . $url;
        $detail = Yii::$app->cache->get($cacheKey);
        if($detail === false)
        {
            $detail = [];
            $appCurl = new AppCurl;
            $re = $appCurl->get(['api' => 'getArticleDetails'], ['url' => $url]);
            $re = $appCurl->convertResError($re);
            $detail = Json::decode($re);
            Yii::$app->cache->set($cacheKey, $detail, $this->_cacheTime, 'articleDetails');
        }
        return $detail;
    }
}