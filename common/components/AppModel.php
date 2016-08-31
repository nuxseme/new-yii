<?php
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
namespace common\components;

use Yii;
use yii\base\Model;
use yii\helpers\Json;

/**
 * 新架构下模型.
 *
 * @author caoxl
 */
class AppModel extends Model  implements Mountpoint{

	/**
	 * @var int $_cacheTime 缓存时间
	 */
	private $_cacheTime = 3600;

	public function init()
	{
		parent::init();
	}
	/**
	* 获取当前上下文类型
	* @param void
	* @return string $contextType
	*/
	public function getContextType()
	{
		return 'AppModel';
	}


	/**
	 * @desc 获取用户登录信息接口
	 * @author wang
	 * @date 2016-7-11
	 * @return mixed
	 */
	public function getUserEmail()
	{
		$uuid = Yii::$container->get('TTHelper')->getCookie(Yii::$app->params['uuid']);

		if (!$uuid)
		{
			return ['ret' => '0', 'data' => '' , 'errMsg' => 'do not login'];
		}
		$cacheKey = __CLASS__ .$uuid.'userSignInfo';
		$res = Yii::$app->cache->get($cacheKey);
		if($res === false)
		{
			$appCurl = new AppCurl();
			$res = $appCurl->get(['api'=>'UserSignInfo', 'params'=>['uuid'=>$uuid]]);
			$res = Json::decode($res);
			if( $res['ret'] == 1)
			{
				Yii::$app->cache->set($cacheKey, $res, $this->_cacheTime,'user');
			}
		}
		return $res;
	}


}