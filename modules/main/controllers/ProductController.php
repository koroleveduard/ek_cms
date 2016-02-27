<?php
namespace app\modules\main\controllers;

use Yii;
use yii\web\Controller;
use app\modules\backend\models\Product;

class ProductController extends Controller{


    public function getViewPath()
    {
        return Yii::getAlias('@webroot/templates/product');
    }

    public function actionShow($id = null)
    {
        $id_product = (int)$id;
        $product = Product::findOne($id_product);
       

        
        return $this->render('show',[
            'model'=>$product]);
    }
}