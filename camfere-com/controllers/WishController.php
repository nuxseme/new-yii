<?php
namespace app\controllers;

use Yii;
use common\helpers\TTPageHelper;
use common\models\UserWish;

/**
 * Class AccountController
 * @desc 用户收藏控制器
 * @package app\controllers
 */
class WishController extends BaseController
{
    /**
     * @var UserWish
     */
    private $_model = null;
    private $_email = null;
    public $enableCsrfValidation = false;

    public function init()
    {
        parent::init();
        $this->_model = Yii::createObject('common\models\UserWish');
        $this->_email = $this->isLogin();
    }

    public function beforeAction($action)
    {
        if (!$this->_email)
        {
            $this->redirectLogin();
        }
        $this->setAccountSeo();
        return parent::beforeAction($action);
    }
    
    /**
     * @desc 收藏列表
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $page = $request->get('p', Yii::$app->params['page']);
        $categoryId = intval($request->get("categoryId"));
        $categoryId = ($categoryId > 0) ? $request->get("categoryId") : 0;
        $productKey = urlencode(trim($request->get("productKey")));
        $sort = $request->get("sort");
        $params = array(
            'email' => $this->_email,
            'categoryId' => $categoryId,
            'sort' => $sort,
            'productKey' => $productKey,
            'page' => $page,
            'size' => Yii::$app->params['pageSize']
        );
        $res = $this->_model->getProCollectList($params);
        $collectList = $res['data'];
        $pages = new TTPageHelper($res['page']['totalRecord'], $res['page']['pageSize'], $page);
        $categories = Yii::createObject('common\models\Category')->getCategories()['data'];

        return $this->render('index',[
            'collectList' => $collectList,
            'page'        => $pages,
            'categories'  => $categories,
        ]);
    }

    /**
     * @desc 删除
     * @return string
     */
    public function actionDelete()
    {
        $listingIds = \Yii::$app->request->post();
        $delIds = array();
        if(!empty($listingIds)){ 
            if(!strstr($listingIds['dataId'],',')){
                $delIds = array($listingIds['dataId']);
            }else{
                $delIds = explode(',',substr($listingIds['dataId'],0,-1));
            }
        }
        $params = array();
        foreach ($delIds as $key => $value){ 
            $params[] = $value;
        }
        $delIds = '';
        foreach ($params as $key => $value) {
            $delIds .=  $value.',';
        }
        $delIds =  substr($delIds,0,-1);
        $param = [
            'email' => $this->_email,
            'website'   => Yii::$app->params['website'],
            'ids'       => $delIds
        ];

        $res = $this->_model->delete($param);
         return  $this->resAjax($res);
    }

}
