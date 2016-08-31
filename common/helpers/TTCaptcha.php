<?php

namespace common\helpers;

use Yii;
use yii\web\Response;

class TTCaptcha
{

    private $charset = 'abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ23456789'; //随机因子
    private $code;       //验证码
    private $img;        //图形资源句柄
    public $codelen = 4;     //验证码长度
    public $width = 150;     //宽度
    public $height = 38;     //高度
    public $font;        //指定的字体
    public $fontsize = 20;    //指定字体大小
    public $fontcolor;      //指定字体颜色


    //构造方法初始化
    public function __construct()
    {
        $this->createCode();
        $this->font =SYS_COMMON_PATH.'helpers/font/authcode.ttf';
    }

    //生成随机码
    private function createCode()
    {
        $_len = strlen($this->charset) - 1;
        for ($i = 0; $i < $this->codelen; $i++) {
            $this->code .= $this->charset[mt_rand(0, $_len)];
        }
    }

    //生成背景
    private function createBg()
    {
        $this->img = imagecreatetruecolor($this->width, $this->height);
        $color = imagecolorallocate($this->img, mt_rand(157, 255), mt_rand(157, 255), mt_rand(157, 255));
        imagefilledrectangle($this->img, 0, $this->height, $this->width, 0, $color);
    }

    //生成文字
    private function createFont()
    {
        $_x = $this->width / $this->codelen;
        for ($i = 0; $i < $this->codelen; $i++) {
            $this->fontcolor = imagecolorallocate($this->img, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
            imagettftext($this->img, $this->fontsize, mt_rand(-30, 30), $_x * $i + mt_rand(1, 5), $this->height / 1.4, $this->fontcolor, $this->font, $this->code[$i]);
        }
    }

    //生成线条、雪花
    private function createLine()
    {
        for ($i = 0; $i < 6; $i++) {
            $color = imagecolorallocate($this->img, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
            imageline($this->img, mt_rand(0, $this->width), mt_rand(0, $this->height), mt_rand(0, $this->width), mt_rand(0, $this->height), $color);
        }
        for ($i = 0; $i < 100; $i++) {
            $color = imagecolorallocate($this->img, mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));
            imagestring($this->img, mt_rand(1, 5), mt_rand(0, $this->width), mt_rand(0, $this->height), '*', $color);
        }
    }

    //输出
    private function outPut()
    {
        ob_start();
        imagepng($this->img);
        imagedestroy($this->img);
        return ob_get_clean();
    }

    //对外生成
    public function doimg()
    {
        $this->createBg();
        $this->createLine();
        $this->createFont();
        Yii::$app->getResponse()->getHeaders()->set('Content-type', 'image/png');
        Yii::$app->response->format = Response::FORMAT_RAW;
        return $this->outPut();
    }

    //获取验证码
    public function getCode()
    {
        return strtolower($this->code);
    }

}

?>