<?php
/* @var $this BookController */
/* @var $data Book */
?>

<div class="view">
    <div class="left-part"><!-- begin of left part -->
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('author')); ?>:</b>
	<?php echo CHtml::encode($data->author); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
    <?php if(strlen($data->description)>1000):?>
	<?php echo substr($data->description,0,1000)."..."; ?>
    <?else:?>
    <?php echo $data->description;?>
    <?php endif ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('book_type')); ?>:</b>
	<?php echo CHtml::encode($data->category->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('release_date')); ?>:</b>
	<?php echo CHtml::encode($data->release_date); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
    <?php echo CHtml::encode($data->price); ?>
    <br />
    <div class="button-area">
        <div class="about_book_button">
            <?php echo CHtml::link('Подробнее', array('view', 'id'=>$data->id)); ?>
        </div>
        <?php if(!Yii::app()->user->IsGuest):?>
        <div class="buy_button">
           <?php
            echo CHtml::ajaxLink(
                $text = 'В корзину',
                $url = CController::createUrl('/cart/addtocart'),
                $ajaxOptions=array (
                    'type'=>'GET',
                    'data'=>array('id'=>$data->id),
                    'success'=>"function( data )
                                {
                                    alert('Добавлено');
                                }",
                )
            );
            ?>
        </div>
        <?php endif?>
    </div>

    <!-- end of left part -->
    </div>
    <div class="right-part"><!-- begin of right part -->
        <div class="books_image">
            <!--img-->
            <?php
            if(!$model->isNewRecord)
                if($data->image) echo CHtml::image('images/books/'.$data->image);
            ?>
            <!--img-->
        </div>
        <br/>
    </div>
    <!-- end of right part -->

</div>
    <!--CSS-->
<?php Yii::app()->clientScript->registerCssFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.book.css').'/_view.css'));?>