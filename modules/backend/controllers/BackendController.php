<?php

namespace app\modules\backend\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;


class BackendController extends  Controller{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

}