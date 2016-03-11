<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\backend\models\Category;
use dosamigos\ckeditor\CKEditor;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\backend\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <ul class="nav nav-tabs" id="myTab">
        <li class="active"><a href="#content">Контент</a></li>
        <li class=""><a href="#seo">Сео</a></li>
        <li class=""><a href="#settings">Настройки</a></li>
    </ul>

    <div class="tab-content">
      <div class="tab-pane active" id="content">

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'anounce')->widget(CKEditor::className(), [
        'options' => ['rows' => 6,
        ],
        'preset' => 'toolbar_Basic'
    ]) ?>

        <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6,
        ],
        'preset' => 'toolbar_Basic'
    ]) ?>
    
      </div>
      <div class="tab-pane" id="seo">
        <?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

      </div>
      <div class="tab-pane" id="settings">
          <?= $form->field($model, 'category_ids')
        ->checkBoxList(
                ArrayHelper::map(Category::find()->all(), 'id_category', 'name')
                //,['multiple' => 'true']
            );
        ?>

        <?= $form->field($model, 'main_category')
        ->dropDownList(
                [$model->main->id_category => $model->main->name]
            );
        ?>

          <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
            
          <?= $form->field($model,'status')->checkBox(['label' => 'Активный','uncheck' => 0, 'checked'=>1]); ?>
      </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Сохранить', [
          'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
          'name' => 'save']) ?>

        <?= Html::submitButton($model->isNewRecord ? 'Сохранить и вернуться' : 'Сохранить и вернуться', ['
          class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
          'name' => 'save-and-back']) ?>

        <?= Html::submitButton($model->isNewRecord ? 'Сохранить и создать новую' : 'Сохранить и создать новую', ['
          class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
          'name' => 'save-and-add']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php $js = <<<JS
    $('#myTab a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})

JS;

$this->registerJs($js);