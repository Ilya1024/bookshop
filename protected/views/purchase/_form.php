<?php
/* @var $this PurchaseController */
/* @var $model Purchase */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'purchase-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля с звездочкой<span class="required">*</span> обязательны к заполнению.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'carry_variant'); ?>
        <?php echo $form->dropDownList($model, 'carry_variant',Purchase::model()->getAllCarryVariants())?>
        <?php echo $form->error($model,'carry_variant'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'phone_number'); ?>
        <?php echo $form->TextField($model, 'phone_number')?>
        <?php echo $form->error($model,'phone_number'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabel($model,'address'); ?>
        <?php echo $form->TextArea($model,'address'); ?>
        <?php echo $form->error($model,'address'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'purchase_date'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'purchase_date',
            'model' => $model,
            'attribute' => 'purchase_date',
            'language' => 'ru',
            'options' => array(
                'showAnim' => 'fold',
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;'
            ),
        ));
        ?>
        <?php echo $form->error($model,'purchase_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'purchase_time'); ?>
        <?php echo $form->dropDownList($model, 'purchase_time',Purchase::model()->getAllTimeVariants())?>
        <?php echo $form->error($model,'purchase_time'); ?>
    </div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Подтвердить' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->