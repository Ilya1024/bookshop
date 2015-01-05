<?php
/**
 * Created by PhpStorm.
 * User: Илья
 * Date: 29.12.2014
 * Time: 17:14
 */

class Cart {

    public static function getCost()
    {
        $cost = Yii::app()->shoppingCart->getCost();
         return $cost;
    }

    public static function getPositions()
    {
        return Yii::app()->shoppingCart->getPositions();
    }

    public static function getCount($pos_id)
    {
        return $pos_id->getQuantity($pos_id);
    }

    public static function removeItem($key)
    {
       return Yii::app()->shoppingCart->remove($key);
    }

} 