<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\backend\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'slug',
            [
                'attribute' => 'title',
                'label' => 'Заголовок',
                'format' => 'html',
                'value' => function($model){
                    return Html::a(
                        $model->title,
                        ['/backend/page/update','id'=>$model->id]
                    );
                }

            ],
            'meta_title',
            
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
                'buttons' => [
                    'view' => function($url,$model){
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',['/main/page/show','id'=>$model->id]);
                    }
                ]
            ],
        ],
    ]); ?>

    <p>
        <?= Html::a('Добавить страницу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

</div>