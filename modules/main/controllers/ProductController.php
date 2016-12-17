<?php
namespace app\modules\main\controllers;

use Yii;
use yii\web\Controller;
use app\modules\backend\models\Product;
use app\modules\backend\models\Category;

class ProductController extends Controller{


    public function getViewPath()
    {
        return Yii::getAlias('@webroot/templates/product');
    }

    public function actionShow($id = null)
    {
        
        $id_product = (int)$id;
        $product = Product::findOne($id_product);

        if(!empty($product->meta_title)){
            $this->view->title = $product->meta_title;
        } else {
            $this->view->title = $product->name;
        }

        if(!empty($product->meta_description))
            $this->view->registerMetaTag([
                'name' => 'description',
                'content' => $product->meta_description
            ],
                'meta_description');

        if(!empty($product->meta_keywords))
            $this->view->registerMetaTag([
                'name' => 'keywords',
                'content' => $product->meta_keywords
            ],
                'meta_keywords');

        $breadCrumbs = $this->BuildBreadCrumbs($product);
        
        if($product->template && file_exists(Yii::getAlias($product->template->path)))
        {
            $content = $this->renderFile(Yii::getAlias($product->template->path),[
                'model'=>$product,
                'breadcrumb' => $breadCrumbs]);
            return $this->renderContent($content);
        }
 
        return $this->render('show',[
            'model'=>$product,
            'breadcrumb' => $breadCrumbs]);
    }

    function BuildBreadCrumbs($model)
    {
        $breadcrumbs[] = array(
            "label" => ($model->breadcrumb) ? $model->breadcrumb : $model->name,
            "url" => '/'.$model->slug
        );

        $category = $model->main;

        $breadcrumbs[] = array(
            "label" => ($category->breadcrumb) ? $category->breadcrumb : $category->name,
            "url" => '/'.$category->slug_compiled
        );

        $parent = $category->parent;
        while($parent !=0)
        {
            $parent_model = Category::findOne($parent);
            $breadcrumbs[] = array(
                "label" => ($parent_model->breadcrumb) ? $parent_model->breadcrumb : $parent_model->name,
                "url" => '/'.$parent_model->slug_compiled
            );
            $parent = $parent_model->parent;
        }

        $breadcrumbs = array_reverse($breadcrumbs);
        unset($breadcrumbs[count($breadcrumbs) - 1]['url']);

        return $breadcrumbs;
    }
}
