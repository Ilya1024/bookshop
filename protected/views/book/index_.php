
<?php
    /* @var $this BookController */
    /* @var $dataProvider CActiveDataProvider */
    $this->breadcrumbs=array(
    'Каталог книг',
    );

?>
<div class="navigation_left_block">
<?php $items = BookType::model()->getTypesListByParent($book_type)?>
<?php if(count($items)):?>
<div class="left_nav_menu">
        <?php $this->beginWidget('zii.widgets.CPortlet', array(
            'title'=>'Навигация',
        ));?>
        <div class="links_navigation_menu">
        <?php $this->widget('zii.widgets.CMenu',array(
            'items'=>$items,
        )); ?>
        </div>
    <?php $this->endWidget()?>
</div>
<?php endif?>
<?php if(Yii::app()->getModule('user')->isAdmin()):?>
    <div class="admin_navigation">
        <?php $this->beginWidget('zii.widgets.CPortlet', array(
            'title'=>'Администрирование',
        ));?>
        <div class="admin_navigation_menu">
            <?php $this->widget('zii.widgets.CMenu',array(
                'items'=>array(
                    array('label'=>'Создать лот', 'url'=>array('create'),'visible'=>Yii::app()->getModule('user')->isAdmin()),
                    array('label'=>'Список всех лотов', 'url'=>array('admin'),'visible'=>Yii::app()->getModule('user')->isAdmin()),
                ),
            )); ?>
        </div>
        <?php $this->endWidget()?>
    </div>
<?php endif?>
</div>
<div class="books_list">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>

<?php Yii::app()->clientScript->registerCssFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.book.css').'/index.css'));?>