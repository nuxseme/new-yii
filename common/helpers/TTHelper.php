<?php
/**
 * TOMTOP公用helper类
 */
namespace common\helpers;

use Yii;
use common\components\AppHelper;
use yii\web\Cookie;
use yii\helpers\Url;
use yii\helpers\Json;

/**
* 公用helper类
* @author caoxl
*/
class TTHelper extends AppHelper
{
	/**
	* @var array $langPkg 语言包
	*/
	public static $langPkg;

	/**
	* 设置cookie
	* @param string $name cookie的名称
	* @param string $value cookie的值
	* @param int $expire 过期时间 单位s
	* @param string $domain 域名默认 Yii::$app->params['cookieDomain']
	* @param string $path cookie路径 默认'/'
	* @return boolean $secure 安全性
	* @return boolean $httpOnly 是否http可读
	* @return void
	*/
	public static function setCookie($name, $value, $expire = 0, $domain = '', $path = '/', $secure = false, $httpOnly = false)
	{
		!$expire && $expire = Yii::$app->params['cookExpire'];
		!$domain && $domain = Yii::$app->params['cookDomain'];
		!$path && $path = Yii::$app->params['cookPath'];
		$expire += time();

		$cookies = Yii::$app->response->cookies;
		$cookies->add(new Cookie([
										'name' => $name,
										'value' => $value,
										'expire' =>$expire,
										'domain' => $domain,
										'path' => $path,
										'secure' => $secure,
										'httpOnly' => $httpOnly
								])
					);
	}

	/**
	* 获取cookie
	* @param string $name cookie的名称
	* @param string $defaultValue cookie的默认值 默认为null
	* @return mixed  string|null 如果有返回值 否则返回null
	*/
	public static function getCookie($name, $defaultValue = null)
	{
		$cookies = [Yii::$app->request->cookies, Yii::$app->response->cookies];
		$cookie = null;
		for($i = 0, $_len = sizeof($cookies); $i < $_len; $i++)
		{
			$obj = $cookies[$i];
			$cookie = $obj->getValue($name, null);
			if($cookie !== null)
			{
				break;
			}
		}
		$defaultValue !== null && $cookie === null && $cookie = $defaultValue;
		return $cookie;
	}

	/**
	* 显示中国仓freeshiping
	* @param array $wearHostList
	*
	* @return boolean
	*/
    public static function freeShipingDisplay($wearHostList)
    { 
    	$freeshiping = false;
    	$i = 1;
    	foreach ($wearHostList as $key => $value){
    		if($value['freeShipping'] == true && $i == 1)
    		{
    			$freeshiping = true;
    			break;
    		}
    		$i++;
    	}
    	return $freeshiping;
    }

	/**
	* 删除cookie
	* @param string $name cookie的名称
	* @param string $domain 
	* @return mixed void
	*/
	public static function unsetCookie($name, $domain = '')
	{
		$domain == '' && $domain = Yii::$app->params['cookDomain'];
		$cookies = Yii::$app->response->cookies;
		$cookie = new Cookie(['name' => $name, 'domain' => $domain]);
		$cookies->remove($cookie);
	}

	/**
	* cookie 是否存在
	* @param string $name cookie的名称
	* @return boolean
	*/
	public static function hasCookie($name)
	{
		$has = false;
		$cookies = [Yii::$app->request->cookies, Yii::$app->response->cookies];
		for($i = 0, $_len = sizeof($cookies); $i < $_len; $i++)
		{
			$obj = $cookies[$i];
			if($obj->has($name))
			{
				$has = true;
				break;
			}
		}
		return $has;
	}

	/**
     * 获取静态资源文件前缀
     *
     * @return string
     */
	public static function staticPrefix()
	{
		return Yii::$app->params['staticRoute'];
	}

	/**
     * 获取语言包
     *
     * @return array
     */
	public static function getLangPkg()
	{
		if(self::$langPkg === null)
		{
			$res = Yii::$container->get('LangModel')->getLanguagePkg();
			$res = $res['ret'] == 1 ? $res['data'] : [];
			self::$langPkg = $res;
		}
		return self::$langPkg;
	}

