<?php
/* @var $this BooksInPurchaseController */
/* @var $model BooksInPurchase */

$this->breadcrumbs=array(
	'Books In Purchases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BooksInPurchase', 'url'=>array('index')),
	array('label'=>'Create BooksInPurchase', 'url'=>array('create')),
	array('label'=>'View BooksInPurchase', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BooksInPurchase', 'url'=>array('admin')),
);
?>

<h1>Update BooksInPurchase <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>