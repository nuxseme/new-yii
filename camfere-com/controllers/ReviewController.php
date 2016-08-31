<?php
namespace app\controllers;

use common\actions\detail\StorageAction;
use common\models\UserReview;
use Yii;
use common\helpers\TTPageHelper;
use yii\helpers\Url;

/**
 * Class AccountController
 * @desc 用户收藏控制器
 * @package app\controllers
 */
class ReviewController extends BaseController
{
    /**
     * @var TThelper $TTHelper
     */
    protected $TTHelper;

    /**
     * @var UserReview
     */
    private $_model;

    /**
     * @var Product 商品模型
     */
    private $_productModel;

    /**
     * @var string $_email 用户email
     */
    private $_email;

    public function init()
    {
        parent::init();
        $this->enableCsrfValidation=false;
        $this->_model = Yii::createObject('common\models\UserReview');
        $this->_email = $this->isLogin();
        $this->TTHelper = Yii::$container->get('TTHelper');
        $this->_productModel = Yii::$container->get('ProductModel');
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
     * @desc 评论列表
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $page = $request->get('p', Yii::$app->params['page']);
        $status = ($request->get("status") == '') ? '-1' : $request->get("status");
        $dateType = ($request->get("dateType") == '') ? 0 : $request->get("dateType");
        $uuid = $this->getUuid();
        $params = array(
            'email' => $this->_email,
            'uuid' => $uuid,
            'status' => $status,
            'dateType' => $dateType,
            'page' => $page,
            'limit' => Yii::$app->params['pageSize']
        );

        $res = $this->_model->getReviewList($params);
        //评论统计
        $reviewStatus = $this->_model->reviewStatus(['uuid' => $uuid, 'email' => $this->_email])['data'];
        $reviewStatus = array_column($reviewStatus,'count','types');

        //用户基本信息
        $userParam = ['email' => $this->_email,'uuid'=>$uuid];
        $userBasicInfo = Yii::createObject('common\models\Account')->getUserBasicInfo($userParam)['data'];

        $pages = new TTPageHelper($res['page']['totalRecord'], $res['page']['pageSize'], $page);
        $reviewList = $res['data'];
        return $this->render('index', [
            'reviewList' => $reviewList,
            'page' => $pages,
            'reviewStatistical' => $reviewStatus,
            'accountBaseInfo' => $userBasicInfo,
        ]);
    }
    
    /**
     * @desc 获取单条评论详情
     */
    public function actionReviewdetail(){
        $this->layout = false;//不调用布局
        $param = [
            'email' => $this->_email,
            'uuid'  => $this->getUuid(),
            'iid'   => Yii::$app->request->get('reviewId'),
        ];
        $res = $this->_model->getReviewInfo($param);
        $detail = $res['ret'] == 1 ? $res['data'] : [];
        return $this->render('_ajax_review',['reviewdetail' => $detail,
                                            ]);
    }

    /**
     * @desc 写评论
     */
    public function actionWrite(){
        //上传评论图片
        $upFiles = isset($_FILES['files']) ? $_FILES['files'] : '';
        $files = array();
        if (!empty($upFiles)) 
        {
            $tmp = array();
            foreach ($upFiles['name'] as $key => $value) 
            {
                if (!$upFiles['error'][$key]) 
                {
                    $tmp = [
                        'name'      => $upFiles['name'][$key],
                        'type'      => $upFiles['type'][$key],
                        'tmp_name'  => $upFiles['tmp_name'][$key],
                        'error'     => $upFiles['error'][$key],
                        'size'      => $upFiles['size'][$key]
                    ];
                    $ret = $this->TTHelper->uploadFile($tmp);
                    if (!$ret['ret']) 
                    {
                        $files['files' . $key] = curl_file_create(getcwd() . $ret['data']['uploaedFile']);
                    }
                }
            }
        }

        //获取评论信息
        $post = Yii::$app->request->post();
        $params = [
            'comment'                   => $post['ccomment'],//评论内容
            'listingId'                 => $post['listingId'],//产品流水ID
            'ps'                        => $post['ipriceStarWidth'],//价格评分
            'qs'                        => $post['iqualityStarWidth'],//质量评分
            'ss'                        => $post['ishippingStarWidth'],//物流评分
            'foverallratingStarWidth'   => $post['foverallratingStarWidth'],//综合评级
            'us'                        => $post['iusefulness'],//有用评级
            'videoTitle'                => $post['videoTitle'],//视频标题，不是必填
            'videoUrl'                  => $post['commentVideoUrl'],//视频url ，不是必填
            'sku'                       => $post['sku'],//csku
            'oid'                       => $post['oid'],//订单ID
            'email'                     => $this->_email,//会员邮箱
            'website'                   => Yii::$app->params['website'],//站点Id
            'countryName'               => '',//国家名字简称
            'pform'                     => 'chicuu',//来源
        ];
        if (isset($post['commentid']) && $post['commentid']) 
        {
            $params['commentId'] = $post['commentid'];//评论编号
            $params['uuid'] = $_COOKIE['TT_UUID'];//uuid
            $params['imageUrls'] = isset($post['existPic']) ? implode($post['existPic'], ',') : '';
        }
        $params = array_merge($files, $params);
        $res = $this->_model->write($params);//var_dump($result);exit();

        if(isset($post['source']) && $post['source'] == 'add'){
//        if ($res['ret'] == 1)
//        {
//            $this->redirect(['review/index']);
//        } else
//        {
//            #err hendler
//        }
            $this->redirect(Url::toRoute(['review/productreviews','listingId'=>$post['listingId'],'p'=>Yii::$app->request->get("p")])) ;
        }else{
            $this->redirect(Url::toRoute(['review/index','dateType'=>Yii::$app->request->get("dateType"),'status'=>Yii::$app->request->get("status"),'p'=>Yii::$app->request->get("p")]) );
        }
    }