	/**
	 * 获取站点语言
	 *
	 * @param mixed string|array $key  可以是字符串或者数组  
	 *		  如果是字符串则代表语言键名的后缀 
	 *		  如果是数组 第一个元素代表语言后缀  第二个元素代表默认值
	 * @param string $sitePrefix 站点前缀 默认Yii::$app->params['langPrefix']
	 * @return mixed string|null 如果语言存在返回语言 否则返回null
	 */
	public static function getSiteLang($key, $sitePrefix = '')
	{
		!$sitePrefix && $sitePrefix = Yii::$app->params['langPrefix'];//站点前缀
		$langSuffix = is_array($key) ? $key[0] : $key;
		$langKey = $sitePrefix . '.' . $langSuffix;//语言键名
		$translateCate = Yii::$app->params['i18nDefaultCategory'];//默认翻译类型
		if(($word = Yii::t($translateCate, $langKey)) != $langKey)
		{//如果翻译结果和语言key不同 则证明本地存在翻译 使用本地翻译
			return $word;
		}

		$langPkg = self::getLangPkg();
		$word = array_key_exists($langKey, $langPkg) ? $langPkg[$langKey] : null;
		if(is_array($key) && isset($key[1]) && $word === null)
		{
			$word = $key[1];
		}
		return $word;
	}

	/**
	 * 获取当前汇率
	 *
	 * @return string
	 */
	public static function getCurrentCurrency()
	{
		$currentCurrency = 'USD';
		if(self::getCookie(Yii::$app->params['coun']) !== null)
		{
			$currentCurrency = self::getCookie(Yii::$app->params['coun']);
		}
		return $currentCurrency;
	}

	/**
	 * 获取当前汇率下的价格
	 *
	 * @param double $price
	 * @return double
	 */
	public static function getCurrentRatePrice($price)
	{
		$currentRate = Yii::$container->get('CurrencyModel')->getRate(self::getCurrentCurrency());
		$currentRate = $currentRate['ret'] == 1 ? $currentRate['data'] : 1;//cookie为空时设置美元汇率
		return number_format($price / $currentRate, 2, '.', '');
	}

	/**
	 * 通过仓库代码获取对应国家
	 *
	 * @param string $code
	 * @return string
	 */
	public static function  getCountryByCode($code)
	{
		$code = trim($code);
		$country = '';
		array_key_exists($code, Yii::$app->params['warehouseCodeToCountry']) && $country = Yii::$app->params['warehouseCodeToCountry'][$code];
		return $country;
	}

	/**
	 * 获取所有父级分类
	 *
	 * @param string $cpath
	 * @return mixed array|false
	 */
    public static function findParentCategories($cpath)
    { 
        $re = Yii::$container->get('CateModel')->getCategories();
        if($re['ret' == 1])
        {
            $categoryTree = $re['data'];
            $category = array();
            foreach ($categoryTree as $key => $cate)
            { 
            	if($cate['cpath'] == $cpath)
            	{ 
            		$category = $cate;
            		break;
            	}
            }
            return $category;
        }
        return false;
    }

	/**
     * @desc 解析生成分类树
     * @param array $items
     * @param string $idKey
     * @param string $pidKey
     * @return array
     */
	public static function resolveCateTree($items, $idKey, $pidKey)
	{
		$tree = $newItems = $newTree = array();
        foreach($items as $row)
        {
            $newItems[$row[$idKey]] = $row;
        }
        foreach($newItems as $item)
        {
            if(array_key_exists($pidKey, $item) && $item[$pidKey] && array_key_exists($item[$pidKey], $newItems))
            {
                $newItems[$item[$pidKey]]['son'][] = &$newItems[$item[$idKey]];
            }
            else
            {
                $tree[] = &$newItems[$item[$idKey]];
            }
        }
        foreach($tree as $item)
        {
            if(isset($item['son']))
            {
                $newTree[] = $item;
            }
        }
        return $newTree;
	}

	/**
	 * 根据国家id获取国家名称
	 * @param $id 国家id
	 * @param $countryLists  array 国家列表
	 * @return string
	 */
	public static function getCountryNameByCode($id, $countryLists = [])
	{
		if (!empty($countryLists)) 
		{
			foreach ($countryLists as $key => $value) 
			{
				if ($value['id'] == $id) 
				{
					return $value['name'];
				}
			}
		}

		return '';
	} 

	/**
     * url构造函数
     * 
     * @param   string $url        相对路径
	 * @param   string $domain     是否带绝对路径
     * @return array
     */
	public static function TomtomHrefLink($url, $domain = true)
	{  
		if(!$domain)
		{
			return $url . self::affiliateUrl($url);;
		}
		$link = '/' . $url;
		
		//登陆的用户是联盟的用户url的后缀要加上aid
		$link = $link . self::affiliateUrl($link);
		
		return $link;
	}

	/**
     * 联盟用户登录所有的URL后缀需要加上aid
     * 
     * @param   string $url 原始URL
     * @return  string 
     */
	public static function affiliateUrl($url)
	{  
		$affiliate = self::getCookie('TT_AFFILIATE');
		$affiliateUrl = '';
		if(!empty($affiliate))
		{ 
			$aid = 'aid=' . $affiliate;
			//判断连接符
			$affiliateUrl = (strstr($url, '?')) ? '&' . $aid : '?' . $aid;
		}
		return $affiliateUrl;
	}

