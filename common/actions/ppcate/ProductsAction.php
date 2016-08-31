<?php
/**
* @author hyd
* @date 2016-08-13 18:39:49
* @todo 分类商品 展示区
*/

namespace common\actions\ppcate;

use Yii;
use common\components\AppAction;
use common\models\ProductList;
use yii\helpers\Url;

class ProductsAction extends AppAction
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
        $products = [];
        if(!empty(Yii::$app->request->get('cpath')))
        {
            $cpath = Yii::$app->request->get('cpath');
            $cid = $this->getCategoryIdByCpath($cpath);
            if(!$cid)
            {
                $this->controller->redirect(Url::home());
            }

            $pos = strrpos($cpath, "/");
            $start = ($pos === false ? 0 : ($pos + 1));
            $cname = strtolower(mb_substr($cpath, $start));
            $this->controller->redirect(['cate/index', 'cname' => $cname, 'cid' => $cid]);
        }
        else
        {
            $products = $this->getProductsList(Yii::$app->request->get('cid'));
        }
		return $this->renderPartial(
		 	'ppcate/products',
		 	[
		 		'products' => $products,
		 	]
		);
	}

    /**
    * 根据cpath获取分类ID
    *
    * @param string $cpath
    *
    * @return int $cid
    */
    public function getCategoryIdByCpath($cpath)
    {
        $category = Yii::$container->get('CateModel');
        $categories = $category->getCategories();
        if($categories['ret'] == 1)
        {
            $categories = $categories['data'];
            foreach($categories as $category)
            {
                if($category['cpath'] == $cpath)
                {
                    return $category['icategoryid'];
                }
                if(!empty($category['son']))
                {
                    foreach($category['son'] as $son)
                    {
                        if($son['cpath'] == $cpath)
                        {
                            return $son['icategoryid']; 
                        }
                    }
                }
            }
        }
        return 0;
    }

    /**
     * 根据子分类获取商品数据
     *
     * @return mixed array|boolean 
     */
    public function getProductsList($cid)
    {
        $productListModel = new ProductList;
        $subCategories = $this->getSubCategoryByCpath($cid);
        if(empty($subCategories))
        {
        	return [];
        }
        //根据子分类 查询对应的商品
        $products = array();
        foreach ($subCategories as $key => $value) 
        {
           $subCpath =  $value['cpath'];
           $productsTemp = $productListModel->getProductsByCateId(['cpath' => $subCpath])['data']['pblist'];
           if(!empty($productsTemp))
            {
                $products[$subCpath]['products']=$productsTemp;
                $products[$subCpath]['cname'] = $value['cname'];
            }
        }
        return $products;
    }

    /**
     * [getSubCategoryByCpath 根据cpath获取子分类]
     * @return [type] [description]
     */
    public function getSubCategoryByCpath($cid)
    {
        $category = Yii::$container->get('CateModel');
        $categories = $category->getCategories();
        if($categories['ret'] != 1)
        {
            return [];
        }
        $subCategories = array();

        //获取到所有分类
        foreach ($categories['data'] as $key => $value) 
        {
            if($value['icategoryid'] == $cid)
            {
                $subCategories = $value['son'];
            }
        }
        return $subCategories;
    }


}