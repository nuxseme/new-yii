<?php
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
namespace common\components;

use Yii;
use yii\helpers\Json;
use yii\base\InvalidParamException;
use yii\base\InvalidCallException;

/**
 * AppCurl 类
 * 使用该类必须启用reqApi 服务
 * @author caoxl
 */
class AppCurl extends Curl{
    /**
    * @var CONVERT_TO_JSON  转换为JSON类型的错误
    */
    const CONVERT_TO_JSON = 'json';

    /**
    * @var CONVERT_TO_HTML  转换为HTML类型的错误
    */
    const CONVERT_TO_HTML = 'html';

    /**
    * @var CONVERT_TO_XML  转换为XML类型的错误
    */
    const CONVERT_TO_XML = 'xml';

    /**
    * 将响应结果转换为标准形式
    * @param string $res 相应结果
    * @param string $toType 转换成的类型
    *               类型有 HTML JSON XML JAVASCRIPT
    * @return mixed 返回转换后的错误结果
    * @throws InvalidParamException|InvalidCallException  非法的目标类型或者转换函数不存在
    */
    public function convertResError($res, $toType = AppCurl::CONVERT_TO_JSON)
    {
        $toTypes = [self::CONVERT_TO_JSON, self::CONVERT_TO_HTML, self::CONVERT_TO_XML];
        if(!in_array($toType, $toTypes))
        {
            throw new InvalidParamException("Unknow convert type:$toType");
        }
        //函数名 如 convertErrorToJson convertErrorToHtml convertErrorToXml
        $funcName = 'convertErrorTo' . ucwords($toType);
        if(!method_exists($this, $funcName))
        {
            throw new InvalidCallException("Call an undefined convert function:$funcName");
        }
        return call_user_func_array([$this, $funcName], [$res]);
    }

    /**
    * 将错误转换为JSON类型
    * @param string $res 相应结果
    *
    * @return mixed 返回转换后的错误结果
    */
    protected function convertErrorToJson($res)
    {
        if($this->responseCode != 200)
        {
            $res = Json::encode(['ret' => -1, 'data' => '', 'msg' => $res]);
        }
        return $res;
    }

    /**
     * 添加默认参数
     *
     * @param array  $params
     *
     * @return array $params
     */
    public function asignDefaultParams($params)
    {
        $TTHelper = Yii::$container->get('TTHelper');
        $default = [
            'currency' => $TTHelper->getCookie('TT_CURR', 'USD'),
            'lang' => $TTHelper->getLangId($TTHelper->getCookie('PLAY_LANG', 'en')),
            'client' => Yii::$app->params['client'],
            'website' => Yii::$app->params['website'],
        ];

        return array_merge($default, $params);
    }

    /**
     * GET-HTTP-Request
     *
     * @param array  $api   [
     *                          'api' => '代号', 
     *                          'params' => ['api所需要的数据'], 
     *                          'useDefaultParams' => ['boolean 是否使用默认参数']
     *                      ]
     *
     * @param array $queryData 请求的参数 默认空
     *
     * @return mixed response
     * @throws InvalidParamException 如果参数错误 抛出异常
     */
    public function get($api, $queryData = array())
    {
        //构建url
        !isset($api['useDefaultParams']) && $api['useDefaultParams'] = true;
        $api['useDefaultParams'] && $queryData = $this->asignDefaultParams($queryData);
        $url = $this->buildUrl($this->resolveApi($api), $queryData);
        return $this->_httpRequest('GET', $url);
    }

    /**
     * HEAD-HTTP-Request
     *
     * @param array  $api   ['api' => '代号', 'params' => ['api所需要的数据']]
     *
     * @return mixed response
     */
    public function head($api)
    {
    	$url = $this->resolveApi($api);
        return $this->_httpRequest('HEAD', $url);
    }


    /**
     * POST-HTTP-Request
     *
     * @param array  $api   ['api' => '代号', 'params' => ['api所需要的数据']]
     * @param mixed $queryData 请求的参数 默认空  可以是数组或者字符串(传json便是字符串)
     * @param boolean $jsonEncode 数据以JSON格式请求
     *
     * @return mixed response
     */
    public function post($api, $queryData = '', $jsonEncode = true)
    {
    	$url = $this->resolveApi($api);
        if ($jsonEncode == true)
        {
            $queryData = is_array($queryData) ? json_encode($queryData) : $queryData;
            $header = [
                'Content-Type' => 'application/json',
                'Content-Length' => strlen($queryData)
            ];
            $this->setHeaders($header);
        }
    	$this->setOption(CURLOPT_POSTFIELDS, $queryData);
        return $this->_httpRequest('POST', $url);
    }


    /**
     * PUT-HTTP-Request
     *
     * @param array  $api   ['api' => '代号', 'params' => ['api所需要的数据']]
     * @param mixed $queryData 请求的参数 默认空  可以是数组或者字符串(传json便是字符串)
     * @param boolean $jsonEncode 数据以JSON格式请求
     *
     * @return mixed response
     */
    public function put($api, $queryData = '', $jsonEncode = true)
    {
    	$url = $this->resolveApi($api);
        if ($jsonEncode == true)
        {
            $queryData = is_array($queryData) ? json_encode($queryData) : $queryData;
            $header = [
                'Content-Type' => 'application/json',
                'Content-Length' => strlen($queryData)
            ];
            $this->setHeaders($header);
        }
        $this->setOption(CURLOPT_POSTFIELDS, $queryData);
        return $this->_httpRequest('PUT', $url);
    }


    /**
     * DELETE-HTTP-Request
     *
     * @param array  $api   ['api' => '代号', 'params' => ['api所需要的数据']]
     * @param boolean $raw 如果响应主体中包含JSON 则需要进行转码
     *
     * @return mixed response
     */
    public function delete($api, $raw = true)
    {
    	$url = $this->resolveApi($api);
        return $this->_httpRequest('DELETE', $url);
    }

    /**
     * 解析API
     *
     * @param array $api 必须包含 'api' 'params' 两个元素  分别代表API的URL及URL中的参数
     *
     * @see ComApi::resolveApi
     * @throws InvalidParamException api代码不存在抛出异常
     * @return string $url 返回解析后的URL
     */
    public function resolveApi($api)
    {
        !isset($api['params']) && $api['params'] = array();
        $info = Yii::$app->reqApi->resolveApi($api['api'], $api['params']);
        if(isset($info['ip']) && $info['ip'] !== false)
        {
            $urlArrs = parse_url($info['url']);
            $port = (isset($urlArrs['port']) && !empty($urlArrs['port'])) ? $urlArrs['port'] : 80;
            $this->setIp($info['ip'], $port);
        }
        return $info['url'];
    }
}