	/**
     * 伪静态网址URL
     * 
     * @param   string $url 原始URL
     * @param   string $page 所属页面
     * 
     * @return  string 
     */
	public static function urlRewrite($url, $page)
	{
		$link = ''; 
		switch($page)
		{
			case 'product':
				$link = '/' . $url . '.html'; 
				break;
			case 'category':
				$link = '/' . $url;
				break;
			case 'search':
				$link = '/product?q=' . $url;
				break;
		}
		
		//登陆的用户是联盟的用户url的后缀要加上aid
		$link = $link . self::affiliateUrl($link);
		
		return $link;
	}

	/**
     * 生成图片缩略图
     * 
     * @param   $type     图片类型
	 * @param   $imgUrl   图片地址
	 * @param   $width    图片宽度
	 * @param   $height   图片高度
	 * @param   $original 是否原图显示，默认为false
     * 
     * @return  string 
    */
    public static function getThumbnailUrl($type, $imgUrl, $width, $height, $original = false)
    { 
    	//定义允许缩略图类型
		$allowThumbnailType = array('product');
    	if(!in_array($type,$allowThumbnailType))
    	{
    		return false;
    	}
    	if($type == 'product')
    	{ 
    		if($original)
    		{
    			$thumbnailUrl = Yii::$app->params['imagesCdnUrl'] . '/' . $type . '/' . 'original' . $imgUrl;
    		}
    		$clip = '/';//是否有裁剪
    		if(isset(Yii::$app->params['imagesHasClip']) && Yii::$app->params['imagesHasClip'] === true)
    		{
    			$clip = '/clip/';
    		}
    		$thumbnailUrl = Yii::$app->params['imagesCdnUrl'] . '/' . $type . '/' . 'xy/' . $width . '/' . $height . $clip . $imgUrl;
    	}
    	return $thumbnailUrl;
    }

    /**
     * 展示日期格式
     * @param   $str	时间戳 
     *
     * @return str      日期
    */
    public static function dateFormat($str)
    {
    	return $str ? date("m/j/Y g:i A", $str) : '';
    }

    /**
     * 网站价格显示函数
     * 
     * @param   $origprice	原价
	 * @param   $nowprice	现价
	 * @param   $symbol	    货币
	 * @param   $param	    预留参数
     * 
     * @return  string 
    */
    public static function productPriceDisplay($origprice, $nowprice, $symbol, $param = array())
    { 
		$currencyValue = self::getCookie('TT_CURR');
		if(empty($currencyValue))
		{
			$currencyValue = 'USD'; 
		}
		$currentRate = Yii::$container->get('CurrencyModel')->getRate($currencyValue)['data'];
		if(empty($currentRate))
		{
			$currentRate = 1; //cookie为空时设置美元汇率
		}
		$priceHtml = '';
		if(empty($param))
		{
			$priceHtml .= '<span class="productPrice pricelab" usvalue="' . number_format($nowprice / $currentRate, 2, '.', '') . '">' . $symbol . $nowprice . '</span>';
			if($origprice > $nowprice)
			{
				$priceHtml .= '<span class="productCost pricelab" usvalue="' . number_format($origprice / $currentRate, 2, '.', '') . '">' . $symbol . $origprice . '</span>';
			}
		}
		
		if(!empty($param['module']) && $param['module'] == 'recent_orders')
		{
			$priceHtml .= '<p class="scrollPrice pricelab" usvalue="' . number_format($nowprice / $currentRate, 2, '.', '') . '">' . $symbol . $nowprice . '</p>';
		}
		
		return $priceHtml;
	}

	/**
	 * 写调试日志
	 *
	*/
	public static function write($msg, $file = false)
	{
		$dir = '/tmp/';
		$file || $file = '/test.txt';
		$file = $dir . $file;
		if (file_exists($file) && 1) 
		{
			file_put_contents($file, date('Y-m-d H:i:s') . ' -- ' . $msg . "\n", FILE_APPEND);
		}
	}

	/**
     * 浏览记录
     * 
     * @return  mixed  array|boolean
    */
	public static function getViewHistory()
	{ 
   		$cookies = self::getCookie('WEB-history');
    	if(is_string($cookies) && strlen($cookies) > 0)
    	{ 
    		$listingIds = $cookies;
    		$result = Yii::$container->get('ProductModel')->getViewHistory($listingIds)['data'];
   			return $result;
    	}
   		return false;
   	}
   	
	/**
     * 你可能喜欢的产品推荐
     * 
     * @return  array
    */
   	public static function getYouMightLike()
   	{ 
   		$cookies = self::getCookie('WEB-history');
    	$historyArray = explode(',',$cookies);
    	if(count($historyArray) > 0)
    	{ 
    		$listingId = $historyArray[0];
    		$result = Yii::$container->get('ProductModel')->getYouMayLike($listingId);
    		if($result['ret'] == 1)
    		{
    			return $result['data'];
    		}
    	}
   		return false;
   	}

