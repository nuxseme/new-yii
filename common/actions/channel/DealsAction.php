<?php
/*
* 频道页deals相关action
*
*/
namespace common\actions\channel;

use Yii;
use common\components\AppAction;
use common\models\Channel;
use common\helpers\TTPageHelper;

class DealsAction extends AppAction
{
	/**
    * @var array $seoMeta seo信息
    */
    public $seoMeta = [
        'title' => '',
        'description' => '',
        'keywords' => ''
    ];

	/**
	* @var Channel
	*/
	protected $channelModel;

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
	* $params['channelModel']
	*
	* @return string
	*/
	public function run($params = [])
	{
		$params = array();
    	$params['cpath'] = Yii::$app->request->get('cpath');
    	$params['sort'] = 'newest';
    	!empty(Yii::$app->request->get('sort')) && $params['sort'] = Yii::$app->request->get('sort');
		$params['page'] = intval(Yii::$app->request->get('p'));
		$params['page'] < 1 && $params['page'] = 1;
		$params['size'] = 40;

		$lists = [];
		$pages = null;
		$dealsCategory = [];
		$channelModel = $this->getChannelModel();
		$products = $channelModel->getChannelProducts($params, 'deals');
		// print_r($products);

		$serverTime = (new \common\models\System)->getSystemTime();
        $serverTime = $serverTime['ret'] == 1 ? $serverTime['data'] : date('Y-m-d H:i:s');
		
		if($products['ret'] == 1)
		{
			$lists = $products['data'];
			$pages = new TTPageHelper($lists['page']['totalRecord'], $params['size'], $params['page']);
		}
		$this->controller->seoMeta($this->seoMeta);
		return $this->controller->render(
											'deals',
											[
												'serverTime' => $serverTime,
												'productList' => $lists['pblist'],
												'pages' => $pages,
												'dealsCategory' => $this->controller->runAppAction('common\actions\channel\DealsCateAction', [['channelModel' => $channelModel]])
											]
										);
	}
}