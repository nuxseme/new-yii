<?php
/*
* 详情页 赋值js变量相关action
*
*/
namespace common\actions\ppdetail;

use Yii;
use yii\helpers\Json;
use common\components\AppAction;

class JsvarsAction extends AppAction
{
    

	/**
	* 运行action
	*
	* @param array $params
	* [pdbList] [productInfo]
	*
	* @return string
	*/
	public function run($params)
	{
        return $this->renderPartial(
            'ppdetail/jsvars.php',
            [
            	'mainContent' => $this->addUsPrice($params['pdbList']),
            	'productInfo' => $params['productInfo'],
            ]
        );
	}

	/**
     * 在原价的基础上增加美元价格
     * 
     * @param    array $pdbList
     * @return array $pdbList
     */
    public function addUsPrice($pdbList)
    {
    	$TTHelper = Yii::$container->get('TTHelper');
        $currencyValue = $TTHelper->getCookie('TT_CURR');
        empty($currencyValue) && $currencyValue = 'USD';
        $currentRate = Yii::$container->get('CurrencyModel')->getRate($currencyValue);
        $currentRate = ($currentRate['ret'] == 1 ? $currentRate['data'] : null);
        empty($currentRate) && $currentRate = 1; //cookie为空时设置美元汇率
        foreach ($pdbList as $key => $value)
        {
            foreach ($value['whouse'] as $k => $v)
            {
                $pdbList[$key]['whouse'][$k]['us_nowprice'] = number_format($v['nowprice'] / $currentRate, 2 , '.', '');
                $pdbList[$key]['whouse'][$k]['us_origprice'] = number_format($v['origprice']/$currentRate, 2, '.' , '');
            }
        }
        return $pdbList;
    }
}