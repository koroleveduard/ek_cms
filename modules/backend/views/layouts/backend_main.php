<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\components\widgets\Alert;
use app\assets\AppAsset;
use app\assets\BackendAsset;
use app\assets\ProtectedAsset;


AppAsset::register($this);
BackendAsset::register($this);
ProtectedAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <?php
    NavBar::begin([
        'brandLabel' => 'Admin Panel',
        'brandUrl' => ['/backend/default/index'],
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Html::a('Очистить кеш',Url::to(['/backend/backend/flush-cache']),['class'=>'clear-cache btn btn-warning']);
    echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => array_filter([
        ['label' => 'Страницы', 'url' => ['/backend/page/index']],
        ['label' => 'Шаблоны', 'url' => ['/backend/templates/index']],
        ['label' => 'Настройки', 'url' => ['/backend/settings/index']],
    ]),
    ]);

    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink' => ['label' => 'Админка','url'=>['/backend/default/index']],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
