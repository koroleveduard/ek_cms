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

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <label for="">Шаблон</label>
    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'path')->textInput(['maxlength' => true,'id'=>'view-view'])->label(false) ?>
        </div>
        <div class="col-md-4">
            <?=Html::submitInput('Файл',['id'=>'show-tree']);?>
        </div>
    </div>
    
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

<div class="modal fade" id="modal-jstree" tabindex="-1" role="dialog" aria-labelledby="jstree-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><?= Yii::t('app', 'Tree of templates') ?></h4>
            </div>
            <div class="modal-body">
                <div id="jstree"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= Yii::t('app', 'Cancel') ?></button>
                <button type="button" class="btn btn-success" id="modal-apply"><?=Yii::t('app', 'Choose')?></button>
            </div>
        </div>
    </div>
</div>


</div>

<?php $js = <<<JS
    "use strict";

    $('#show-tree').on('click', function(){
            $('#jstree').jstree({
                'plugins': ['wholerow', 'types'],
                'core': {
                    'check_callback': true,
                    'data': {
                        'url': function (node) {
                            return '/backend/templates/get-views';
                        },
                        'data': function (node) {
                            return {'id': node.id};
                        }
                    }
                },
                'types': {
                    'dir': {'icon': 'fa fa-folder-open-o'},
                    'file': {'icon': 'fa fa-folder-file-o'}
                }
            });
            $('#modal-jstree').modal('show');
            return false;
    });
    
    $('#modal-apply').on('click', function(){
        var sel = $('#jstree').jstree(true).get_selected(true);
        if (typeof sel[0].a_attr['data-file'] !== 'undefined') {
            $('#view-view').val(sel[0].a_attr['data-file']);
            $('#modal-jstree').modal('hide');
        }
    });
    
JS;

$this->registerJs($js);
?>