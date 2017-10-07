<?php
namespace app\modules\settings;

use Yii;
use app\modules\backend\models\Settings;

class Module extends \yii\base\Module
{

    public $enabled = false;

    public function init()
    {
        $settings = Settings::find()->asArray()->all();
        $hostName = $settings[0]['value'];
        $this->enabled = (bool)$settings[1]['value'];
        if (isset($_SERVER['REQUEST_URI'])) {
            $uri = Yii::$app->request->url;
            if ($hostName != null && Yii::$app->request->hostInfo != $hostName) {
                header("Location: ".$hostName.$uri, true, 301);
                exit;
            }
        }
    }
}
