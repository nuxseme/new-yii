<?php
/**
* @author hyd
* @date 2016-08-16 10:56:50
* @todo 品牌网站 个人中心  面包屑
*/

namespace common\actions\ppaccount;
use Yii;
use common\components\AppAction;

class BreadCrumbsAction extends AppAction
{
   /**
    * [run 运行]
    * @param  array  $params [description]
    *                 name    二级导航名称
    * @return [type]         [description]
    */
    public function run($params = [])
    {
       
        return $this->renderPartial(
                'ppaccount/breadCrumbs',
                ['name' => $params['name'] ]//用户基础信息
            );
    }

}
