<?php
/* @var $this PurchaseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Список покупок',
);
?>
<?php if(Yii::app()->getModule('user')->IsAdmin()):?>
<?php $this->menu=array(
	array('label'=>'Обработка заказов', 'url'=>array('admin')),
)?>
<?php endif?>
<h1>Purchases</h1>
<div class="list_data_books">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>

