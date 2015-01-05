<?php
/* @var $this BooksInPurchaseController */
/* @var $model BooksInPurchase */

$this->breadcrumbs=array(
	'Books In Purchases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BooksInPurchase', 'url'=>array('index')),
	array('label'=>'Manage BooksInPurchase', 'url'=>array('admin')),
);
?>

<h1>Create BooksInPurchase</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>