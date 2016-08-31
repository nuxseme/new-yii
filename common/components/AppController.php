<?php
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
namespace common\components;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;

/**
 * 新架构下应用控制器.
 *
 * @author caoxl
 */
class AppController extends Controller implements Mountpoint
{
	/**
	* @var array $countries 国家列表
	*/
	protected $countries = null;

	/**
	* @var array $currencies 货币列表
	*/
	protected $currencies = null;

	/**
	* @var array $siteInfo 站点信息
	*/
	protected $siteInfo;

	/**
	* @var string $lang 语言
	*/
	protected $lang;

	/**
	* @var array $country 国家 ['cuntry' => '国家', 'cuntryCode' => '国家代码']
	*/
	protected $country;

	/**
	* @var string $currency 货币
	*/
	protected $currency;

	/**
	* @var string $categories  所有分类
	*/
	protected $categories;

	/**
	 * @var array  存放seo信息
	 */
	public $meta = array();

	/**
	* 获取当前上下文类型
	* @param void
	* @return string $contextType
	*/
	public function getContextType()
	{
		return 'AppController';
	}

	/**
	* 获取国家列表
	* @param void
	* @return array $countries  以国家代号为键名
	*/
	public function getCountries()
	{
		if($this->countries === null)
		{
			$this->countries = Yii::$container->get('CountryModel')->getCountriesWithIndex()['data'];
		}
		return $this->countries;
	}

	/**
	* 获取货币列表
	* @param void
	* @return array $currencies  以国家代号为键名
	*/
	public function getCurrencies()
	{
		if($this->currencies === null)
		{
			$this->currencies = Yii::$container->get('CurrencyModel')->getCurrenciesWithIndex()['data'];
		}
		return $this->currencies;
	}


	/**
	* 获取语言包
	* @param void
	* @return array $pkg
	*/
	public function getLangPkg()
	{
		return Yii::$container->get('TTHelper')->getLangPkg();
	}

	/**
	* 获取语言信息
	* @param void
	* @return string $lang
	*/
	public function getLang()
	{
		if($this->lang === null)
		{
			$lang = $this->runAppAction('\common\actions\LangAction');
			$this->lang = $lang;
		}
		return $this->lang;
	}

	/**
	* 获取货币
	* @param void
	* @return string $currency
	*/
	public function getCurrency()
	{
		if($this->currency === null)
		{
			$act = $this->createAppAction('\common\actions\CurrencyAction');
			$this->currency = $act->setCurrency($this->getLang());
		}
		return $this->currency;
	}

	/**
	* 获取站点信息
	* @param void
	* @return array $siteInfo
	*/
	public function getSiteInfo()
	{
		if($this->siteInfo === null)
		{
			$act = $this->createAppAction('\common\actions\CurrencyAction');
			$lang = $this->getLang();
			$this->getCountry();
			$this->getCurrency();
			$this->siteInfo = $act->setSymbolCode($lang);
		}
		return $this->siteInfo;
	}

	/**
	* 获取国家信息
	* @param void
	* @return array $cuntry
	*/
	public function getCountry()
	{
		if($this->country === null)
		{
			$re = $this->runAppAction('\common\actions\CountryAction', [$this->getLang()]);
			$this->country = $re;
		}
		return $this->country;
	}

	/**
	* 获取所有分类
	* @param void
	* @return array $categories
	*/
	public function getCategories()
	{
		if($this->categories === null)
		{
			$re = Yii::$container->get('CateModel')->getCategories()['data'];
			$this->categories = $re;
		}
		return $this->categories;
	}


	/**
	* 返回ajax响应
	* @param array $data 主要数据  包含键 'ret' 'data' 'msg'
	* 		 int $ret 代码
	*        	-1 => 数据为空
	*        	 0 => 请求失败
	*		 	 1 => 请求正常
	*
	*
	* @return string $jsonStr json字符串
	*/
	public function resAjax(array $data)
	{
		$res = [];
		if (!isset($data['ret']) || $data['ret'] != 1)
		{
			if (isset($data['errCode']))
			{
				$res['ret'] = $data['errCode'];
			}
			else
			{
				$res['ret'] = isset($data['ret']) ? $data['ret'] : -1;
			}
			$res['data'] = isset($data['data']) && is_string($data['data']) ? $data['data'] : false;
			$errMsg = isset($data['errMsg']) ? $data['errMsg'] : 'unknown error';
			$res['msg'] || $res['msg'] = isset($data['msg']) ? $data['msg'] : $errMsg;
		}
		else
		{
			$res =$data;
		}
		return Json::encode($res);
	}

	/**
	 * 判断是否登录，登录则返回email
	 * @return mixed string|boolean
	 */
	public function isLogin()
	{
	 	$res =	Yii::$container->get('CateModel')->getUserEmail();
	 	$email = false;
	 	$res['ret'] == 1 && $email = $res['data']['email'];
		return $email;
	}

	/**
	 * 获取用户UUID
	 * @return string
	 */
	public function getUuid()
	{
		$uuid = Yii::$container->get('TTHelper')->getCookie(Yii::$app->params['uuid']);
		return $uuid ? $uuid : '';
	}

	/**
	 * @desc 控制器中配置页面seo信息方法
	 * @param $arr ['title','description','keywords']
	 */
	public function seoMeta($arr)
	{
		$this->meta['title']          = empty($arr['title']) ? '' : $arr['title'];
		$this->meta['description']    = empty($arr['description']) ? '' : $arr['description'];
		$this->meta['keywords']       = empty($arr['keywords']) ? '' : $arr['keywords'];
	}

	/**
	 * 获取系统action
	 * @param string $class
	 * @param array $config
	 * 
	 * @return AppAction
	 * @throws Exception 当action不存在是抛出异常
	 */
	public function createAppAction($class, array $config = [])
	{
		$id = $class;
		$rpos = strrpos($class, "\\");
		if($rpos !== false)
		{
			$id = str_replace('Action', '',  mb_substr($class, $rpos));
		}
		return Yii::createObject($class, [$id, $this, $config]);
	}

	/**
	 * 运行系统action
	 * @param string $class
	 * @param array $config
	 * 
	 * @return mixed action运行的结果
	 */
	public function runAppAction($class, array $actionParams = [], array $config = [])
	{
		$act = $this->createAppAction($class, $config);
		return call_user_func_array(array($act, 'run'), $actionParams);
	}
}