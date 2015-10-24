<?php
namespace app\modules\main\controllers;

use yii\web\Controller;
use app\modules\main\models\Page;

class PageController extends Controller{

    public function actionShow($id = null)
    {
        $id_page = (int)$id;
        $page = Page::findOne($id_page);
        return $this->render('show',['page'=>$page]);
    }
}