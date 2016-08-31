<?php
/*
* 表单接收参数验证相关操作的action
*
*/
namespace common\actions\ppsuperuser;

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

}
