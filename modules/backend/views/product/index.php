<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\backend\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Продукты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyText' => 'Продуктов не найдено',
        'layout' => "{items}\n{pager}",
        'columns' => [
            'id',
            [
                'attribute' => 'name',
                'label' => 'Название',
                'format' => 'html',
                'value' => function($model){
                    return Html::a(
                        $model->name,
                        ['/backend/product/update','id'=>$model->id]
                    );
                }

            ],
            'slug',
            'meta_title',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
                'buttons' => [
                    'view' => function($url,$model){
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',['/main/product/show','id'=>$model->id]);
                    }
                ]
            ],
        ],
    ]); ?>

    <p>
        <?= Html::a('Добавить продукт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

</div>