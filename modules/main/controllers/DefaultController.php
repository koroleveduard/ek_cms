<?php

namespace app\modules\main\controllers;
 
use yii\web\Controller;
use app\modules\main\models\Page;
use yii\data\Pagination;
 
class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'only' => ['index'],
                'enabled' => \Yii::$app->getModule('settings')->enabled,
                'variations' => [
                    \Yii::$app->request->queryParams,
                ],
                'duration' => 60*60*24*30,
            ],
        ];
    }
 
    public function actionIndex()
    {
        $query = Page::find()->where(['status'=>1]);

        $pagination = new Pagination([
            'defaultPageSize' => 2,
            'forcePageParam' => false,
            'totalCount' => $query->count(),
        ]);

        $pages = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'pages' => $pages,
            'pagination' => $pagination,
        ]);
    }
}