<?php
namespace app\controllers;

use Yii;
use yii\helpers\Url;

/**
 * 默认控制器 首页入口
 */
class SiteController extends BaseController
{
	/**
	* 默认action
	*
	* @return array
	*/
	public function actions()
	{
		return [
			'error' => [
                'class' => 'common\actions\ErrorAction',
                'view' => 'error.php',
            ],
		];
	}
}