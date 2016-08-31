<?php
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
namespace common\components;

use Yii;
use yii\web\View;
use yii\helpers\FileHelper;
use yii\base\ViewContextInterface;
use yii\base\InvalidParamException;
use yii\base\InvalidCallException;

/**
 * 新架构下视图.
 *
 * @author caoxl
 */
class AppView extends View  implements Mountpoint{
	/**
	* 获取当前上下文类型
	* @param void
	* @return string $contextType
	*/
	public function getContextType()
	{
		return 'AppView';
	}

	/**
	* 初始化
	* 初始化加上 csrf token 以防止ajax 400 错误
	* 
	*/
	public function init()
	{
		parent::init();
		$this->registerJs($this->createJsCode(), self::POS_HEAD);
	}

	/**
	 * 创建JS全局代码
	 *
	 * @return string $jsCode
	 */
	protected function createJsCode(array $funcs = ['createJsConfig', 'createJsCurrency'])
	{
		$jsCode = '';
		foreach ((array)$funcs as $func)
		{
			if(method_exists($this, $func))
			{
				$jsCode .= call_user_func_array([$this, $func], []);
			}
		}
		return $jsCode;
	}

	/**
	 * 创建JS货币配置代码
	 *
	 * @return string $jsCode
	 */
	protected function createJsCurrency()
	{
		$currencyModel = Yii::createObject('common\models\Currency');
		$res = $currencyModel->getCurrencies();

		$jsCode = 'var currencyRate = [];var currencyLabel = [];';
		if ($res['ret']==1)
		{
			foreach ((array)$res['data'] as $item)
			{
				$jsCode .= "currencyRate['{$item['code']}'] = {$item['currentRate']};";
				$jsCode .= "currencyLabel['{$item['code']}'] = '{$item['symbolCode']}';";
			}
		}
		return $jsCode;
	}

	/**
	 * 创建JS全局配置代码
	 *
	 * @return string $jsCode
	 */
	protected  function createJsConfig()
	{
		$jsCode = <<<EOF
		var TT_NS = (function(NS){
			/*
			* 配置模块
			*/
			NS['config'] = NS['config'] || {};
			NS['config']['webUrl'] = '{hostInfo}';
			NS['config']['winHref'] = window.location.href;
			NS['config']['winHrefArr'] = NS.config.winHref.split(".")[0];
			NS['config']['domain'] = '/';
			NS['config']['cookieDomain'] = '{cookieDomain}';
			
			NS['config']['urlCDN'] = '{imagesCdnUrl}';
			NS['config']['url2000'] = '{imagesCdnUrl}/product/xy/2000/2000/';
			NS['config']['url560'] = '{imagesCdnUrl}/product/xy/560/560/';
			NS['config']['url500'] = '{imagesCdnUrl}/product/xy/500/500/';
			NS['config']['staticUrl'] = '{staticRoute}';
            NS['config']['cartUrl'] = '{cartHost}';
            NS['config']['url60'] = '{imagesCdnUrl}/product/xy/60/60/';
            
			return NS;
		})(window.TT_NS || {});
EOF;
		$jsCode = str_replace(
			[
				'{hostInfo}',
				'{cookieDomain}',
				'{imagesCdnUrl}',
				'{staticRoute}',
				'{cartHost}',
				"\r\n",
				"\n",
				"\t",
			],
			[
				Yii::$app->request->hostInfo,
				Yii::$app->params['cookDomain'],
				Yii::$app->params['imagesCdnUrl'],
				Yii::$app->params['staticRoute'],
				Yii::$app->params['cartHost'],
				'',
				'',
				'',
			],
			$jsCode
		);
		return $jsCode;
	}

	/**
	 * @author caoxl
	 *
     * Finds the view file based on the given view name.
     * @param string $view the view name or the path alias of the view file. Please refer to [[render()]]
     * on how to specify this parameter.
     * @param object $context the context to be assigned to the view and can later be accessed via [[context]]
     * in the view. If the context implements [[ViewContextInterface]], it may also be used to locate
     * the view file corresponding to a relative view name.
     * @return string the view file path. Note that the file may not exist.
     * @throws InvalidCallException if a relative view name is given while there is no active context to
     * determine the corresponding view file.
     */
    protected function findViewFile($view, $context = null)
    {
        if (strncmp($view, '@', 1) === 0) 
        {
            // e.g. "@app/views/main"
            $file = Yii::getAlias($view);
        } 
        elseif (strncmp($view, '//', 2) === 0) 
        {
            // e.g. "//layouts/main"
            $file = Yii::$app->getViewPath() . DIRECTORY_SEPARATOR . ltrim($view, '/');
        } 
        elseif (strncmp($view, '/', 1) === 0) 
        {
            // e.g. "/site/index"
            if (Yii::$app->controller !== null) 
            {
                $file = Yii::$app->controller->module->getViewPath() . DIRECTORY_SEPARATOR . ltrim($view, '/');
            } else {
                throw new InvalidCallException("Unable to locate view file for view '$view': no active controller.");
            }
        } 
        elseif ($context instanceof ViewContextInterface) 
        {
        	if($context instanceof ActionViewInterface)
        	{//如果是action的视图接口 默认使用其控制器所属视图 不存在的情况使用action公用视图
                $ctlViewFile = $context->controller->getViewPath() . DIRECTORY_SEPARATOR . ltrim($view, '/');
        		if(pathinfo($ctlViewFile, PATHINFO_EXTENSION) !== '')
        		{//如果视图有后缀
        			if(is_file($ctlViewFile))
        			{//视图文件存在
        				$file = $ctlViewFile;
        				return $file;
        			}
        		}
        		else
        		{//视图文件无后缀
        			$ctlViewPath = $ctlViewFile . '.' . $this->defaultExtension;
        			if ($this->defaultExtension !== 'php' && !is_file($ctlViewPath)) 
			        {
			            $ctlViewPath = $ctlViewFile . '.php';
			        }
			        if(is_file($ctlViewPath))
			        {//视图文件存在
			        	$file = $ctlViewPath;
			        	return $file;
			        }
        		}
        	}
            $file = $context->getViewPath() . DIRECTORY_SEPARATOR . $view;
        }
        elseif (($currentViewFile = $this->getViewFile()) !== false) 
        {
            $file = dirname($currentViewFile) . DIRECTORY_SEPARATOR . $view;
        } 
        else 
        {
            throw new InvalidCallException("Unable to resolve view file for view '$view': no active view context.");
        }

        if (pathinfo($file, PATHINFO_EXTENSION) !== '') 
        {
            return $file;
        }
        $path = $file . '.' . $this->defaultExtension;
        if ($this->defaultExtension !== 'php' && !is_file($path)) 
        {
            $path = $file . '.php';
        }

        return $path;
    }
}