<?php
/*
* 分类排序方式相关action
*
*/
namespace common\actions\cate;

use Yii;
use common\components\AppAction;

class SortCateAction extends AppAction
{
	/**
	* 运行action
	*
	* @param array $params
	*  $params['categoryId'] int 分类ID
	*
	* @return string
	*/
	public function run($params)
	{
		return $this->renderPartial(
									'cate/sortCate', 
									[
										'sort' => $param['sort'],
									]
								);
	}
}