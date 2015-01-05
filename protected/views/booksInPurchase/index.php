<?php
/* @var $this BooksInPurchaseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Books In Purchases',
);

$this->menu=array(
	array('label'=>'Create BooksInPurchase', 'url'=>array('create')),
	array('label'=>'Manage BooksInPurchase', 'url'=>array('admin')),
);
?>

<h1>Books In Purchases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
