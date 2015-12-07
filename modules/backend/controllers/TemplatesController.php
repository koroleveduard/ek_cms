<?php

namespace app\modules\backend\controllers;

use Yii;
use app\modules\backend\models\Templates;
use app\modules\backend\models\TemplatesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * PageController implements the CRUD actions for Page model.
 */
class TemplatesController extends BackendController
{
	protected function getTree($path = '', $level = 0)
    {
        // if (is_null($this->view->theme) || !file_exists($this->view->theme->getBaseUrl())) {
        //     return [];
        // }
        $result = [];
        $basePath = Yii::getAlias('@webroot/templates');
        $dir = new \DirectoryIterator($basePath . $path);
        /** @var \DirectoryIterator $file */
        foreach ($dir as $file) {
            if ($file->isDot()) {
                continue;
            }
            $id = '#' . preg_replace('#[^\w\d]#', '_', $file->getFilename()) . "_lev{$level}";
            if ($file->isDir()) {
                $result[] = [
                    'id' => $id,
                    'children' => $this->getTree($path . DIRECTORY_SEPARATOR . $file->getBasename(), $level + 1),
                    'text' => $file->getBasename(),
                    'type' => 'dir',
                ];
            } elseif ($file->isFile() && 'php' === $file->getExtension()) {
                $result[] = [
                    'id' => $id,
                    'text' => $file->getBasename(),
                    'a_attr' => [
                        'data-file' => '@webroot/templates'.str_replace($basePath, '', $file->getRealPath()),
                        'data-toggle' => 'tooltip',
                        'title' => $file->getBasename()
                    ],
                    'type' => 'file',
                ];
            }
        }
        return $result;
    }

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

        $searchModel = new TemplatesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Templates();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
        if (($model = Templates::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetViews()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $this->getTree('', 0);
    }
}
