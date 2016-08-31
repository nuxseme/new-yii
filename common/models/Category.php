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

class Category extends AppModel
{
	/**
     * 获取所有分类
     * @return array $categories
     */
	public function getCategories()
	{
		$cacheTime = 24 * 3600;
		$cacheKey = __CLASS__ . __METHOD__ . '_categories';
		$re = Yii::$app->cache->get($cacheKey);
		if($re === false)
		{
			$appCurl = new AppCurl;
            $re = $appCurl->get(['api' => 'getCategories']);
            $re = $appCurl->convertResError($re);
			$re = Json::decode($re);
            if($re['ret'] == 1)
            {
                $re['data'] = Yii::$container->get('TTHelper')->resolveCateTree($re['data'], 'icategoryid', 'iparentid');
				Yii::$app->cache->set($cacheKey, $re, $cacheTime, 'allCategories');
			}
		}
		return $re;
	}

	/**
     * 获取子分类
     * @param int $cateId
     * @return array $subCategories
     */
	public function getSubCategory($cateId)
	{
    	$allCategories = $this->getCategories();
        if($allCategories['ret'] != 1)
        {
            return ['ret' => $allCategories['ret'], 'data' => []];
        }
        $allCategories = $allCategories['data'];
    	$subCategories = array();
    	foreach($allCategories as $key => $value) 
    	{
    		if($value['icategoryid'] == $cateId)
    		{ 
    			$subCategories = $value;
    			return $subCategories;
    		}
    		else
    		{
    			foreach ($value['son'] as $j => $secondCategories)
    			{ 
    				if($secondCategories['icategoryid'] == $cateId)
    				{ 
    					$subCategories = $secondCategories;
                        break;
    				}
    			}
    		}
    	}
    	return ['ret' => 1, 'data' => $subCategories];
    }

    /**
     * 获取子分类
     * @param int $cateId
     * @return array 
     */
    public function getCategoryMateInfo($cateId)
    {
        $cacheTime = 24 * 3600;
        $cacheKey = __CLASS__ . __METHOD__ . '_mateinfo_' . $cateId;


        $re = Yii::$app->cache->get($cacheKey);

        if($re === false)
        {
            $appCurl = new AppCurl;
            $re =  $appCurl->get(
                                    ['api' => 'getCategoryMate', 'params' => ['cateId' => $cateId]],
                                    ['website' => Yii::$app->params['website'], 'client' => Yii::$app->params['client']]
                                );
            $re = $appCurl->convertResError($re);
            $re = Json::decode($re);
            Yii::$app->cache->set($cacheKey, $re, $cacheTime, 'cateMetaInfo');
        }

        return $re;
    }
}