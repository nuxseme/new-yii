<?php
namespace app\controllers;

use common\helpers\TTHelper;
use Yii;
use common\models\Cart;
use yii\helpers\Json;

/**
 * 购物车控制器
 * 
 * @package app\controllers
 */
class CartController extends BaseController
{
	/**
	* @var TTHelper $TTHelper
	*/
	protected $TTHelper;

	/**
	* @var Cart $_cartModel
	*/
	private $_cartModel;

	/**
	* 初始化
	*
	* @return void
	*/
	public function init()
	{
        parent::init();
		$this->TTHelper = Yii::$container->get('TTHelper');
		$this->_cartModel = new Cart;
	}

	/**
     * 根据所选属性生成购物车cookies
     * 
     * @return string json
     */
    public function actionAjaxaddtocart()
    { 
    	$addCartListingId    = $this->getListingIdByAttr();
    	$addCartWarehouseId  = $this->getWarehouseIdByAttr();
    	$addCartProductQly   = $this->getQltByAttr();
    	$addCartHashcode     = $this->getHashcode($addCartListingId);
    	$shoppingCartHistory = $this->getCartCookie();
    	$result = false;
    	if(empty($shoppingCartHistory))
    	{ //购物车没有商品，直接添加
    		$result = $this->singleProductAdd(
    											$addCartWarehouseId, 
    											$addCartHashcode,
    											$addCartProductQly,
    											$addCartListingId
    										);
    		if($result)
    		{
    			return $this->resAjax(['ret' => 1, 'data' => '', 'msg' => 'Add to cart successful']); 
    		}
    		else
    		{
    			return $this->resAjax(['ret' => 1, 'data' => '', 'msg' => 'Add to cart failure']);
    		}
    	}
    	else
    	{ //购物车有商品，根据仓库ID,HashCode修改或增加对应的值

			$oldShippingCartArray = $shoppingCartHistory;
			$oldQty = (int)$oldShippingCartArray[$addCartWarehouseId][$addCartHashcode][0]['qty'];
			$oldShippingCartArray[$addCartWarehouseId][$addCartHashcode][0]['qty'] = intval($oldQty) + intval($addCartProductQly);
			$oldShippingCartArray[$addCartWarehouseId][$addCartHashcode][0]['listing'] = $addCartListingId;
			$result = $this->addPlist($oldShippingCartArray);
			if($result)
			{ 
				return $this->resAjax(['ret' => 1, 'data' => '', 'msg' => 'Add to cart successful']); 
    		}
    		else
    		{
    			return $this->resAjax(['ret' => 1, 'data' => '', 'msg' => 'Add to cart failure']);
    		}
		}
    }

	/**
     * 异步获取购物车信息（头部）
     * 
     * @return string $listingId
     */
	public function actionAjaxshowcart()
	{
		$plistArray = $this->getCartCookie();
		$shippingCartInfo = array();
		if (!empty($plistArray)) {
			$newPlist = array();
			foreach ($plistArray as $key => $value) {
				if (empty($value)) {
					return $this->resAjax(['status' => 0, 'data' => ['count' => 0]]);
				}
				$i = 0;
				foreach ($value as $k => $v) {
					$newPlist[$key][$i] = $v;
					$newPlist[$key][$i][0]['depotId'] = $key;
					$i++;
				}
			}
			$finalPlist = array();
			foreach ($newPlist as $key => $value) {
				foreach ($value as $k => $v) {
					$finalPlist[] = $v;
				}
			}
			$plistJson = str_replace('listing', 'listingId', str_replace('qty', 'num', str_replace('}]', '}', str_replace('[{', '{', Json::encode($finalPlist)))));
			$shippingCartInfo = $this->_cartModel->getShoppingCartInfo($plistJson);
			$shippingCartInfo = $shippingCartInfo['ret'] == 1 ? $shippingCartInfo['data'] : [];
		}

		if ($shippingCartInfo) {
			$cartInfo = array();

			foreach ($shippingCartInfo as $key => $value)
			{
				$code = TTHelper::warehouseIdCode($key);
				$cartInfo[$code] = $value;
				foreach ($value as $k=> $item)
				{
					$cartInfo[$code][$k]['imageUrl'] = $this->TTHelper->getThumbnailUrl('product', $item['imageUrl'], Yii::$app->params['cartImgWidth'], Yii::$app->params['cartImgHeight']);
				}
				
			}

			return $this->resAjax(['ret' => 1, 'data'=>['count' => count($shippingCartInfo), 'result' => $cartInfo]]);
		} else {
			return $this->resAjax(['ret' => 0, 'data' => ['count' => 0]]);
		}
	}
    
