<?php
namespace app\modules\main\controllers;

use Yii;
use yii\web\Controller;
use app\modules\main\models\Page;

class PageController extends Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'only' => ['show'],
                'variations' => [
                    \Yii::$app->request->queryParams,
                ],
                'duration' => 60*60*24*30,
            ],
        ];
    }

    public function getViewPath()
    {
        return Yii::getAlias('@webroot/templates/page');
    }

    public function actionShow($id = null)
    {
        $id_page = (int)$id;
        $page = Page::findOne($id_page);
        if ($page === null) {
            throw new NotFoundHttpException("Page Not Found", 1);
        }

        if (!empty($page->meta_title)) {
            $this->view->title = $page->meta_title;
        } else {
            $this->view->title = $page->title;
        }

        if (!empty($page->meta_description)) {
            $this->view->registerMetaTag(
                [
                    'name' => 'description',
                    'content' => $page->meta_description
                ],
                'meta_description'
            );
        }

        if (!empty($page->meta_keywords)) {
            $this->view->registerMetaTag(
                [
                   'name' => 'keywords',
                   'content' => $page->meta_keywords
                ],
                'meta_keywords'
            );
        }

        $breadCrumbs = $this->buildBreadCrumbs($page);

        if ($page->template && file_exists(Yii::getAlias($page->template->path))) {
            $content = $this->renderFile(
                Yii::getAlias($page->template->path),
                [
                    'page'=>$page,
                    'breadcrubms' => $breadCrumbs]
            );
            return $this->renderContent($content);
        }

        
        return $this->render('show', [
            'page'=>$page,
            'breadcrubms' => $breadCrumbs]);
    }

    public function buildBreadCrumbs($model)
    {


        $breadcrumbs[] = array(
            "label" => ($model->breadcrumb) ? $model->breadcrumb : $model->title,
            "url" => '/'.$model->slug_compiled
        );
        $parent = $model->parent;
        while ($parent !== null) {
            $breadcrumbs[] = array(
                "label" => ($parent->breadcrumb) ? $parent->breadcrumb : $parent->title,
                "url" => '/'.$parent->slug_compiled
            );
            $parent = $parent->parent;
        }

        $breadcrumbs = array_reverse($breadcrumbs);
        unset($breadcrumbs[count($breadcrumbs) - 1]['url']);

        return $breadcrumbs;
    }
}
