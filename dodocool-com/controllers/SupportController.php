<?php
/**
* @author caoxl
* @date 2016-08-16
* @todo support 控制器
*/

namespace app\controllers;

use Yii;
use common\models\Member;

class SupportController  extends BaseController
{
    /**
     * action别名
     * @return array
     */
    public function actions()
    {
        return [
            'addcontact' => [
                'class' => 'common\actions\ppsupport\AddContactAction',
            ],
            'ajaxdriver' => [
                'class' => 'common\actions\ppdetail\AjaxdriverAction',
            ],
        ];
    }

	/**
     * @desc 首页控制器
     * @return string
     */
    public function actionIndex()
    {
        $params = ['pageSize' => 100, 'pageNum' => 1];
        $model = Yii::$container->get('ProductModel');
        $re = $model->getDriverProducts($params);
        $products = [];
        if($re['ret'] == 1)
        {
            $products = $re['data'];
        }
    	return $this->render(
            'index',
            [
                'products' => $products
            ]
        );
    }

    /**
     * @desc 首页控制器
     * @return string
     */
    public function actionContactservice()
    {
        $model = new Member;
        $subjects = $model->getContactSubjects();
    	return $this->render(
            'contactService',
            [
                'subjects' => $subjects
            ]
        );
    }
}