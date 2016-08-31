<?php
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
namespace common\components;

use Yii;
use yii\base\Object;
use yii\base\Exception;
use yii\helpers\Json;
use yii\web\HttpException;

/**
 * Curl 类
 * @author caoxl
 */
class Curl extends Object{

    /**
     * @var string
     * 在发送请求后获取response数据.
     */
    public $response;


    /**
     * @var integer HTTP-Status Code
     * 该值为HTTP-Status状态码. 如果请求失败该值为false.
     */
    public $responseCode;


    /**
     * @var array HTTP-Status Code
     * 用户自定义option
     */
    protected $options = array();

    /**
     * @var array key => val header配置
     * 用户自定义header
     */
    protected $headers = array();


    /**
     * @var curl 默认option
     */
    protected $defaultOptions = array(
								        CURLOPT_USERAGENT      => 'TOMTOP-Curl-Agent',
								        CURLOPT_TIMEOUT        => 60,
								        CURLOPT_CONNECTTIMEOUT => 60,
								        CURLOPT_RETURNTRANSFER => true,
                                        CURLOPT_HTTPHEADER     => false,
								    );




    /**
     * 构建GET方式的URL
     *
     * @param string  $url
     * @param array $queryData 请求的数据
     *
     * @return string $url
     */
    public function buildUrl($url, $queryData = array())
    {
    	if(empty($queryData))
    	{
    		return $url;
    	}
    	$arrs = parse_url($url);
    	$newUrl = '';
    	isset($arrs['scheme']) && $arrs['scheme'] != '' && $newUrl .= $arrs['scheme'] . '://';
    	isset($arrs['user']) && isset($arrs['pass']) && $newUrl .= $arrs['user'] . ':' . $arrs['pass'] . '@';
    	isset($arrs['host']) && $arrs['host'] != '' && $newUrl .= $arrs['host'];
    	isset($arrs['port']) && $arrs['port'] != '' && $newUrl .= ':' . $arrs['port'];
    	isset($arrs['path']) && $arrs['path'] != '' && $newUrl .= $arrs['path'];
    	if(isset($arrs['query']) && $arrs['query'] != '')
    	{
    		$queryParams = explode('&', $arrs['query']);
    		foreach ($queryParams as $param) 
    		{
    			$_arr = explode('=', $param);
    			$queryData[$_arr[0]] = $_arr[1];
    		}
    	}
    	!empty($queryData) && $newUrl .= '?' . http_build_query($queryData);
    	isset($arrs['fragment']) && $arrs['fragment'] != '' && $newUrl .= '#' . $arrs['path'];
    	return $newUrl;
    }

    /**
     * GET-HTTP-Request
     *
     * @param string  $url
     * @param array $queryData 请求的参数 默认空
     *
     * @return mixed response
     */
    public function get($url, $queryData = array())
    {
    	//构建url
    	$url = $this->buildUrl($url, $queryData);
        return $this->_httpRequest('GET', $url);
    }


    /**
     * HEAD-HTTP-Request
     *
     * @param string $url
     *
     * @return mixed response
     */
    public function head($url)
    {
        return $this->_httpRequest('HEAD', $url);
    }


    /**
     * POST-HTTP-Request
     *
     * @param string  $url
     * @param array $queryData 请求的参数 默认空
     *
     * @return mixed response
     */
    public function post($url, $queryData = array())
    {
    	$this->setOption(CURLOPT_POSTFIELDS, $queryData);
        return $this->_httpRequest('POST', $url);
    }


    /**
     * PUT-HTTP-Request
     *
     * @param string  $url
     * @param array $queryData 请求的参数 默认空
     *
     * @return mixed response
     */
    public function put($url, $queryData = array())
    {
    	$this->setOption(CURLOPT_POSTFIELDS, $queryData);
        return $this->_httpRequest('PUT', $url);
    }


    /**
     * DELETE-HTTP-Request
     *
     * @param string  $url
     *
     * @return mixed response
     */
    public function delete($url)
    {
        return $this->_httpRequest('DELETE', $url);
    }

    /**
     * 批量获取header
     *
     * @param void
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * 获取单个header
     *
     * @param string $key
     *
     * @return mixed
     */
    public function getHeader($key)
    {
        return isset($this->headers[$key]) ? $this->headers[$key] : null;
    }

    /**
     * 批量设置header
     *
     * @param array $headers
     *
     * @return $this
     */
    public function setHeaders($headers)
    {
        //设置值
        foreach ((array)$headers as $key => $value) 
        {
            $this->setHeader($key, $value);
        }

        //返回本身
        return $this;
    }

