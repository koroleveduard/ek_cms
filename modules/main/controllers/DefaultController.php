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
 
    public function actionIndex()
    {
        $query = Page::find();

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
//        $pages = Page::find()->all();
        //return $this->render('index',['pages' => $pages]);
    }
}