<?php
/*
* 设置语言的action
*
*/
namespace common\actions;

use Yii;
use common\components\AppAction;

class LangAction extends AppAction{

	/**
     * 获取和设置货币的动作
     * @param void
     * @return array 
     */
    public function run()
    {
        $TTHelper = Yii::$container->get('TTHelper');

    	 //根据ip判断国家
        $cookies = Yii::$app->request->cookies;//获取cookie

        //设置语言
        $cookieLang = $TTHelper->getCookie('PLAY_LANG');
        $cookieLang === null && $cookieLang = '';
        $reqLang = Yii::$container->get('LangModel')->getReqLang()['data'];
        if ($reqLang != $cookieLang) 
        {
            $webDefaultLang = Yii::$app->params['webDefaultLang'];
            $playLang = (in_array($reqLang,$webDefaultLang)) ? $reqLang : 'en';
            $TTHelper->setCookie('PLAY_LANG', $playLang);
        }

        $lang = $reqLang;

        //设置语言id
        $cookieTTlang = $TTHelper->getCookie('TT_LANG');
        $cookieTTlang === null && $cookieTTlang = '';
        $langList = Yii::$container->get('LangModel')->getLangList();
        $langList = $langList['data'];
        $ttLang = 1;
        foreach((array)$langList as $key => $value)
        {
            if($value['code'] == $lang)
            {
                $ttLang = $value['id'];
                break;
            }
        }
        if ($cookieTTlang != $ttLang || !$cookieTTlang) 
        {
            $TTHelper->setCookie('TT_LANG', $ttLang);
        }

        return $lang;
    }
}
