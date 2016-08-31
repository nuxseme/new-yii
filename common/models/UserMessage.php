<?php
/**
 * @desc 用户消息管理
 * @author wang
 */
namespace common\models;

use Yii;
use common\components\AppModel;
use common\components\AppCurl;
use yii\helpers\Json;

class UserMessage extends AppModel
{

    /**
     * @desc 用户站内信列表
     * @param $param [email,page,size]
     * @return mixed
     */
    public function getMessageList($param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->get(['api'=>'MessageList'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * @desc 用户站内信详情
     * @param $param
     * @return mixed
     */
    public  function getMessageDetail($param)
    {
        $appCurl = new AppCurl();
        $res = $appCurl->get(['api'=>'MessageDetail'], $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }

    /**
     * @param $param
     * @param $action [delete|update]
     * @return mixed  [email,website,ids]
     */
    public function handlerMessage($action,$param)
    {
        $appCurl = new AppCurl();
        $read = [ 'api' =>'setMessageRead' ];
        $delete = [ 'api' =>'deleteMessage' ];
        $request = $action == 'delete' ? $delete : $read;
        $res = $appCurl->post($request, $param);
        $res = $appCurl->convertResError($res);
        return Json::decode($res);
    }



    
}

