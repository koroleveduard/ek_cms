<?php

namespace app\modules\backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use app\modules\backend\models\Settings;


class SettingsController extends BackendController
{

    public function behaviors()
    {
        $behaviors_array = [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];

        $parent_behaviors = parent::behaviors();
        return yii\helpers\ArrayHelper::merge(
            $behaviors_array,
            $parent_behaviors

        );
    }


    public function actionIndex()
    {
        $settings = Settings::find()->all();
        if(Yii::$app->request->post())
        {
            if(!array_key_exists('enable_cache', Yii::$app->request->post()['Settings']))
            {
                $curSettings = Settings::findOne(['name'=>'enable_cache']);
                $curSettings->value = "0";
                $curSettings->save();
                unset($curSettings);
            }

            foreach(Yii::$app->request->post()['Settings'] as $settingName => $settingValue)
            {
                $curSettings = Settings::findOne(['name'=>$settingName]);
                $curSettings->value = $settingValue;
                $curSettings->save();
                unset($curSettings);
            }
            return $this->redirect(['index']);
        }
        return $this->render('index',['settings' => $settings]);
    }
}
