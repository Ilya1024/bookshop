<?php
/* @var $this BooksInPurchaseController */
/* @var $model BooksInPurchase */
$this->breadcrumbs=array(
	'Books In Purchases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List BooksInPurchase', 'url'=>array('index')),
	array('label'=>'Create BooksInPurchase', 'url'=>array('create')),
	array('label'=>'Update BooksInPurchase', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BooksInPurchase', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BooksInPurchase', 'url'=>array('admin')),
);
?>

<h1>View BooksInPurchase #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'book_info.title',
		'purchase_id',
		'count',
	),
)); ?>