	/**
     * 购物车产品删除
     * 
     * @return string $listingId
     */
    public function actionAjaxdeletecart()
    { 
    	$request = Yii::$app->request;
    	$listingId = $request->get("listing_id");
    	if(empty($listingId))
    	{ 
    		return $this->resAjax(['ret' => 0, 'msg' => 'listingId is empty']);
    	}
    	$shippingCartInfo = $this->getCartCookie();
    	$deleteResult = false;
    	foreach ($shippingCartInfo as $key => $value)
    	{
    		foreach ($value as $k => $v)
    		{
    			if($v[0]['listing'] == $listingId)
    			{ 
    				unset($shippingCartInfo[$key][$k]);
    				$deleteResult = true;
    			}
    		}
    	}
    	if($deleteResult)
    	{ 
    		$newCartInfo = array_filter($shippingCartInfo);
			if(count($newCartInfo) == 0)
			{ //购物车为空彻底删除cookies
				$this->TTHelper->unSetcookie(Yii::$app->params['cartCookiesName']);
			}
			else
			{ 
				$this->addPlist($newCartInfo);
			}
			return $this->resAjax(['ret' => 1, 'msg' => 'Delete Successful']);
    	}
    	else
    	{
    		return $this->resAjax(['ret' => 0, 'msg' => 'Delete Failure']);
    	}
    }

	/**
     * 统计购物车个数
     * 
     * @return string json
     */
   	public function actionAjaxcartnum()
   	{ 
   		$shippingArray = $this->getCartCookie();
   		if($shippingArray)
   		{ 
   			$plist = array();
	   		foreach ($shippingArray as $key => $value)
	   		{
	   			$plist[] = $value;
	   		}
	   		if($plist)
	   		{
	   			return $this->resAjax(['ret' => 1, 'data' => ['cartNumber' => count($plist[0])]]);
	   		}
	   		else
	   		{ 
	   			return $this->resAjax(['ret' => 0]); 
	   		}
   		}
   		else
   		{
   			return $this->resAjax(['ret' => 0]);  
   		}
   	}

   	/**
     * 获取cart的cookie
     * 
     * @return array
     */
   	protected function getCartCookie()
   	{
   		return Json::decode($this->TTHelper->getCookie(Yii::$app->params['cartCookiesName']));
   	}


	/**
     * 根据所选择的产品属性提取ListingId
     * 
     * @return string $listingId
     */
    protected function getListingIdByAttr(){
    	$productAttr = Yii::$app->request->post();
    	$listingId = $productAttr['listingId'];
    	unset($productAttr['TT_warehouse']);
    	unset($productAttr['quantity']);
    	unset($productAttr['listingId']);
    	//收集用户提交产品属性
    	if(count($productAttr) > 0)
    	{
    		$selectAttr = array();
	    	foreach ($productAttr as $key => $value)
	    	{ 
	    		$selectAttr[$key] = trim($value);
	    	}
    	}
    	$filterAttr = array_filter($selectAttr);
    	
    	//匹配产品自身属性
	    $product = Yii::$container->get('ProductModel')->getProductDetails($listingId)['data'];
	   	$productInfo = $product['pdbList'];
    	foreach ($productInfo as $key => $value)
    	{ 
    		if($value['attributeMap'] != null)
    		{ 
    			$dataAttr = array();
    			foreach ($value['attributeMap'] as $k => $attr)
    			{
    				$dataAttr[$k] = trim($attr);
    			}
    			//属性匹配找出listingID
    			if($dataAttr == $filterAttr)
    			{ 
					$listingId = $value['listingId'];
					return $listingId;
				}
    		}
    	}
    	
    	return $listingId;
    }

	/**
     * 根据所选择的产品尺寸
     * 
     * @return string $warehouse
     */
	protected function getWarehouseIdByAttr()
	{
		$warehouse = Yii::$app->request->post('TT_warehouse');
		return $warehouse;
	}

	/**
     * 根据所选择的产品购买数量
     * 
     * @return int $quantity
     */
	protected function getQltByAttr()
	{
		$quantity = Yii::$app->request->post('quantity');
		return $quantity;
	}

	/**
     * 根据listingID生成Hash Code
     * 
     * @return int $quantity
     */
    protected function getHashcode($listingId)
    {
    	$re = Yii::$container->get('ProductModel')->getHashCodeByListingId($listingId);
    	return $re['ret'] == 1 ? $re['data'] : [];
    }

	/**
     * 单个产品添加购物车
     * 
     * @return int $quantity
     */
    protected function singleProductAdd($warehouseId, $hashCode, $qly, $listingId)
    {
    	//指定格式生成购物车信息，不可随便更改
    	$productInfo = [
    						$warehouseId => [
    											$hashCode => [
    															[
    																'qty' => intval($qly),
    																'listing' => $listingId
    															]
    														]
    										]
    					];
    	$plist = Json::encode($productInfo);
    	$result = $this->TTHelper->setCookie(Yii::$app->params['cartCookiesName'], $plist);
    	return true;
    }

	/**
     * 单个产品添加购物车
     * 
     * @return int $quantity
     */
    protected function addPlist($shippingCartArray)
    {
    	$plist = Json::encode($shippingCartArray);
    	$this->TTHelper->setCookie(Yii::$app->params['cartCookiesName'], $plist);
	}
}