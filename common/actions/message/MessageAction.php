<?php

namespace common\actions\message;

use common\models\UserMessage;
use Yii;
use common\components\AppAction;
use common\helpers\TTPageHelper;

class MessageAction extends AppAction
{
    /**
     * @param $params
     * @param $model UserMessage
     * @return string
     */
    public function run($params,$model)
    {
        $result = $model->getMessageList($params);
        $list = $result['ret'] == 1 ? $result['data']['list'] : [];
        $pages = new TTPageHelper($result['total'], $result['recordPerPage'],$params['pages']);
        $data['pages'] = $pages->showpage();
        
        return $this->renderPartial('message/message',[
            'list' => $list,
            'pages' =>$data['pages'],
        ]);
    }

}
