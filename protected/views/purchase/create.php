<?php
/* @var $this PurchaseController */
/* @var $model Purchase */

$this->breadcrumbs=array(
	'Purchases'=>array('index'),
	'Create',
);
?>

<h1>Оформление заказа</h1>
<p>Заполните форму, пожалуйста.</p>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>