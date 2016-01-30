<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\backend\models\Page;
use app\modules\backend\models\Templates;
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

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'breadcrumb')->textInput(['maxlength' => true]) ?>

        <?/*= DatePicker::widget([
        'name' => 'created',
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'value' => $model->created,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy 00:00:00'
        ]
        ]);*/?>

        <?= $form->field($model, 'created')->widget(DatePicker::classname(),[
          'pluginOptions' => [
            'language' => 'ru',
            'format' => 'dd-mm-yyyy',
          ]
          
        ]);?>

        <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'options' => ['rows' => 6,
        ],
        'preset' => 'toolbar_Basic'
    ]) ?>

    <?= $form->field($model, 'announce')->widget(CKEditor::className(), [
        'options' => ['rows' => 6,
        ],
        'preset' => 'toolbar_Basic'
    ]) ?>
      </div>
      <div class="tab-pane" id="seo">
          
        <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

      </div>
      <div class="tab-pane" id="settings">
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
            
          <?= $form->field($model,'status')->checkBox(['label' => 'Активный','uncheck' => 0, 'checked'=>1]); ?>

          <?= $form->field($model, 'template')
        ->dropDownList(
            ArrayHelper::merge(
                ["0" => "default"],
                ArrayHelper::map(Templates::find()->all(), 'id', 'name')
            )

            );
        ?>
        
        <?= $form->field($model, 'parent')
        ->dropDownList(
            ArrayHelper::merge(
                [0 => "Выберите родителя"],
                ArrayHelper::map(Page::find()->where(['<>','id',$model->id])->all(), 'id', 'title')
            )

        );
    ?>
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