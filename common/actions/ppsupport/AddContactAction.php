<?php
/*
* contact相关action
*
*/
namespace common\actions\ppsupport;

use Yii;
use yii\helpers\Json;
use common\components\AppAction;
use common\models\Member;

class AddContactAction extends AppAction
{
	/**
	* 运行action
	*
	* @return string
	*/
	public function run()
	{
		$data = [];
		$data['iwebsiteid'] = Yii::$app->params['website'];
		$data['email'] = Yii::$app->request->post('email');
		$data['subject'] = Yii::$app->request->post('subject');
		$data['attachment'] = Yii::$app->request->post('attachment');
		$data['detail'] = Yii::$app->request->post('detail');

		$model = new Member;
        return $this->controller->resAjax($model->sendContactMsg($data));
	}
}