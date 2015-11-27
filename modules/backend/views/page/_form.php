<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\backend\models\Page;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\modules\backend\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model,'status')->checkBox(['label' => 'Активный','uncheck' => 0, 'checked'=>1]); ?>

    <?= $form->field($model, 'parent')
        ->dropDownList(
            ArrayHelper::merge(
                [0 => "Выберите родителя"],
                ArrayHelper::map(Page::find()->where(['<>','id',$model->id])->all(), 'id', 'title')
            )

        );
    ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>
    <?//= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'options' => ['rows' => 6,
        ],
        'preset' => 'toolbar_Basic'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>