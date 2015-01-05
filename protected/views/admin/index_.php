<?php
/* @var $this AdminController */

$this->breadcrumbs=array(
	'Admin',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php
/* @var $this BookController */
/* @var $dataProvider CActiveDataProvider */
$this->breadcrumbs=array(
    'Администрирование',
);
?>
<?
$this->menu=array(
array('label'=>'User Management', 'url'=>array(CController::createUrl('/user/admin'))),
array('label'=>'Create Purchase', 'url'=>array('create')),
array('label'=>'Update Purchase', 'url'=>array('update', 'id'=>$model->id)),
array('label'=>'Delete Purchase', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Purchase', 'url'=>array('admin')),
);
?>
<div class="left_nav_menu">
    <?php $this->beginWidget('zii.widgets.CPortlet', array(
        'title'=>'Навигация',
    ));?>
<?php
   /*echo $url1 = CController::createUrl('/purchase/index');*/
$this->widget('zii.widgets.CMenu', array(
    'items'=>array(
        // Important: you need to specify url as 'controller/action',
        // not just as 'controller' even if default action is used.
        array('label'=>'Управление пользователями', 'url'=>array('/user/admin')),
        // 'Products' menu item will be selected no matter which tag parameter value is since it's not specified.
        array('label'=>'Заказы ➤','items'=>array(
            array('label'=>'Не обработанные', 'url'=>array('purchase/index&status=0'),
                'linkOptions' => array(
                    'onclick' => 'event.preventDefault();$.get("/bookshop/index.php?r=purchase/index",{status:0}, function(data){
                                                        $("#ajax_content_part").html(data);
                                                        $("#content").height(1000);
                                                        });',
                ),),
            array('label'=>'Обработанные', 'url'=>array('purchase/index&status=1'),
                'linkOptions' => array(
                    'onclick' => 'event.preventDefault();$.get("/bookshop/index.php?r=purchase/index",{status:1}, function(data){
                                                        $("#ajax_content_part").html(data).width($("#list_data_books").width);
                                                            $("#content").height(1000);
                                                        });',
                ),),
            array('label'=>'Выполненные', 'url'=>array('purchase/index&status=2'),
                'linkOptions' => array(
                    'onclick' => 'event.preventDefault();$.get("/bookshop/index.php?r=purchase/index",{status:2}, function(data){
                                                        $("#ajax_content_part").html(data);
                                                        $("#content").height(1000);
                                                        });',
                ),),
            array('label'=>'Редактирование', 'url'=>array('purchase/admin'),
                ),
            )),
            array('label'=>'Управление товарами ➤','items'=>array(
                array('label'=>'Редактирование товаров', 'url'=>array('book/admin'),
                   ),
                array('label'=>'Создание товара', 'url'=>array('book/create'),
                ),
                array('label'=>'Категории товаров', 'url'=>array('booktype/admin'),
                ),
                array('label'=>'Создать категорию', 'url'=>array('booktype/crete'),
                ),
            ))

            ),
));
?>
<?php $this->endWidget()?>
</div>
<div id="ajax_content_part">
</div>

<?php /*echo CHtml::ajaxLink(
    'Получить ответ от сервера',
    CController::createUrl('/purchase/index'),
    array(
        'type' => 'POST',// method
        'data'=>array('status'=>TRUE),
        'update' => '.ajax_content_part',
    ));
*/?>

<?php Yii::app()->clientScript->registerScript('register_script_name', "
                $('ul li ul').hide();
                $('ul li ul').siblings().click(function(){

                    $('ul li ul').slideToggle();

                    return false;
                    });
                    ", CClientScript::POS_READY);?>


<?php Yii::app()->clientScript->registerCssFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.admin.css').'/index.css'));?>

