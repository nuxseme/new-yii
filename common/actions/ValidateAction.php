<?php
/*
* 表单接收参数验证相关操作的action
*
*/
namespace common\actions;

use Yii;
use common\components\AppAction;
use common\helpers\TTHelper;

class ValidateAction extends AppAction
{

    public function run()
    {
    }

    /**
     * @desc 用户注册表单验证
     * @param $param
     * @return bool
     */
    public function registerVerify($param)
    {
        if (!isset($param['code']) || !$this->checkCode($param['code']))
        {
            return ['status' => 0, 'errMsg' => 'code error'];
        }
        $reg = "/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/";

        if (!isset($param['email']) || $param['email'] == '')
        {
            return ['status' => 0, 'errMsg' => 'email not exists'];
        }

        if (!preg_match($reg, $param['email']))
        {
            return ['status' => 0, 'errMsg' => 'You\'ve entered the wrong email format!'];
        }

        if((!isset($param['pw'])||$param['pw'] == '') || (!isset($param['pwa']) || $param['pwa'] == ''))
        {
            return ['status' => 0, 'errMsg' => 'This field is required!'];
        }
        if($param['pw'] !== $param['pwa'])
        {
            return ['status' => 0, 'errMsg' => 'Enter the same password as above!'];
        }
        if(strlen($param['pw'])<6)
        {
            return ['status' => 0, 'errMsg' => 'Please enter at least 6 characters!'];
        }

        return ['status'=>1];
    }

    /**
     * @desc 验证码验证
     * @param $code
     * @return array
     */
    public function checkCode($code)
    {
        $captcha = $this->getCode();
        // 验证码不能为空
        if(empty($code) || empty($captcha))
        {
            return false;
        }

        //不区分大小写比较
        if(strtoupper($code) ==strtoupper($captcha))
        {
            return true;
        }
        return false;
    }

    /**
     * @desc 获得验证码
     */
    private function getCode()
    {
        $code = false;
        $did = Yii::$container->get('TTHelper')->getCookie(Yii::$app->params['device']);
        if ($did)
        {
            $prefix = Yii::$app->params['code'];
            $key = TTHelper::createCacheKey($prefix, $did);
            $redis = Yii::$app->redis;
            $code = $redis->get($key);
        }
        return $code;
    }



}
