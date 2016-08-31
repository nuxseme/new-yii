<?php
/**
 * 产品列表 模型
 * @author caoxl
 */
namespace common\models;

use Yii;
use yii\helpers\Json;
use common\components\AppModel;
use common\components\AppCurl;

class ProductList extends AppModel
{
	/**
	* 根据分类ID获取产品列表
	*
	* @param array $pageParam
	* $pageParam['cpath']
	* $pageParam['page']
	* $pageParam['size']
	* $pageParam['sort']
	* $pageParam['tagName']
	* $pageParam['depotName']
	* $pageParam['yjPrice']
	* $pageParam['brand']
	* $pageParam['type']
	* 
	* @return array
	*/
	public function getProductsByCateId($pageParam)
	{
		$cacheTime = 1800;
		$cacheKey = __CLASS__ . __METHOD__ . md5('_products_' . Json::encode($pageParam));

		$re = Yii::$app->cache->get($cacheKey);

		if($re === false)
		{
			$appCurl = new AppCurl;
			$re = $appCurl->get(
	    							['api' => 'getProducts'], 
	    							[
	    								'cpath' => isset($pageParam['cpath']) ? $pageParam['cpath'] : null,
	    								'page' => isset($pageParam['page']) ? $pageParam['page'] : null,
	    								'size' => isset($pageParam['size']) ? $pageParam['size'] : null,
	    								'sort' => isset($pageParam['sort']) ? $pageParam['sort'] : null,
	    								'tagName' => isset($pageParam['tagName']) ? $pageParam['tagName'] : null,
	    								'depotName' => isset($pageParam['depotname']) ? $pageParam['depotname'] : null,
	    								'yjPrice' => isset($pageParam['yjPrice']) ? $pageParam['yjPrice'] : null,
	    								'brand' => isset($pageParam['brand']) ? $pageParam['brand'] : null,
	    								'type' => isset($pageParam['type']) ? $pageParam['type'] : null,
	    								'startPrice' => isset($pageParam['startPrice']) ? $pageParam['startPrice'] : null,
	    								'endPrice' => isset($pageParam['endPrice']) ? $pageParam['endPrice'] : null,
	    							]
	    						);
			$re = $appCurl->convertResError($re);
			$re = Json::decode($re);
			if($re['ret'] == 1 && isset($re['categoryId']))
			{
				$re['data']['categoryId'] = $re['categoryId'];
				unset($re['categoryId']);
				Yii::$app->cache->set($cacheKey, $re, $cacheTime, 'cateProducts');
			}

		}

		return $re;
    }
}