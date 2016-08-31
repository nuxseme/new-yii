<?php
/**
 * 7888841588887  750888880057     91         42  288845240880   24888888042     74508080057 
 *  77778887777   887777777788     8887     7888  777778827777  9887777777884    480  77 788 
 *      782       88        88     82282   88788       88       587       781    282      88 
 *      285       88        88     82 788788  88       88       587       281    28888888885 
 *      284       88        88     84  7884   88       88       482       284    282         
 *      488       888888888888     88    7   788       88       7888888888887    484              
 *
 *
 * 公用文件  在每个子项目 index.php 运行之前引入
 * @link http://www.tomtop.com
 * @copyright Copyright (c) TOMTOP
 * @license http://www.tomtop.com/license/
 */
!defined('TT_SYS') && exit('Access denied!');
use common\components\TTConf;

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

define('DS', DIRECTORY_SEPARATOR);//统一目录分隔符

define('SYS_PATH', dirname(dirname(__FILE__)) . DS);//系统目录

define('SYS_COMMON_PATH', SYS_PATH . 'common' . DS);//common 公用目录

define('SYS_ENV_PATH', SYS_COMMON_PATH . 'environments' . DS);//环境配置目录

define('SYS_RUNTIME_PATH', SYS_PATH . '@runtime' . DS);//runtime目录

define('ENV_PROD_FILE', SYS_PATH . 'prod.txt');//生产环境标识文件

define('ENV_DEV_FILE', SYS_PATH . 'dev.txt');//开发环境标识文件

define('ENV_TEST_FILE', SYS_PATH . 'test.txt');//测试环境标识文件

!defined('YII_DEBUG') && define('YII_DEBUG', true);

!defined('DOMAIN') && define('DOMAIN', $_SERVER['SERVER_NAME']);//当前主机域名 安全起见最好在项目中手动定义

define('APP_PATH', SYS_PATH . DOMAIN);//应用目录

define('SYS_VENDOR_PATH', SYS_PATH . 'vendor' . DS);//vendor路径

/**
* 获取env环境
*
* @author caoxl
* @return string $env
*/
function getSysEnv()
{
	$iniFile = php_ini_loaded_file();
	$iniVarsArr = parse_ini_file($iniFile, true);
	$env = 'prod';
	if(isset($iniVarsArr['PHP']['env']))
	{
		$iniEnv = $iniVarsArr['PHP']['env'];
		$iniToLocal = ['uat' => 'test', 'dev' => 'dev', 'prod' => 'prod'];
		array_key_exists($iniEnv, $iniToLocal) && $env = $iniToLocal[$iniEnv];
	}
	else
	{
		if(is_file(ENV_DEV_FILE))
		{
			$env = 'dev';
		}
		elseif(is_file(ENV_TEST_FILE))
		{
			$env = 'test';
		}
	}
	return $env;
}

define('YII_ENV', getSysEnv());

defined('YII_DEBUG') or define('YII_DEBUG', true);

require(SYS_VENDOR_PATH . 'autoload.php');
require(SYS_VENDOR_PATH . 'yiisoft/yii2/Yii.php');

Yii::setAlias('common', SYS_COMMON_PATH);

$TTConf = TTConf::getInstance();
$config = $TTConf->buildConf(YII_ENV, DOMAIN);
unset($TTConf);



