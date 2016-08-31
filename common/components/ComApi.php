<?php
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
 namespace common\components;

 use Yii;
 use yii\base\Component;
 use yii\base\InvalidParamException;

/**
 * 请求接口的服务
 *
 * @author caoxl
 */
 class ComApi extends Component{
    /**
    *@var Cache|string 如果是Object 必须继承至 yii\caching\Cache 对象 
    *     如果是字符串则代表相应的类
    */
    public $cache = 'cache';

    /**
    *@var  int 缓存时间
    */
    public $expire = 604800;

    /**
    *@var array 各种api站点  key => val
    * 例如 $sites = array('baseApi' => array('host' => 'http://base.api.tomtop.com', 'ip' => '127.0.0.1'));
    * keys  baseApi => 站点代号(必须)
    *               host  =>  站点主机(必须)   
    *               ip    =>  站点解析IP(非必须)
    */
    public $sites = array();


    /**
    * @var array 各种API接口信息 key => val
    * 例如 $apis = array('getUserAddrs' => array('url' => '{#memberApi#}/member/v1/billaddress/{uuid}', 'ip'  => '127.0.0.1',));
    * keys getUserAddrs  =>   API接口代号(必须)
    *                   url  =>  API接口地址(必须)
    *                   ip   =>  解析的IP(非必须)  
    *
    */
    public $apis = array();

    /**
     * 解析API
     *
     * @param string $api api代号
     * @param array $params  要传给api的参数
     *
     * @throws InvalidParamException api代码不存在抛出异常
     * @return array ['url' => '网址', 'ip' => '']
     */
    public function resolveApi($api, $params)
    {
        if(!isset($this->apis[$api]) || !$this->apis[$api] || !array_key_exists('url', $this->apis[$api]) || !$this->apis[$api]['url'])
        {
            throw new InvalidParamException("Api:$api not exists!");
        }

        $url = $this->apis[$api]['url'];
        $hash = md5(json_encode(array($this->apis[$api], $this->sites)));
        $cacheKey = md5(__CLASS__ . json_encode(array($api, $params)));
        if(($data = $this->cache->get($cacheKey)) !== false && isset($data[0]['url']) && $data[0]['url'] != '' && $data[1] === $hash)
        {
            return $data[0];
        }

        $ip = false;
        $matches = $regs = $replacements = array();
        if(preg_match('/\{#(\w+)#\}/', $url, $matches))
        {//如果存在站点替换
            if(!isset($this->sites[$matches[1]]) || empty($this->sites[$matches[1]]) || !array_key_exists('host', $this->sites[$matches[1]]) || !$this->sites[$matches[1]]['host'])
            {//site不存在
                throw new InvalidParamException("Site:{$matches[1]} not exists!");
            }
            $regs[] = '/\{#' . $matches[1] . '#\}/';
            $replacements[] = $this->sites[$matches[1]]['host'];
            array_key_exists('ip', $this->sites[$matches[1]]) && $this->sites[$matches[1]]['ip'] && $ip = $this->sites[$matches[1]]['ip'];
        }
        array_key_exists('ip', $this->apis[$api]) && $this->apis[$api]['ip'] && $ip = $this->apis[$api]['ip'];

        foreach (array_keys($params) as $key) 
        {
            $regs[] = '/\{' . $key . '\}/';
            $replacements[] = $params[$key];
        }

        $url = preg_replace($regs, $replacements, $url);
        $data[0] = array('url' => $url, 'ip' => $ip);
        $data[1] = $hash;
        $this->cache->set($cacheKey, $data, $this->expire);

        return $data[0];
    }

 	/**
     * 初始化组件
    */
    public function init()
    {
        if(is_string($this->cache))
        {
            $this->cache = Yii::$app->get($this->cache, false);
        }
    }
 }