<?php
/*
* 国家列表相关action
*
*/
namespace common\actions\common;

use Yii;
use common\components\AppAction;

class CountryListAction extends AppAction
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
		return $this->renderPartial(
									'common/countryList'
								);
	}
}