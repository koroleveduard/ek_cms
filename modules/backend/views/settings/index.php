<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $this->title = 'Настройки'; ?>
<h1>Настройки</h1>
<?php $form = ActiveForm::begin(); ?>
<?=Html::label('Хост:','hostName');?>
<?=Html::input('text','Settings['.$settings[0]->name.']',$settings[0]->value,['id'=>'hostName','class'=>'form-control']);?>
<div class="help-block"></div>
<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end(); ?>