	/**
     * dailyDeals倒计时
     * 
     * @param string $date
     * @return  array
    */
	public static function dailyDealsCountdown($date = false)
	{ 
		date_default_timezone_set('PRC');
		
		$endtime = strtotime(date('Y-m-d'). '23:59:59');
		$nowtime = time();
		
		//剩余时间
		$lefttime = $endtime - $nowtime; //实际剩下的时间（秒）
		
		//计算小时
		$remain = $lefttime % 86400;
		$hours = intval($remain / 3600);
		if(strlen($hours) == 1)
		{
			$hours = '0' . $hours;
		}
		//计算分钟数
		$remain = $remain % 3600;
		$mins = intval($remain / 60);
		if(strlen($mins) == 1)
		{
			$mins = '0' . $mins;
		}
		//计算秒数
		$secs = $remain % 60;
		if(strlen($secs) == 1)
		{
			$secs = '0' . $secs;
		}
		$countDown = array('hours' => $hours, 'mins' => $mins, 'secs' => $secs);
		return $countDown;
	}

	/**
     * 对聚合出来的价格进行排序
     * 
     * @param array $param
     * @return  array
    */
	public static function yjPriceSort($param)
	{ 
		$yjPrice = array();
		foreach ($param as $key => $value)
		{
			switch($value['name'])
			{
				case 'priceRange1':
					$yjPrice[0] = $value;
					break;
				case 'priceRange2':
					$yjPrice[1] = $value;
					break;
				case 'priceRange3':
					$yjPrice[2] = $value;
					break;
				case 'priceRange4':
					$yjPrice[3] = $value;
					break;
				case 'priceRange5':
					$yjPrice[4] = $value;
					break;
			}
		}
		sort($yjPrice);
		return $yjPrice;
	}

	/**
     * 排序转化
     * 
     * @param string $sort 排序方式
     * @return  string
    */
	public static function categoryListSort($sort){
		$listSort = array(
							  'newest'     => 'releaseTime',
							  'popular'    => 'salesVolume',
							  'reviews'    => 'reviewCount',
							  'price_low'  => 'pirceAsc',
							  'price_high' => 'pirceDesc',
						);
		return $listSort[$sort];
	}

	/**
     * 根据数组中的键进行排序
     * 
     * @param   array $arrays      排序数组
	 * @param   string $sortKey    排序字段
	 * @param   int $sortOrder  排序方式
	 * @param   int $sortType   排序字段类型
     * @return  mixed boolean|array
    */
	public static function arraySort($arrays, $sortKey, $sortOrder = SORT_ASC, $sortType = SORT_NUMERIC)
	{
		$keyArrays = [];
		foreach((array)$arrays as $array)
		{
			if(!is_array($array))
			{	
				return false;
			}
			$keyArrays[] = $array[$sortKey];
		}
		!empty($keyArrays) &&  array_multisort($keyArrays,$sortOrder,$sortType,$arrays);
        return empty($keyArrays) ? false : $arrays;
    }

    /**
     * 获取面包屑
     * 
     * @param int $id
     * @param string $type 类型
     * @return  mixed boolean|array
    */
    public static function breadCrumbs($id, $type = 'category')
    { 
    	if(empty($id))
    	{
    		return false;
    	}

    	$breadCrumbs = Yii::$container->get('ProductModel')->getBreadCrumbs($id, $type);
    	if($breadCrumbs['ret'] != 1)
    	{
    		return false;
    	}

    	$data = $breadCrumbs['data'];
    	$data = self::arraySort($data, 'level');

		return $data;
   	}

   	/**
     * 分类页属性标签转换
     * 
     * @param   $name	排序方式
     * @return  string
    */
   	public static function displayCateAttrName($name)
   	{ 
   		$name = trim($name);
   		$attrName = $name;
		switch ($name)
		{
			case 'tagsName.tagName':
			  $attrName = 'Featured Options';
			  break;
			case 'brand':
			  $attrName = 'Brand';
			  break;
			case 'depots.depotName':
			  $attrName = 'WareHouse Options';
			  break;
			case 'yjPrice':
			  $attrName = 'Price';
			  break;
			case 'size':
			  $attrName = 'Size';
			  break;
			case 'color':
			  $attrName = 'Color';
			  break;
			default:
			  $attrName = $name;
		}
		return $attrName;
	}

	/**
     * 提取属性名name
     * 
     * @param   string $name
     * @return  string
    */
	public static function extractAttrName($name)
	{ 
		$attrName = 'type';
		if(strstr($name, '.'))
		{ 
			$_temp = explode('.', $name);
			$attrName = $_temp[1];
		}
		elseif(in_array($name, ['brand', 'yjprice']))
		{ 
			$attrName = $name;
		}
		return $attrName;
	}

