<?php
/* @var $this BookTypeController */
/* @var $model BookType */

$this->breadcrumbs=array(
	'Book Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BookType', 'url'=>array('index')),
	array('label'=>'Manage BookType', 'url'=>array('admin')),
);
?>

<h1>Create BookType</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>