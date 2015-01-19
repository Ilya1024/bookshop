<?php
/* @var $this BookController */
/* @var $model Book */

$this->breadcrumbs=array(
	'Books'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Список книг', 'url'=>array('index')),
	array('label'=>'Создать лот', 'url'=>array('create'),'visible'=>Yii::app()->getModule('user')->isAdmin()),
	array('label'=>'Редактировать лот', 'url'=>array('update', 'id'=>$model->id),'visible'=>Yii::app()->getModule('user')->isAdmin()),
	array('label'=>'Удалить лот', 'url'=>'#','visible'=>Yii::app()->getModule('user')->isAdmin(),
        'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
        'confirm'=>'Вы уверены, что хотите удалить данный лот?')),
	array('label'=>'Администратор', 'url'=>array('admin'),'visible'=>Yii::app()->getModule('user')->isAdmin()),
);
?>

<h1><?php echo $model->title?> (<?php echo $model->author?>)</h1>
<div class="left-part">
<?php echo $model->description?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'author',
        'category.title',
		'release_date',
		'price',
	),
)); ?>
    <div class="button-area">
        <div class="back_button">
            <?php echo CHtml::link('Назад', array('index')); ?>
        </div>
        <?php if(Yii::app()->getModule('user')->isAdmin()):?>
        <div class="buy_button">
            <?php echo CHtml::link('Купить'); ?>
        </div>
        <? endif?>
    </div>
</div>
<div class="right-part">
    <div class="books_image">
        <!--Вывод изображения, если оно есть.-->
        <?php
        if(!$model->isNewRecord)
            if($model->image) echo CHtml::image('images/books/'.$model->image);
        ?>
        <!--Вывод изображения конец-->
    </div>
</div>
<!--CSS-->
<?php Yii::app()->clientScript->registerCssFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.book.css').'/view.css'));?>


