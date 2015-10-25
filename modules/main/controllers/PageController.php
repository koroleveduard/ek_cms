<?php
namespace app\modules\main\controllers;

use yii\web\Controller;
use app\modules\main\models\Page;

class PageController extends Controller{

    public function actionShow($id = null)
    {
        $id_page = (int)$id;
        $page = Page::findOne($id_page);
        if(!empty($page->meta_title))
            $this->view->title = $page->meta_title;
        else
            $this->view->title = $page->title;
        if(!empty($page->meta_description))
            $this->view->registerMetaTag([
                'name' => 'description',
                'content' => $page->meta_description
            ],
                'meta_description');

        if(!empty($page->meta_keywords))
            $this->view->registerMetaTag([
                'name' => 'keywords',
                'content' => $page->meta_keywords
            ],
                'meta_keywords');

        $breadCrumbs = $this->BuildBreadCrumbs($page);

        return $this->render('show',[
            'page'=>$page,
            'breadcrubms' => $breadCrumbs]);
    }

    public function BuildBreadCrumbs($model)
    {


        $breadcrumbs[] = array(
            "label" => $model->title,
            "url" => '/'.$model->slug_compiled
        );
        $parent = $model->parent;
        while($parent !=0)
        {
            $parent_model = Page::findOne($parent);
            $breadcrumbs[] = array(
                "label" => $parent_model->title,
                "url" => '/'.$parent_model->slug_compiled
            );
            $parent = $parent_model->parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        unset($breadcrumbs[count($breadcrumbs) - 1]['url']);
        print_r($breadcrumbs);

        return $breadcrumbs;
    }
}