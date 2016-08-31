<?php
/*
* 分类左侧筛选条件相关action
*
*/
namespace common\actions\cate;

use Yii;
use common\components\AppAction;

class LeftFilteringAction extends AppAction
{
	/**
	* 运行action
	*
	* @param array $params
	*  $params['aggsMap'] array 聚合信息   详见CateController中的结构
	*  $params['breadCrumbs'] array 面包屑导航 详见CateController中的结构
	*
	* @return string
	*/
	public function run($params)
	{
		return $this->renderPartial(
									'cate/leftFiltering', 
									[
										'breadCrumbs' => $params['breadCrumbs'],
										'aggsMap' => $params['aggsMap']
									]
								);
	}
}