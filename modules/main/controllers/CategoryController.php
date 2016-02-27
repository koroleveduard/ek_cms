<?php
namespace app\modules\main\controllers;

use Yii;
use yii\web\Controller;
use app\modules\backend\models\Category;

class CategoryController extends Controller{


    public function getViewPath()
    {
        return Yii::getAlias('@webroot/templates/category');
    }

    public function actionShow($id = null)
    {
        $id_category = (int)$id;
        $category = Category::findOne($id_category);
       

        
        return $this->render('show',[
            'model'=>$category]);
    }
}