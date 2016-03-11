<?php

namespace app\modules\backend\controllers;

use Yii;
use app\modules\backend\models\Page;
use app\modules\backend\models\Templates;
use app\modules\backend\models\PageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends BackendController
{
    public function behaviors()
    {
        $behaviors_array = [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];

        $parent_behaviors = parent::behaviors();
        return yii\helpers\ArrayHelper::merge(
            $behaviors_array,
            $parent_behaviors

        );
    }

    /**
     * Lists all Page models.
     * @return mixed
     */

    public function actionIndex()
    {
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Page model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Page();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->request->post()['save']))
                return $this->redirect(['update', 'id' => $model->id]);
            if(isset(Yii::$app->request->post()['save-and-back']))
                return $this->redirect(['index']);
            if(isset(Yii::$app->request->post()['save-and-add']))
                return $this->redirect(['create']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model->created)
            $model->created = date('d-m-Y',$model->created);
        else
            $model->created = date('d-m-Y');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->request->post()['save']))
                return $this->redirect(['update', 'id' => $model->id]);
            if(isset(Yii::$app->request->post()['save-and-back']))
                return $this->redirect(['index']);
            if(isset(Yii::$app->request->post()['save-and-add']))
                return $this->redirect(['create']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Page model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
