<?php
/* @var $this BookController */
/* @var $model Book */

$this->breadcrumbs=array(
	'Книги'=>array('index'),
	'Администрирование',
);

$this->menu=array(
	array('label'=>'Список книг', 'url'=>array('index')),
	array('label'=>'Создать книгу', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#book-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        array(
            'class' => 'EImageColumn',
            'imagePathExpression' => 'Yii::app()->baseUrl."/images/books/".$data->image',
            'emptyText' => '—',
            'imageOptions' => array(
                'height' => 100,
            ),
        ),
        'title',
        'author',
        array(            // display 'author.username' using an expression
            'name'=>'category',
            'value'=>'$data->category->title',
        ),
        'price',
        'release_date',
        array(
            'class'=>'CButtonColumn',
        ),
    ),
));
?>
