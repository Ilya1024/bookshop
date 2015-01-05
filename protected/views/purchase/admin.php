<?php
/* @var $this PurchaseController */
/* @var $model Purchase */

$this->breadcrumbs=array(
	'Purchases'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Обзор покупок', 'url'=>array('index')),
	/*array('label'=>'Create Purchase', 'url'=>array('create')),*/
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#purchase-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Заказы</h1>

<p>
Для поиска доступны операторы (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
или <b>=</b>).
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
));?>
    <? print_r('30-12-2014'); ?>
</div><!-- search-form -->
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'purchase-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'name'=>'user_name',
            'value'=>'$data->user_name->username',
        ),
		'price',
        'phone_number',
        array(
            'name'=>'create_time',
            'value'=>'date("d-m-Y",$data->create_time)',
        ),
		'purchase_info',
        array(            // display 'author.username' using an expression
            'name'=>'status',
            'value'=>'$data->getPurchaseStatusName()',
        ),
		/*array(
			'class'=>'CButtonColumn',
		),*/
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{delete}',
        )
	),
)); ?>