	/**
     * 显示价格属性区间
     * 
     * @param   string $name
     * @return  string
    */
	public static function displayAttrPrice($name)
	{ 
		$name = trim($name);
		$attributeName = 'More than 100';
		switch ($name)
		{
			case 'priceRange1':
			  $attributeName = '0.01 ~ 20';
			  break;
			case 'priceRange2':
			  $attributeName = '20.01 ~ 50';
			  break;
			case 'priceRange3':
			  $attributeName = '50.01 ~ 100';
			  break;
			case 'priceRange4':
			  $attributeName = 'More than 100';
			  break;
		}
		return $attributeName;
	}

	/**
     * 属性显示名称
     * 
     * @param   string $name
     * @return  string
    */
	public static function displayAttrName($name)
	{ 
		$name = trim($name);
		switch ($name)
		{
			case 'freeshipping':
			  $attributeName = 'Free Shipping';
			  break;
			case 'onSale':
			  $attributeName = 'On Sale';
			  break;
			default:
			  $attributeName = $name;
		}
		return $attributeName;
	}

	/**
     * 获取语言ID
     * 
     * @param   string $code 语言代码
     * @return  int $id
    */
	public static function getLangId($code){ 
		$id = 1;
    	isset(Yii::$app->params['langIds'][$code]) && $id = Yii::$app->params['langIds'][$code];
    	return $id;
    }

    /**
     * 分页静态URL构建
     * 
     * @param   int $bothNum 两边保持数字分页的量
     * @param   int $page 总页数
     * @param   int $pagenum  当前页数
     * @return  string $html
    */
    public static function tomtopPageUrlRewrite($bothnum, $page, $pagenum)
    { 
	 	//当前URL
	 	$_url = $_SERVER["REQUEST_URI"];
	 	$_par = parse_url($_url);
		if (isset($_par['query'])) 
		{
			parse_str($_par['query'], $_query);
			$_url = $_par['path'];
			$queryParam = '?' . http_build_query($_query);
		}
		$_pregUrl = preg_match('/([0-9]+)\.html/', $_url, $matches);
		$_url = str_replace($matches[0], '', $_url);
		if(substr($_url, -1) == '/')
		{
			$_url = substr($_url, 0, -1);
		}
		//搜索页
		if(strstr($_url, 'search'))
		{
			$_url = str_replace($_GET['keyword'] . '.html', $_GET['keyword'], $_url);
		}
		
		$_pagelist = '';
		//首页
		if ($page > $bothnum + 1) 
		{
			if(strstr($_url, 'search'))
			{ 
				$_pagelist .= '<li class="lineBlock pageLink"> <a class="lineBlock" href="' . $_url . '.html' . $queryParam . '">1</a> ...</li>';
			}else
			{
				$_pagelist .= '<li class="lineBlock pageLink"> <a class="lineBlock" href="' . $_url . '">1</a> ...</li>';
			}
		}
		
		//上一页
		if ($page == 1) 
		{
			$_pagelist .= '<li class="lineBlock pageP"><i class="icon-pageP"> </i>Previous Page</li>';
		}
		else
		{ 
			$_pagelist .= '<li class="lineBlock pageP pageClick"><i class="icon-pageP"> </i><a class="lineBlock" href="' . $_url . '/' . ($page - 1) . '.html' . $queryParam . '">Previous Page</a></li>';
		}
		
		//分页数字栏
	 	$_pagelist .= '<li class="lineBlock pageLink">';
		for ($i = $bothnum; $i >= 1; $i--) 
		{
			$_page = $page-$i;
			if ($_page < 1) continue;
			$_pagelist .= ' <a class="lineBlock" href="' . $_url . '/' . $_page . '.html' . $queryParam . '">' . $_page . '</a> ';
		}
		$_pagelist .= ' <a class="lineBlock active">' . $page . '</a> ';
		for ($i = 1; $i <= $bothnum; $i++) 
		{
	 		$_page = $page + $i;
			if ($_page > $pagenum) break;
			$_pagelist .= ' <a class="lineBlock" href="' . $_url . '/' . $_page . '.html' . $queryParam . '">' . $_page . '</a> ';
		}
		$_pagelist .= '</li>';
		
		//下一页
		if ($page == $pagenum) 
		{
			$_pagelist .= '<li class="lineBlock pageN">Next Page<i class="icon-pageN"> </i></li>';
		}
		else
		{ 
			$_pagelist .= '<li class="lineBlock pageN pageClick"><a class="lineBlock" href="' . $_url . '/' . ($page + 1) . '.html' . $queryParam . '">Next Page<i class="icon-pageN"> </i></a></li>';
		}
		
		//尾页
		if ($pagenum - $page > $bothnum) 
		{
			$_pagelist .= '<li class="lineBlock pageLink"> ...<a class="lineBlock" href="' . $_url . '/' . $pagenum . '.html' . $queryParam . '">' . $pagenum . '</a></li>';
		}
		
		return $_pagelist;
	}

