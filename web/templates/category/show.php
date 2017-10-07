<?php
use yii\widgets\LinkPager;
?>
<?php $this->params['breadcrumbs'] = $breadcrubms;?>
<h1><?=$model->name;?></h1>
<?=$model->top_description;?>

<?php foreach ($products as $product) :?>
    <p><img src="<?=$product->getImage()->getUrl('x300');?>" alt=""></p>
    <?=$product->name;?>
    <?=$product->anounce;?>
<?php endforeach;?>

<?=LinkPager::widget([
    'pagination' => $pagination,
]);
