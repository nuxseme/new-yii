<?php
/*
* 详情页 帮助信息相关action
*
*/
namespace common\actions\ppdetail;

use Yii;
use yii\helpers\Json;
use common\components\AppAction;

class FaqAction extends AppAction
{
    

	/**
	* 运行action
	*
	* @param array $params
	*
	* @return string
	*/
	public function run($params)
	{
		return '';//第一版 暂不放FAQ
        return $this->renderPartial(
            'ppdetail/faq.php'
        );
	}
}