	/**
     * 文件上传
     * 
     * @param   array $file 文件句柄
     * @return  array $ret
    */
	public static function uploadFile($file)
	{
		//上传文件类型列表  
		$uptypes = ['image/jpg','image/jpeg','image/png','image/pjpeg','image/gif','image/bmp','image/x-png'];
		//上传文件大小限制, 单位BYTE 
		$max_file_size = 2000000;
		//上传文件路径  
		$folder = '/tmp/' . date('Ymd') . '/';     
		$destination_folder = getcwd() . $folder;
		//上传处理
		if (is_uploaded_file($file['tmp_name'])) 
		{
	        if ($file["size"] < $max_file_size) 
	        {
		        if (in_array($file["type"], $uptypes)) 
		        {
			        if (!file_exists($destination_folder)) 
			        {
			            mkdir($destination_folder, 0777);
            			chmod($destination_folder,0777);
			        }	
			        $filename = $file["tmp_name"];
			        $image_size = getimagesize($filename);
			        $pinfo = pathinfo($file["name"]);
			        $ftype = $pinfo['extension'];
			        $str = time() . substr(str_shuffle('abcdefghijklmnopqrst1234567890'), 0,4) ;
			        $fname = $str . "." . $ftype;
			        $destination = $destination_folder . $fname;

			        if (!move_uploaded_file($filename, $destination)) 
			        {
			        	$ret = ['ret' => -1, 'msg' => '移动文件出错'];
			        }
			        else
			        {
			        	$ret = [
			        		'ret'  => 1,
			        		'data' => ['uploaedFile' => $folder . $fname],
			        	];
			        }
		        }
		        else
		        {
		        	$ret = ['ret' => -1, 'msg' => '文件类型不符!'];
		        }	
	        }
	        else
	        {
        	
		        $ret = array('ret' => -1, 'msg' => '文件太大');
	        }
        }
        else
        {
        	$ret = ['ret' => -1, 'msg' => '文件不存在!'];
        }
        
		return $ret;
	}

	/**
     * 获取商品URL
     * 
     * @param   string $prefix url前缀 例如  bottoms/jeans/joggers/p_106723
     * @return  string $html
    */
	public static function getProductUrl($prefix)
	{
		return Url::home() . $prefix . '.html';
	}

	/**
     * 商品图片主图放第一位
     * 
     * @param   array $imglist	商品图片
     * @return  array
    */
    public static function sortProductImgArray($imglist)
    {
    	$slideImgList = array();
    	foreach ($imglist as $key => $value)
    	{
			if($value['isMain'] === true)
			{
				$slideImgList[0] = $value;
			}
			$slideImgList[$key] = $value;
		}
		return $slideImgList;
    }

	/**
     * 根据单个属性值对属性map进行拆分
     * 
     * @param   array $allCategory
     * @param   array $breadCrumbs
     * @return  string
    */
	public static function imagesDispalyType($allCategory, $breadCrumbs)
	{
		$type = 1;
		if(is_array($breadCrumbs))
		{ 
			$count = count($breadCrumbs);
			$cateCpath = $breadCrumbs[$count - 1]['cpath'];
			foreach ($allCategory as $key => $value)
			{
				if(strtolower($key) == strtolower($cateCpath))
				{
					$type = $value;
					break;
				}
			}
		}
		return $type;
	}

	/**
     * 提取cookies运抵国家
     * 
     * @param   array $porductStorage
     * @return  string
    */
	public static function shippingToCountry($porductStorage)
	{ 
		$storageName = '';
		foreach ($porductStorage as $key => $value)
		{ 
			$storageName .= $value['storageName'];
		}
		$countrySlit = self::getCookie('country');
		$country = explode('|', $countrySlit);
		$shippingTo = 'CN';
		if($country[1] && strstr($storageName, $country[1]))
		{
			return $country[1];
		}
		return $shippingTo;
	}

