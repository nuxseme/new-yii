<?php
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
namespace common\components;

use yii\web\AssetBundle;

/**
 * 新架构情况下资源管理.
 * @author caoxl
 */
class AppAsset extends AssetBundle
{
    /**
     * 将asset bundle 注册到 view 上.
     * @param View $view 将要注册的view对象
     *        string $name 注册对象的名称 该名称可以是类名或者 配置文件中的名称
     *         'assetManager' => [
     *              'bundles' => [
     *                  'chicuu' => [//可以是这个名字
     *                      'class' => 'yii\web\AssetBundle',
     *                      'basePath' => '@webroot/assets',
     *                      'baseUrl' => '@web/assets',
     *                      'js' => ['js/jquery-1.9.1.min.js'],
     *                      ],
     *                  ],
     *              ], 
     * @return static the registered asset bundle instance
     */
    public static function register($view, $name = '')
    {
        return $view->registerAssetBundle($name ? $name : get_called_class());
    }

}
