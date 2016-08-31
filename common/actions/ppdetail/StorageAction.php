<?php
/*
* 详情页 仓库相关action
*
*/
namespace common\actions\ppdetail;

use Yii;
use yii\helpers\Json;
use common\components\AppAction;

class StorageAction extends AppAction
{
    

	/**
	* 运行action
	*
	* @param array $params
	* $params['whouse'] array 仓库列表
    * $params['listingId'] string 
	*
	* @return string
	*/
	public function run($params)
	{
        //获取默认仓库
        $defaultWhouse = $this->getDefaultWhouse($params['listingId'], $params['whouse']);
		return $this->renderPartial(
									'ppdetail/whouse',
									[
                                        'defaultWhouse' => $defaultWhouse,
                                        'storage' => $params['whouse'],
                                    ]
								);
	}

    /**
     * 获取默认仓库
     * 
     * @param string $listingId 商品ID
     * @param array $whouseLists 厂库列表
     * @return mixed array
     */
    public function getDefaultWhouse($listingId, $whouseLists)
    {
        //默认仓库的规则为 如果cookie中存在值则选用cookie的 否则选用当前SKU的第一个仓库
        $whouse = array_values(array_slice($whouseLists, 0, 1));
        $whouse = $whouse[0];
        $cookies = Yii::$container->get('TTHelper')->getCookie('TT_WAREHOUSE');
        if($cookies !== false)
        {
            $cookies = Json::decode($cookies);
            foreach ((array)$cookies as $each) 
            {
                if($each['listingId'] == $listingId)
                {
                    $whouse = $whouseLists[$each['depotName']];
                    break;
                }
            }
        }
        return $whouse;
    }
}