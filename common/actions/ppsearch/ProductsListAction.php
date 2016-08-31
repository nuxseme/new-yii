<?php
/**
* @author hyd
* @date 2016-08-13 16:19:41
* @todo 搜索页面展示
*/

namespace common\actions\ppsearch;
use Yii;
use common\components\AppAction;

class ProductsListAction extends AppAction
{
	/**
	 * [run description]
	 * @param  [array] $params [关键词 商品数据]
	 * @return [string]         [展示区渲染片段]
	 */
	public function run($params)
	{
		return $this->renderPartial(
					'ppsearch/productsContainer',
					[
						'keyword' => $params['keyword'],
						'products' => $this->getResultByKeyword($params['keyword'])
					]
				);
	}

 	/**
 	 * [getResultByKeyword 根据关键词获取搜索结果]
 	 * @param  [string] $keyword [关键词]
 	 * @return [array]          [商品数据]
 	 */
    public function getResultByKeyword($keyword = '')
    {
        $re = Yii::$container->get('ProductModel')->getProductsByKeyword(['keyword' => $keyword]);
        return $re['ret'] == 1 ? $re['data']['pblist'] : [];
    }
}