    /**
     * 获取商品的评论列表
     */
    public function actionProductreviews()
    {
        $request = Yii::$app->request;
        $listingId = $request->get('listingId');
        $pageSize = 10;
        if($listingId) 
        {
            $page = $request->get('page',1);
            $data = $this->_getProReviewTotal($listingId);
            $params = ['listingId'=>$listingId, 'page'=>$page, 'size'=>$pageSize];
            $result = Yii::createObject('common\models\Review')->getProductReviews($params);
            $data['reviewList'] = $result['ret'] == 1 ? $result['data'] : [];
            $pages = new TTPageHelper( $result['page']['totalRecord'], $pageSize, $page); 
            $data['page'] = $pages;
            return $this->render('list_review',$data);
        }
    }

    /**
     * 添加评论
     *
     */
    public function actionAddreview()
    { 
        $listingId = Yii::$app->request->get('listingId');
        $data = $this->_getProReviewTotal($listingId);
        return $this->render('add_review',$data);
    }

    /**
     * 获取评分统计
     *
     * @param string $listingId
     * @return array $data
     */
    private function _getProReviewTotal($listingId)
    {
        $product = $this->_productModel->getProductDetails($listingId);

        $product = $product['ret'] == 1 ? $product['data'] : [];
        $data =array();
        if (!empty($product)) 
        {
            $basic = $product['pdbList'][0];

            $storageAction = $this->createAppAction('common\actions\detail\StorageAction');

           $house = $storageAction->getDefaultWhouse($listingId,$basic['whouse']);

            $data['basic'] = [
                'listingId' => $basic['listingId'],
                'sku'       => $basic['sku'],
                'title'     => $basic['title'],
                'nowprice'  => $house['nowprice'],
                'origprice' => $house['origprice'],
                'symbol'        => $basic['whouse']['CN']['symbol'],
                'star_count'    => $product['count'],
                'star_start'    => $product['start']
            ];

            $imgList = $basic['imgList'];
            $defaultImg = '';
            foreach ($imgList as $key => $value) 
            {
                $defaultImg || $defaultImg = $this->TTHelper->getThumbnailUrl('product', $value['imgUrl'], Yii::$app->params['productListImgWidth'], Yii::$app->params['productListImgHeight']);
                if ($value['isMain']) 
                {
                    $defaultImg = $this->TTHelper->getThumbnailUrl('product', $value['imgUrl'], Yii::$app->params['productListImgWidth'], Yii::$app->params['productListImgHeight']);
                    break;
                }
            }
            $data['basic']['defaultImg'] = $defaultImg;
            $data['basic']['url'] = $this->TTHelper->getProductUrl($basic['url']);
            //获取评分
            $stars = $this->_productModel->getProductReviews($listingId);
            $stars = $stars['ret'] == 1 ? $stars['data'] : [];
            $data['basic']['stars'] = empty($stars[0]) ? array() : $stars[0];
            $starTotal = !empty($product['rsnbo']['startNum']) ? $product['rsnbo']['startNum'] : array();
            $tmp = array();
            $flag = false;
            for ($i = 5; $i >= 1 ; $i--) 
            { 
                foreach ($starTotal as $key2 => $value2) 
                {
                    if ($value2['startNum'] == $i) 
                    {
                        $flag = true;
                        $tmp[] = ['startNum' => $value2['startNum'], 'ptage' => $value2['ptage']];
                        continue;
                    }
                }
                if(!$flag)
                {
                    $tmp[] = ['startNum' => $i, 'ptage' => 0];
                }
                $flag = false;
            }
            $data['basic']['starTotal'] = $tmp;
            $data['reviewCount'] = intval($basic['rsnbo']['count']);

            //获取邮箱
            $email = $this->isLogin();
            $data['basic']['email'] = ($email !== false) ? $email : '';
        }
        return $data;
    }
}
