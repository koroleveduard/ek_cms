<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\backend\models\Page;
use app\modules\backend\models\Templates;
use dosamigos\ckeditor\CKEditor;
use kartik\date\DatePicker;
use app\modules\backend\models\Category;

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


        <?= $form->field($model, 'top_description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6,
        ],
        'preset' => 'toolbar_Basic'
    ]) ?>

    <?= $form->field($model, 'bottom_description')->widget(CKEditor::className(), [
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
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model,'status')->checkBox(['label' => 'Активный','uncheck' => 0, 'checked'=>1]); ?>

              <?= $form->field($model, 'parent')
          ->dropDownList(
             ArrayHelper::merge(
                  [0 => "Выберите родителя"],
                  ArrayHelper::map($parents, 'id_category', 'name')
                  )
          );?>
      </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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