    /**
     * 设置单个header
     *
     * @param string $key
     * @param mixed $value
     *
     * @return $this
     */
    public function setHeader($key, $value)
    {
        //设置值
        $this->headers[$key] = $value;

        //返回本身
        return $this;
    }

    /**
     * 设置 curl ip映射
     *
     * @param string $ip
     * @param int $port 端口号 默认80
     *
     * @return $this
     */
    public function setIp($ip, $port = 80)
    {
    	//设置值
        $this->setOption(CURLOPT_PROXY, $ip . ':' . $port);

        //返回本身
        return $this;
    }

    /**
     * 设置 curl option
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function setOption($key, $value)
    {
        //设置值
        if(in_array($key, $this->defaultOptions) && $key !== CURLOPT_WRITEFUNCTION) 
        {
            $this->defaultOptions[$key] = $value;
        } 
        else 
        {
            $this->options[$key] = $value;
        }

        //返回本身
        return $this;
    }


    /**
     * 删除指定的curl option
     *
     * @param string $key
     *
     * @return $this
     */
    public function unsetOption($key)
    {
        //删除已经存在的option
        if(isset($this->options[$key])) 
        {
            unset($this->options[$key]);
        }

        return $this;
    }


    /**
     * 删除所有用户自定义的option.
     *
     * @return $this
     */
    public function unsetOptions()
    {
        //重置所有option
        if(isset($this->options)) 
        {
            $this->options = array();
        }

        return $this;
    }


    /**
     * 重置所有option response responsecode headers.
     *
     * @return $this
     */
    public function reset()
    {
        //重置所有 options
        if(isset($this->options)) 
        {
            $this->options = array();
        }

        //重置response 和 responseCode
        $this->response = null;
        $this->responseCode = null;
        $this->headers = [];

        return $this;
    }


    /**
     * 获取指定的option
     *
     * @param string|integer $key
     * @return mixed|boolean
     */
    public function getOption($key)
    {
        //获取默认option和用户自定义option的集合
        $mergesOptions = $this->getOptions();

        //如果存在返回值 否则返回false.
        return isset($mergesOptions[$key]) ? $mergesOptions[$key] : false;
    }


    /**
     * 获取默认option和用户自定义option的集合
     *
     * @return array
     */
    public function getOptions()
    {
        $headers = [];
        foreach ((array)$this->headers as $key => $value) 
        {
            $headers[] = $key . ':' . $value;            
        }
        return $this->options + [CURLOPT_HTTPHEADER => $headers] + $this->defaultOptions;
    }


    /**
     * 发送 HTTP 请求
     *
     * @param string  $method
     * @param string  $url
     *
     * @throws Exception 如果请求失败抛出异常
     *
     * @return mixed
     */
    protected function _httpRequest($method, $url)
    {
        //设置请求类型
        $this->setOption(CURLOPT_CUSTOMREQUEST, strtoupper($method));

        //如果请求是HEAD类型 将body部分设置为no body
        if ($method === 'HEAD') 
        {
            $this->setOption(CURLOPT_NOBODY, true);
            $this->unsetOption(CURLOPT_WRITEFUNCTION);
        }

        //记录日志并开始新能调试信息
        Yii::trace('Start sending cURL-Request: '.$url.'\n', __METHOD__);
        Yii::beginProfile($method.' '.$url.'#'.md5(serialize($this->getOption(CURLOPT_POSTFIELDS))), __METHOD__);

        /**
         * 运行 curl
         */
        $curl = curl_init($url);
        curl_setopt_array($curl, $this->getOptions());
        $body = curl_exec($curl);

        //检查curl是否请求成功
        if ($body === false) 
        {
            switch (curl_errno($curl)) 
            {
                case 7:
                    $this->responseCode = 'timeout';
                    return false;
                    break;
                default:
                    throw new Exception('Sorry, request failed: ' . curl_error($curl) , curl_errno($curl));
                    break;
            }
        }

        //获取状态码和
        $this->responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $this->response = $body;

        //停止 curl
        curl_close($curl);

        //结束性能调试
        Yii::endProfile($method.' '.$url .'#'.md5(serialize($this->getOption(CURLOPT_POSTFIELDS))), __METHOD__);

        //检查 responseCode 并返回数据或者状态码
        if ($this->getOption(CURLOPT_CUSTOMREQUEST) === 'HEAD') 
        {
            return true;
        } 
        else 
        {
            return $this->response;
        }
    }
}