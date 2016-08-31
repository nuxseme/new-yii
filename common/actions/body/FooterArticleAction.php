<?php
/*
* 脚部文章相关action
*
*/
namespace common\actions\body;

use Yii;
use common\components\AppAction;

class FooterArticleAction extends AppAction
{
	/**
	* 运行action
	*
	* @param array $params
	*
	* @return string
	*/
	public function run($params = [])
	{
		$cmsModel = Yii::createObject('common\models\Cms');
   		$articleList = $cmsModel->getFootArticle();
   		$articleList = $articleList['ret'] == 1 ? $articleList['data']: [];
		return $this->renderPartial(
									'//layouts/footerArticle', 
									[
										'articleList' => $articleList
									]
								);
	}
}