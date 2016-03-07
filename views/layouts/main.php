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
use app\modules\backend\models\Category;

AppAsset::register($this);
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
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => array_filter([
            ['label' => 'Home', 'url' => ['/main/default/index']],
            ['label' => 'Contact', 'url' => ['/contact/default/index']],
            Yii::$app->user->isGuest ?
                ['label' => 'Sign Up', 'url' => ['/user/default/signup']] :
                false,
            Yii::$app->user->isGuest ?
                ['label' => 'Login', 'url' => ['/user/default/login']] :
                ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/user/default/logout'],
                    'linkOptions' => ['data-method' => 'post']],
            !Yii::$app->user->isGuest ?
                ['label' => 'Admin', 'url' => ['/backend/default/index']] :
                false,
        ]),
    ]);
    NavBar::end();
    ?>
    <div class="b-page">
        <div class="b-sidebar">
            <ul class="b-list-categories">
            <?php $categories = Category::find()->where(['status'=>1])->all();?>
            <?php foreach($categories as $category):?>
                <li class="b-list-categories__tem">
                    <a href="<?=Url::toRoute(['/main/category/show','id'=>$category->id_category]);?>" class="b-list-categories__link"><?=$category->name;?></a>
                </li>
            <?php endforeach;?>
            </ul>
        </div>
        <div class="b-page-content">
            <div class="b-page-content__breadcrumbs">
                <?php
                    //print_r($this->params);
                ?>
                <?= Breadcrumbs::widget([
                    'homeLink' => ['label'=>'Главная','url'=>['/main/default/index']],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
            </div>
            <div class="b-page-content__text">
                <?= $content ?>
            </div>
        </div>
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
