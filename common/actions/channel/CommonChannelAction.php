<?php
/*
* 频道页公用部分相关action
*
*/
namespace common\actions\channel;

use Yii;
use common\components\AppAction;
use common\helpers\TTPageHelper;
use common\models\Channel;
use yii\helpers\Url;

class CommonChannelAction extends AppAction
{
    /**
    * @var array $seoMeta seo信息
    */
    public $seoMeta = [
        'title' => 'New Arrivals | Camfere.com',
        'description' => 'Shop for New Action Cameras, On Camera Flashes, Digital Camcorders, Digital Photo Frames, Tripods, Studio Equipment at Bargain Prices.',
        'keywords' => 'Shop for New Action Cameras, On Camera Flashes, Digital Camcorders, Digital Photo Frames, Tripods, Studio Equipment at Bargain Prices.'
    ];

    /**
    * @var array 频道页对应的面包屑名称
    */
    static public $channelBreadcrumbNames = [
        'topsellers/home' => 'Top Sellers',
        'topsellers' => 'Top Sellers',
        'new' => 'New Arrivals',
        'freeshipping' => 'Freeshipping',
        'deals' => 'Deals',
        'presale' => 'Presale',
        'clearance' => 'Clearance',
    ];

    /**
    * @var array 频道页对应的action的名称
    */
    static public $channelActionNames = [
        'topsellers/home' => 'topsellers',
        'topsellers' => 'topsellers-list',
        'new' => 'newarrivals',
        'freeshipping' => 'freeshipping',
        'deals' => 'deals',
        'presale' => 'presale',
        'clearance' => 'clearance',
    ];

    /**
    * @var string $channelName
    */
    public $channelName;

	/**
    * @var Channel
    */
    protected $channelModel;

    /**
    * 获得频道页的面包屑导航名称
    *
    * @param string $channelName
    * @return string $name
    */
    static public function getBreadcrumbName($channelName)
    {
        return self::$channelBreadcrumbNames[$channelName];
    }

     /**
    * 获得频道页的面包屑导航URL
    *
    * @param string $channelName
    * @return string $url
    */
    static public function getBreadcrumbUrl($channelName)
    {
        return Url::toRoute(['channel/' . self::$channelActionNames[$channelName]]);
    }

	/**
	* 获取model
	*
	* @return Channel
	*/
	protected function getChannelModel()
	{
		if($this->channelModel === null)
		{
			$this->channelModel = new Channel;
		}
		return $this->channelModel;
	}

	/**
	* 运行action
	*
	* @param array $params
	* $params['channelName']
	*
	* @return string
	*/
	public function run($params = [])
	{
		$TTHelper = Yii::$container->get('TTHelper');
		$channelName = $this->channelName;
		$params = $this->getUrlParmas();

    	//显示当前页记录条数
    	$startNumber = ($params['page'] == 1) ? 1: ($params['page'] - 1) * $params['size'];
    	$toNumber = $params['page'] * $params['size'];
    	$displayNumber = array('startNumber' => $startNumber, 'toNumber' => $toNumber);
    	$releaseDate = null;

    	//分类产品列表
    	$data = $this->getProducts($params, $channelName);

    	//根据聚合出来的产品价格进行排序
    	$yjPriceSort = array();
    	$aggsMap = $data['aggsMap'];
    	$yjPrice = $data['aggsMap']["yjPrice"];
    	if($yjPrice)
    	{ 
    		$yjPriceSort['yjPrice'] = $TTHelper->yjPriceSort($yjPrice);
    		unset($data['aggsMap']['yjPrice']);
    		$aggsMap = array_merge($data['aggsMap'], $yjPriceSort);
    	}
    	if($channelName == 'new')
    	{
    		$releaseDate = $this->getChannelModel()->newArrivalsReleaseDate();
            $releaseDate = $releaseDate['ret'] == 1 ? $releaseDate['data'] : [];
    	}
        $this->controller->seoMeta($this->seoMeta);
        return $this->controller->render(
				        					'commonChannel',
				        					[
				        							'productList'    =>   $data['products'],
				        							'pages'          =>   $data['page'],
                                                    'leftFiltering'  => $this->controller->runAppAction(
                                                                                                            'common\actions\channel\LeftFilteringAction',
                                                                                                            [
                                                                                                                [
                                                                                                                    'releaseDate' => $releaseDate,
                                                                                                                    'aggsMap'        =>   $aggsMap,
                                                                                                                ]
                                                                                                            ]
                                                                                                        ),
                                                    'rightFiltering'  => $this->controller->runAppAction(
                                                                                                            'common\actions\channel\RightFilteringAction',
                                                                                                            [
                                                                                                                [
                                                                                                                    'displayNumber'  =>   $displayNumber,
                                                                                                                    'pages'          =>   $data['page'],
                                                                                                                    'breadcrumbName' => self::getBreadcrumbName($channelName),
                                                                                                                    'breadcrumbUrl' => self::getBreadcrumbUrl($channelName),
                                                                                                                ]
                                                                                                            ]
                                                                                                        ),
				        					]
			        					);
	}

	/**
     * 返回频道页查询结果集
     */
    public function getProducts($params, $channelName)
    {
    	$model = $this->getChannelModel();
    	$products = [];
    	$re = $model->getChannelProducts($params, $channelName);
    	$pages = null;
    	$aggsMap = [];
    	if($re['ret'] == 1)
    	{
    		$products = $re['data']['pblist'];
    		$aggsMap = $re['data']['aggsMap'];
    		$pages = new TTPageHelper($re['data']['page']['totalRecord'], $params['size'], $params['page']);
    		return ['products' => $products, 'page' => $pages, 'aggsMap' => $aggsMap];
    	}
    	return false;
    }

	/**
     * 获取URL查询参数
     *
     * @return array
     */
    public function getUrlParmas()
    { 
    	$params = array();
    	$params['cpath']     		= Yii::$app->request->get("cpath");
    	$params['page'] = intval(Yii::$app->request->get("p"));
		$params['page'] < 1 && $params['page'] = 1;
    	$params['size']      		= 40;
    	$params['sort']      		= Yii::$app->request->get("sort");
    	$params['releaseTime']   	= Yii::$app->request->get("releaseTime");
    	$params['tagName']   		= Yii::$app->request->get("tagname");
    	$params['brand']     		= Yii::$app->request->get("brand");
    	$params['depotName'] 		= Yii::$app->request->get("depotname");
    	$params['yjPrice']   		= Yii::$app->request->get("yjprice");
    	$params['type']      		= urlencode(Yii::$app->request->get("type"));
    	return $params;
    }
}