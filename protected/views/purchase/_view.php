<?php
/* @var $this PurchaseController */
/* @var $data Purchase */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />
    <? if(Yii::app()->getModule('user')->IsAdmin()): ?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />
    <?php endif ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode(date("d-m-Y",$data->create_time)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purchase_info')); ?>:</b>
	<?php echo CHtml::encode($data->purchase_info); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('phone_number')); ?>:</b>
    <?php echo CHtml::encode($data->phone_number); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->getPurchaseStatusName()); ?>
	<br />


</div>