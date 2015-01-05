<?php
/* @var $this CartController */

$this->breadcrumbs=array(
	'Cart',
);
?>
<h1>Корзина покупок.</h1>

<?php if($dataProvider):?>
<?php $this->widget('zii.widgets.grid.CGridView',
    array('dataProvider'=>$dataProvider,
       'columns'=>array(
           'title',
           'price',
           'quantity',
           'id',
           array(
               'class'=>'CButtonColumn',
               'buttons'=>array(
                   'add'=>array(
                       'label'=>'up',
                       'url'=>'Yii::app()->createUrl("cart/AddToCart", array("id"=>$data["id"]))',
                        'click'=>$js_preview,
                       'imageUrl'=>'',
                   ),
                   'down'=>array(
                                  'label'=>'down',
                                  'url'=>'Yii::app()->createUrl("cart/UpdateCart", array("id"=>$data["id"],"count"=>($data["quantity"]-1)))',
                                  'click'=>$js_preview,
                                  'imageUrl'=>'',
                              ),
                   ),
                   'template'=>'{add}{down}',
       ),
   )));?>
    <div class="button-area">
        <div class="back_button">
            <?php echo CHtml::link('Оформить заказ', array('purchase/create')); ?>
        </div>
    </div>
<? else:?>
<p>Корзина пуста</p>
   <?php endif;?>
<div class="cost_show">
<b><span class="cost_label">Суммарная стоимость покупок : </span></b><span id="cost_value"><?php echo $cost?></span>
</div>
