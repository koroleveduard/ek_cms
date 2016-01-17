<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php
$this->params['breadcrumbs'][] = 'Настройки';
$this->title = 'Настройки'; 
?>
<h1>Настройки</h1>
<div class="b-settings-form">
<?php $form = ActiveForm::begin(); ?>
<div class="b-settings-form__row">
<?=Html::label('Хост:','hostName');?>
<?=Html::input('text','Settings['.$settings[0]->name.']',$settings[0]->value,['id'=>'hostName','class'=>'form-control']);?>
</div>
<div class="b-settings-form__row">
<?=Html::checkbox('Settings['.$settings[1]->name.']',$settings[1]->value);?> <label for="">Включить кеш</label>
</div>
<div class="help-block"></div>
<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end(); ?>
</div>