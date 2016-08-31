<?php
/*
* 详情页(ajax) 驱动相关action
*
*/
namespace common\actions\ppdetail;

use Yii;
use yii\helpers\Json;
use common\components\AppAction;

class AjaxdriverAction extends AppAction
{
	/**
	* 运行action
	*
	* @param array $params
    * $params['sku'] string 
	*
	* @return string
	*/
	public function run()
	{
        $sku = Yii::$app->request->get('sku');
        return $this->renderPartial(
            'ppdetail/ajaxDriverList',
            [
                'drivers' => $re['drivers'],
            ]
        );
	}

    /**
     * [getDriver 根据商品sku获取驱动文档]
     * @param  [type] $sku [商品]
     * @return mixed
     */
    public function getDriversAndManuals($sku)
    {
        $params = [
            'sku' => $sku,//商品sku
            'iwebsiteid' => Yii::$app->params['website'],//站点id
        ];
        $re = Yii::$container->get('ProductModel')->getProductDriverAndAmazonUrl($params);

        $data = ['drivers' => [], 'platforms' => []];

        if($re['ret'] == 1)
        {
            $_temp = [];
            $driversAndManuals = $re['data']['brandDowns'];//驱动和手册
            foreach((array)$driversAndManuals as $each)
            {
                $categoryName = trim($each['categoryName']);
                !array_key_exists($categoryName, $_temp) && $_temp[$each['categoryName']] = [];
                $_temp[$each['categoryName']][] = $each;
            }
            $data['drivers'] = $_temp;
            $data['platforms'] = $re['data']['thirdPlatforms'];
        }
        return $data;
    }
}