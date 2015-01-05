<?php
/* @var $this PurchaseController */
/* @var $model Purchase */

$this->breadcrumbs=array(
	'Purchases'=>array('index'),
	$model->id,
);
?>
    <?php if(Yii::app()->getModule('user')->IsAdmin()) : ?>
<?
$this->menu=array(
	array('label'=>'Список покупок', 'url'=>array('index')),
	array('label'=>'Update Purchase', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить заказ', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Purchase', 'url'=>array('admin')),
);
?>
    <? else : ?>
<?
$this->menu=array(
    array('label'=>'Список покупок', 'url'=>array('index')));
?>
    <?php endif ?>

<div class="purchase-detail-view">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
        'user_name.username',
		'price',
		'create_time',
		'purchase_info',
		'status',
	),
)); ?>
</div>
<div class="books_in_purchase_list">
<? foreach($model->books as $num=>$data ):?>
    <div class="book_in_purchase_in_list">
        <b> <?php echo CHtml::encode('Название'); ?>:</b>
            <?php echo CHtml::encode($data->title); ?>
        <br />
        <b> <?php echo CHtml::encode('Кол-во'); ?>:</b>
        <?php echo CHtml::encode($model->books_in_purchase[$num]->count); ?>
        <br />
        <b> <?php echo CHtml::encode('Цена экземпляра'); ?>:</b>
        <?php echo CHtml::encode($data->price).'.00р.'; ?>
        <br />
        <br />
        </div>
<?php endforeach?>
<?php if(Yii::app()->getModule('user')->isAdmin()):?>
</div>
    <div class="row">
        <?php echo CHtml::activeLabel($model,'status'); ?>
        <?php echo CHtml::activeDropDownList($model,'status',$model->getPurchaseStatusName(true))?>
    </div>
<div class="button-area">

    <? $change_status_url = CController::createUrl('/purchase/changeStatus')?>
        <div class="change_status_button">
            <?php Yii::app()->clientScript->registerScript('register_script_name', "
                $('#change_status_button').click(function(){
                    var val = $('#Purchase_status').val();
                    var url = '$change_status_url',
                    id = $model->id;
                    $.ajax({url: url,
                            type : 'GET',
                            data : {status:val,id:id},
                            success: function(c){if(c==true){alert('Статус был изменен.');location.reload(true);}
                                                    else alert('Статус не был изменен произошла ошибка');}
                        });
                    return false;
                    });
                    ", CClientScript::POS_READY);?>
            <?php echo CHtml::button("Изменить",array('title'=>"Изменить статус",'id'=>"change_status_button")); ?>
        </div>
    <?php endif?>
</div>

    <!--CSS-->
<?php Yii::app()->clientScript->registerCssFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.purchase.css').'/view.css'));?>