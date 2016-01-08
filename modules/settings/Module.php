<?php
namespace app\modules\settings;

use Yii;
use app\modules\backend\models\Settings;

class Module extends \yii\base\Module
{

    public function init()
    {
    	$settings = Settings::find()->asArray()->all();
    	$hostName = $settings[0]['value'];
    	$uri = Yii::$app->request->url;
    	if(Yii::$app->request->hostInfo != $hostName)
    	{
    		header("Location: ".$hostName.$uri,true,301);
    		exit;
    	}
    }
}
