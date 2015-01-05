<?php
/* @var $this PurchaseController */
/* @var $model Purchase */
$this->breadcrumbs=array(
	'Purchases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Список заказов', 'url'=>array('index')),
	array('label'=>'Создать заказ', 'url'=>array('create')),
	array('label'=>'Обзор заказа', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Обработка заказов', 'url'=>array('admin')),
);
?>

<h1>Update Purchase <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>