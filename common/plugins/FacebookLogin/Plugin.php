<?php
namespace plugins\facebookLogin;

use Yii;
use common\components\PluginModule;
use common\components\PluginApp;

class Plugin extends PluginModule
{
    public $layout = 'main';

    public function init()
    {
        parent::init();
    }

    public static $name = 'FacebookLogin';
    public static $author = 'wang';
    public static $version = 'v1.0.0';
    public static $date = '2016-07-12';

    public static function events()
    {
        return [
            [
                'name' => self::E_THIRD_LOGIN,
                'handler' => [new PluginApp('/pluginFacebookLogin/login/index'), 'runAction'],
                //'data' => array(),
            ],
        ];
    }
}