<?php

namespace common\actions\address;

use Yii;
use common\components\AppAction;
use common\helpers\TTPageHelper;
use common\models\UserAddress;

class AddressAction extends AppAction
{

    /**
     * @param $params
     * @param $model UserAddress
     * @param $addressOption
     * @return string
     */
    public function run($params,$addressOption,$model)
    {
        $res = $model->getAddressList($params);
        $addressList = $res['data'];
        $pages = new TTPageHelper($res['page']['totalRecord'], $res['pageSize'],$params['page']);

        return $this->renderPartial('address/addressList',[
            'addressOption' => $addressOption,
            'addressList' 	=> $addressList,
            'page'        	=> $pages,
        ]);
    }

}
