<?php
namespace app\controllers;

use Yii;

/**
 * 购物车控制器
 * 
 * @package app\controllers
 */
class ShippingController extends BaseController
{
    public function actions()
    {
        return [
            'ajaxshipping' => [
                'class' => 'common\actions\shipping\ListAction'
            ],
        ];
    }

	/**
	* 初始化
	*
	* @return void
	*/
	public function init()
	{
        parent::init();
	}
}