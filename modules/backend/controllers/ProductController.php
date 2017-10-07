<?php

namespace app\modules\backend\controllers;

use Yii;
use app\modules\backend\models\Product;
use app\modules\backend\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PageController implements the CRUD actions for Page model.
 */
class ProductController extends BackendController
{
    const UPLOAD_DIR = '@webroot/upload/files/';

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
        $searchModel = new ProductSearch();
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
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $image = UploadedFile::getInstance($model, 'image');
            if ($image) {
                $model->removeImages();
                $uploadDir = Yii::getAlias(self::UPLOAD_DIR);
                $path = $uploadDir.$image->baseName.'.'.$image->extension;
                if (is_dir($uploadDir) === false) {
                    mkdir($uploadDir, 0775, true);
                }
                $image->saveAs($path);
                $model->attachImage($path);
            }
            
            if (isset(Yii::$app->request->post()['save'])) {
                return $this->redirect(['update', 'id' => $model->id]);
            }

            if (isset(Yii::$app->request->post()['save-and-back'])) {
                return $this->redirect(['index']);
            }

            if (isset(Yii::$app->request->post()['save-and-add'])) {
                return $this->redirect(['create']);
            }
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
            $image = UploadedFile::getInstance($model, 'image');
            if ($image) {
                $model->removeImages();
                $uploadDir = Yii::getAlias(self::UPLOAD_DIR);
                $path = $uploadDir.$image->baseName.'.'.$image->extension;
                if (is_dir($uploadDir) === false) {
                    mkdir($uploadDir, 0775, true);
                }
                $image->saveAs($path);
                $model->attachImage($path);
            }

            if (isset(Yii::$app->request->post()['save'])) {
                return $this->redirect(['update', 'id' => $model->id]);
            }

            if (isset(Yii::$app->request->post()['save-and-back'])) {
                return $this->redirect(['index']);
            }

            if (isset(Yii::$app->request->post()['save-and-add'])) {
                return $this->redirect(['create']);
            }
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
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