	/**
     * 详情页根据仓库获取价格
     * 
     * @param   $sort	排序方式
     * @return  string
    */
	public static function getPriceByWarehouse($listingId, $priceList, $currentRate)
	{ 
		$urlWarehouse = Yii::$app->request->get('Warehouse');
		$ttWarehouse = self::getCookie('TT_WAREHOUSE');
		
		$warehouseName = '';
		if(count($priceList) > 0)
		{ 
			foreach ($priceList as $wareKey => $wareData)
			{
				$warehouseName = $wareKey;
				break;
			}
		}
		
		//url带仓库参数优先级最高
		if(!empty($urlWarehouse) && in_array(Yii::$app->params['warehouse']))
		{
			$warehouseName = $urlWarehouse;
		}
		else
		{ 
			if(!empty($ttWarehouse))
			{ 
				foreach (Json::decode($ttWarehouse) as $key => $value)
				{
					if($value['listingId'] == $listingId)
					{
						$warehouseName = $value['depotName'];
						break;
					}
				}
			}
		}
		
		$detailsPrice = array();
		foreach ($priceList as $pk => $pvalue)
		{ 
			if($pk == $warehouseName)
			{ 
				$detailsPrice = $pvalue;
				$detailsPrice['warehouse'] = $warehouseName;
				$detailsPrice['us_nowprice'] = number_format($pvalue['nowprice'] / $currentRate, 2, '.', '');
				$detailsPrice['us_origprice'] = number_format($pvalue['origprice'] /$currentRate, 2, '.', '');
				break;
			}
		}
		
		return $detailsPrice;
	}

	/**
     * 获取仓库全称
     * 
     * @param   string $code  仓库代码
     * @return  string
    */
    public static function warehouseFullName($code)
    { 
    	return Yii::$app->params['warehouseFullName'][$code];
    }


	/**
	 * @desc 更具仓库code获得仓库简称
	 * @param $code
	 * @return mixed
	 */
	public static function warehouseIdCode($code)
	{
		return Yii::$app->params['warehouseIdCode'][$code];
	}

	/**
     * 详情页通过面包屑获取CategoryId
     * 
     * @param   array $breadCrumbs 面包屑导航
     * @param 	int $lever
     * @return  int 
    */
   	public static function getCateIdBybreadCrumbs($breadCrumbs, $lever)
   	{ 
   		$count = count($breadCrumbs);
   		$cateId = $breadCrumbs[$count - $lever]['categoryId'];
   		if($cateId > 0)
   		{ 
   			return $cateId;
   		}
   		return false;
   	}

	/**
     * 邮箱显示处理
     * 
     * @param   $email  邮箱
     * @return  string 
    */
    public static function displayEmail($email)
    { 
    	$slitEmail = explode('@', $email);
    	$firstLetter = substr($slitEmail[0], 0, 1);
    	$strlen = strlen($slitEmail[0]);
    	$replaceParts  = '';
    	for ($i = 1; $i < $strlen; $i++)
    	{ 
    		$replaceParts .= '*';
    	}
    	return $firstLetter . $replaceParts . $slitEmail[1];
    }


	/**
     * 搜索页面的属性筛选
     * 
     * @param   $param	name=>value
     * @return  string
    */
	public static function searchAttrSelectUrl($param, $uncheck = true, $name = '')
	{
		$baseUrl = Yii::$app->request->getBaseUrl();
		$urlParam = array(
							'sort',
							'p',
							'yjprice',
							'tagname',
							'brand',
							'type',
							'cpath'
						);

		//去除所有url上没有值的参数去掉
		foreach ($urlParam as $key => $value)
		{ 
			if(Yii::$app->request->get($value) == '')
			{ 
				$baseUrl = str_replace('&' . $value . '=', '', $baseUrl);
			}
		}
		$optionUrl = '';
		foreach ($param as $key => $value)
		{ 
			$oldParam = Yii::$app->request->get($key);
			if(strstr($baseUrl, 'p='))
			{ //重新选择属性时默认从第一页开始
				$baseUrl = str_replace('p=' . Yii::$app->request->get('p'), 'p=1', $baseUrl);
			}
			if(strstr($baseUrl,$key) && !empty($oldParam))
			{ //参数URL已经存在并且参数的值不为空，当前参数名后追加新值
				if($uncheck == false)
				{ //取消选中
					$newSplit = str_replace($name, '', $oldParam);
					if(substr($newSplit,0,1) == ',')
					{ //第一个字符是逗号去掉
						$newSplit = substr($newSplit, 1);
					}
					if(substr($newSplit,-1) == ',')
					{ //最后一个字符是逗号去掉
						$newSplit = substr($newSplit, 0, -1);
					}
					return str_replace($oldParam, $newSplit, $baseUrl); //替换去掉当前选中项
				}
				$newParam = $oldParam . ',' . $value;
				if($key == 'yjprice')
				{ //价格单选
					$newParam = $value;
				}
				$tagValue = explode(',', $newParam);
				$uniqueTagValue = array_unique($tagValue);//去重复属性值
				$newTagName = '';
				foreach ($uniqueTagValue as $k => $data)
				{ 
					$newTagName .= $data . ',';//重新拼接
				}
				$finalTagValue = substr($newTagName, 0, -1);//去除末尾连接符
				return str_replace($oldParam, $finalTagValue, $baseUrl);
			}
			else
			{
				if(strstr($baseUrl, "?"))
				{
					$optionUrl = '&' . $key . '=' . $value;
				}
				else
				{ 
					$optionUrl = '?' . $key . '=' . $value;
				}
			}
		}
		$url = $baseUrl . $optionUrl;
		return $url;
	}


