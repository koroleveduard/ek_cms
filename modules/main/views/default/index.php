<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
$this->title = 'EK-CMS';
?>
<div class="main-default-index">
    <?php if(!empty($pages)):?>
        <?php foreach($pages as $page):?>
            <div class="post">
            <h3 class="title"><a href="<?=Url::to(['/main/page/show','id'=>$page->id]);?>"><?=$page->title;?></a></h3>
            <?=$page->content;?>
            </div>
        <?php endforeach;?>
    <?php endif;?>
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>
