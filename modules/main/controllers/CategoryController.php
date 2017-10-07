<?php
namespace app\modules\main\controllers;

use Yii;
use yii\web\Controller;
use app\modules\backend\models\Category;
use yii\data\Pagination;
use \yii\web\NotFoundHttpException;

class CategoryController extends Controller
{
    public function getViewPath()
    {
        return Yii::getAlias('@webroot/templates/category');
    }

    public function actionShow($id = null)
    {
        $id_category = (int)$id;
        $category = Category::findOne($id_category);
        if ($category === null) {
            throw new NotFoundHttpException("Category Not Found", 1);
        }
        $query_products = $category->getProducts();

        $pagination = new Pagination([
            'defaultPageSize' => 6,
            'forcePageParam' => false,
            'totalCount' => $query_products->count(),
        ]);

        $products = $query_products
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        


        if (!empty($category->meta_title)) {
            $this->view->title = $category->meta_title;
        } else {
            $this->view->title = $category->name;
        }

        if (!empty($category->meta_description)) {
            $this->view->registerMetaTag(
                [
                    'name' => 'description',
                    'content' => $category->meta_description
                ],
                'meta_description'
            );
        }

        if (!empty($category->meta_keywords)) {
            $this->view->registerMetaTag(
                [
                    'name' => 'keywords',
                    'content' => $category->meta_keywords
                ],
                'meta_keywords'
            );
        }

        $breadCrumbs = $this->buildBreadCrumbs($category);
       
        return $this->render(
            'show',
            [
                'model'=>$category,
                'products' => $products,
                'pagination' => $pagination,
                'breadcrubms' => $breadCrumbs
            ]
        );
    }

    public function buildBreadCrumbs($model)
    {
        $breadcrumbs[] = array(
            "label" => ($model->breadcrumb) ? $model->breadcrumb : $model->name,
            "url" => '/'.$model->slug_compiled
        );
        
        $parent = $model->parent;
        while ($parent !=0) {
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
