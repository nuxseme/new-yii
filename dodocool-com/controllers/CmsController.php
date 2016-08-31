<?php
namespace app\controllers;

use Yii;

/**
 * 默认控制器 首页入口
 */
class CmsController extends BaseController
{
	private $_cmsModel;

	public function init()
	{
		$this->_cmsModel = Yii::createObject('common\models\Cms');
	}

	/**
     * 文章详情页
     *
     * @return mixed
     */
    public function actionDetails(){
    	$url = Yii::$app->request->get("url");
    	$articleDetails = array();
    	if(!empty($url))
    	{
	    	$articleDetails = $this->_cmsModel->getArticleDetails($url);
	    	$articleDetails = ($articleDetails['ret'] == 1) ? $articleDetails['data'] : [];

            //seo信息
            $this->seoMeta(
                [
                    'title' => $articleDetails[0]['title'],
                ]
            );

	    	return $this->render(
		    						'index',
		    						[
		    							'articleDetails'  =>  $articleDetails[0],
	        						]
        						);
    	}
    }
    
    /**
     * @desc 网站地图site map
     */
    public function actionSitemap()
    { 
    	$categories = $this->getCategories();
    	return $this->render(
    							'site_map',
    							['categories'  =>  $this->categories]
    						);
    }
}