	/**
     * 分类页属性URL拼接
     * 
     * @param   array $param	name=>value
     * @param   boolean $uncheck 
     * @param   string $name
     * @return  string
    */
	public static function attrSelectUrl($param, $uncheck = true, $name = '')
	{
		$baseUrl = Url::current();
		$optionUrl = '';
		foreach ($param as $key => $value)
		{ 
			$oldParam = Yii::$app->request->get($key);
			if(strstr($baseUrl, 'p='))
			{ //重新选择属性时默认从第一页开始
				$baseUrl = str_replace('p=' . Yii::$app->request->get('p'), 'p=1', $baseUrl);
			}
			if(strstr($baseUrl, $key) && !empty($oldParam))
			{ //参数URL已经存在并且参数的值不为空，当前参数名后追加新值
				if($uncheck == false)
				{ //取消选中
					$newSplit = str_replace($name, '', $oldParam);
					if(substr($newSplit, 0, 1) == ',')
					{ //第一个字符是逗号去掉
						$newSplit = substr($newSplit, 1);
					}
					if(substr($newSplit, -1) == ',')
					{ //最后一个字符是逗号去掉
						$newSplit = substr($newSplit, 0, -1);
					}
					return str_replace($oldParam, $newSplit, $baseUrl); //替换去掉当前选中项
				}
				$newParam = $oldParam . ',' . $value;
				$tagValue = explode(',', $newParam);
				$uniqueTagValue = array_unique($tagValue);//去重复属性值
				$newTagName = '';
				foreach ($uniqueTagValue as $key => $data){ 
					$newTagName .= $data . ',';//重新拼接
				}
				$finalTagValue = substr($newTagName, 0, -1);//去除末尾连接符
				return str_replace($oldParam, $value, $baseUrl);
			}
			else
			{
				if(strstr($baseUrl, "?"))
				{
					$optionUrl = '&' . $key . '=' . $value;
				}
				else
				{ 
					$optionUrl = '?' . $key . '=' . $value;
				}
			}
		}
		$url = $baseUrl . $optionUrl;
		return $url;
	}

	/**
	 * @desc 生产唯一字符串
	 * @param string $type
	 * @return string
	 */
	public static function createUniqueId($type = 'cookie')
	{
		$str = substr(str_shuffle('abcdefghijklmnopqrstABCDEFGHIJKLMNOPQRSTXYZ1234567890'), 0, 8);
		return md5( $type . uniqid() . self::getRemoteIp() . $str );
	}

	/**
	 * @desc 获取客户端ip
	 * @return string
	 */
	public static function getRemoteIp()
	{
		return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
	}

	/**
	 * @desc 创建缓存key
	 * @param $prefix
	 * @param $id
	 * @return string
	 */
	public static function createCacheKey($prefix, $id)
	{
		return $prefix . $id;
	}
	

	/**
	 * 获取文章url
	 * @param $urlPrefix
	 * @return string
	 */
	public static function getArticleUrl($urlPrefix)
	{
		return Url::home() . $urlPrefix . '.html';
	}

	/**
	 * 频道页新品按照时间属性单选
	 * @param array $param	name=>value
	 * @param string $name
	 * @return string
	 */
	public static function newArrivalReleaseTime($param, $name)
	{ 
		$baseUrl = Url::current();
		$url = '';
		$urlOption = '';
		foreach ($param as $key => $value)
		{
			$urlOption .= $key . '=' . $value . '&';
		}
		$urlOption = substr($urlOption, 0, -1);
		
		if($name == 'releaseTime' || $name == 'cpath' || $name == 'sort')
		{ 
			if(strstr($baseUrl, $name) && $_GET['id'] > 0)
			{ 
				$baseUrl = str_replace($name . '=' . $_GET[$name] . '&id=' . $_GET['id'], '', $baseUrl);
			}
			else
			{ 
				$baseUrl = str_replace($name . '=' . $_GET[$name], '', $baseUrl);
			}
		}
		
		$urlOption = (!strstr($baseUrl ,'?')) ? '?' . $urlOption : '&' . $urlOption;
		$url = $baseUrl . $urlOption;
		
		if(strstr($url, '?&'))
		{ 
			$url = str_replace('?&', '?', $url);
		}
		
		if(strstr($url, '&&'))
		{ 
			$url = str_replace('&&', '&', $url);
		}
		
		$url = str_replace('&&', '&', $url);
		return $url;
	}
}