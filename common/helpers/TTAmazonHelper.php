<?php
/**
 * Amazon 公用上传类
 */
namespace common\helpers;

use Yii;
use common\components\AppHelper;
use vendor\amazon\AmazonS3Upload;
use common\components\Curl;


/**
 * 公用helper类
 * @author caoxl
 */
class TTAmazonHelper extends AppHelper
{

    public static function uploadFilesToS3($file, $maxFileSize = 5242880)
    {
        $bucket 		= 'img-src.tomtop-cdn.com';
        $uploadURL 		= 'https://' . $bucket . '.s3.amazonaws.com/';
        $path 			= 'headimg/' . date('Ymd') . time() . $file['name']; // Can be empty ''
        $lifetime 		= 3600; // Period for which the parameters are valid
        $maxFileSize 	= $maxFileSize ? $maxFileSize : (1024 * 1024 * 5); // 5 M
        $maxFileSize	= $maxFileSize > 0 ? $maxFileSize : (1024 * 1024 * 5);
        $uploadTypes 	= [
            'image/jpg',
            'image/jpeg',
            'image/png',
            'image/pjpeg',
            'image/gif',
            'image/bmp',
            'image/x-png'
        ];

        if(empty($file['tmp_name']) || !is_uploaded_file($file['tmp_name']))
        {
            return  ['ret'=>0, 'msg' => '文件不存在'];

        }
        if(!in_array($file['type'], $uploadTypes))
        {
            return ['ret'=>0,'msg' => '文件类型不符!'];

        }
        if($file['size'] > $maxFileSize)
        {
            return ['ret'=>0,'msg' => '文件太大'];
        }

        $metaHeaders 	= array('uid' => 123);
        $requestHeaders = array(
            //'Content-Type' => 'application/octet-stream',
            'Content-Type' => $file['type'],
            //'Content-Disposition' => 'attachment; filename=${filename}'
        );

        //s3配置
        $awsAccessKey = Yii::$app->params['awsAccessKey'];
        $awsSecretKey = Yii::$app->params['awsSecretKey'];
        AmazonS3Upload::setAuth($awsAccessKey, $awsSecretKey);
        $params = AmazonS3Upload::getHttpUploadPostParams(
            $bucket,
            $path,
            AmazonS3Upload::ACL_PUBLIC_READ,
            $lifetime,
            $maxFileSize,
            201, // Or a URL to redirect to on success
            $metaHeaders,
            $requestHeaders,
            false // False since we're not using flash
        );
        $params 		= self::ObjectToArray($params);
        $params['file'] = curl_file_create($file["tmp_name"]);

        //curl
        $curl = new Curl();
        $data = $curl->reset();
        $data->setOption(CURLOPT_TIMEOUT, 30);
        $data->setOption(CURLOPT_SSL_VERIFYPEER, false);
        $data->setOption(CURLOPT_SSL_VERIFYHOST, false);
        $data->post($uploadURL,$params);

        if(!$data->responseCode)
        {
            return ['errorCode' => 6, 'msg' => '上传失败'];
        }

        //解析xml
        $response 	= simplexml_load_string($data->response);
        $img 		= 'http://' . $response->Bucket . '/' . $response->Key;
        return ['ret'=>1,'uploaedFile' => $img];
    }

    /**
     * @desc 对象转化为数组
     * @param $obj
     * @return array
     */
    public static function ObjectToArray($obj)
    {
        $ret = array();
        foreach ($obj as $key => $value)
        {
            if (gettype($value) == "array" || gettype($value) == "object")
            {
                $ret[$key] =  self::ObjectToArray($value);
            }
            else
            {
                $ret[$key] = $value;
            }
        }
        return $ret;
    }

}