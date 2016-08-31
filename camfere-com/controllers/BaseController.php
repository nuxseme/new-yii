<?php
namespace app\controllers;

use Yii;
use common\components\AppController;
use yii\helpers\Url;

/**
 * 站点基础控制器
 */
class BaseController  extends AppController
{
	/**
	* action之前的动作
	*
	* @param Action $action
	* @return mixed
	*/
	public function beforeAction($action)
	{
		if(!Yii::$app->request->getIsAjax())
		{//只有非ajax请求才有layout
			Yii::$app->view->params['headerNav'] = $this->runAppAction('\common\actions\body\NavAction');
			Yii::$app->view->params['footerArticle'] = $this->runAppAction('\common\actions\body\FooterArticleAction');
			Yii::$app->view->params['countryList'] = $this->runAppAction('\common\actions\common\CountryListAction');
			Yii::$app->view->params['currencyList'] = $this->runAppAction('\common\actions\common\CurrencyListAction');
			Yii::$app->view->params['topBanners'] = $this->runAppAction('\common\actions\body\TopBannersAction');
		}
		$this->assiginDefaultShipTo();
		$this->assiginDefaultCoun();
		return parent::beforeAction($action);
	}

	/**
	* 赋值默认配送国家
	*
	* @return void
	*/
	protected function assiginDefaultShipTo()
	{
		$TTHelper = Yii::$container->get('TTHelper');
		if($TTHelper->getCookie(Yii::$app->params['shipto']) === null)
		{//如果cookie中未设置默认发往国家 进行设置
			$country = array_slice($this->getCountries(), 0, 1);
			$TTHelper->setCookie(
									Yii::$app->params['shipto'], 
									array_keys($country)[0] . '|' . array_values($country)[0]['isoCodeTwo'],
									3600 * 30
								);
		}
	}

	/**
	* 赋值默认发货仓库
	*
	* @return void
	*/
	protected function assiginDefaultCoun()
	{
		$TTHelper = Yii::$container->get('TTHelper');
		if($TTHelper->getCookie(Yii::$app->params['coun']) === null)
		{//如果cookie中未设置默认仓库
			$TTHelper->setCookie(
									Yii::$app->params['coun'], 
									Yii::$app->params['defaultCoun'],
									3600 * 30
								);
		}
	}

	/**
	* 登录成功后跳转
	*
	* @return Response
	*/
	public function redirectLogin()
	{
		$currentUrl =Url::current();
		$this->redirect(['member/userlogin','backUrl'=>$currentUrl]);
	}

	/**
	 * @desc 设置用户中心seo
	 */
	public function setAccountSeo()
	{
		$arr =array(
			'title'=>'My Account | Camfere.com',
			'description'=>'Shop Photography Accessories at Camfere.com with Bargain Price.',
			'keywords'=>'',
		);
		$this->seoMeta($arr);
	}

}