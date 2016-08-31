<?php
/*
* 搜索页面顶部 面包屑
*/
namespace common\actions\ppsearch;
use Yii;
use common\components\AppAction;

class BreadCrumbsAction extends AppAction
{
	/**
	 * [run description]
	 * @param  [array] $params [关键词]
	 * @return [string]         [面包屑片段]
	 */
	public function run($params)
	{
		return $this->renderPartial(
					'ppsearch/breadCrumbs',
					[
						'keyword' => $params['keyword']
					]
				);
	}
}