<?php
/**
 * @desc 用户注册登录管理
 * @author wang
 */
namespace common\models;

use Yii;
use yii\helpers\Json;
use common\components\AppModel;
use common\components\AppCurl;

class System extends AppModel
{
	/**
     * 站点语言包资源
     * 
     * @return array $data['data']
     */
    public static function getSystemTime()
    {
    	$appCurl = new AppCurl;
        $re = $appCurl->get(
                                ['api' => 'getSystemTime']
                            );
        $re = $appCurl->convertResError($re);
        $re = Json::decode($re);
        return $re;
    }
}