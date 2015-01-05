<?php
/* @var $this BookController */
/* @var $model Book */

$this->breadcrumbs=array(
	'Books'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Список книг', 'url'=>array('index')),
	array('label'=>'Создать лот', 'url'=>array('create')),
	array('label'=>'Просмотр лота', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Администратор', 'url'=>array('admin')),
);
?>
<h1>Редактирование : <?php echo $model->title?> (<?php echo $model->author?>)</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>