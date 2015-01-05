<?php
/**
 * Created by PhpStorm.
 * User: Илья
 * Date: 27.12.2014
 * Time: 23:09
 */

class ImageManager
{
    public $image_name;
    public $image_file;

    public function rules() {
        return array(
            array('name', 'required'),
            array('name', 'length', 'max'=>255),
        );
    }

    public function __construct( CUploadedFile $file, $name )
    {
        $this->image_file = $file;
        $this->image_name = $name;
    }

    public  function imageSave()
    {
            $this->image_file->saveAs('images/books/'.$this->image_name);
            $image = Yii::app()->image->load('images/books/'.$this->image_name);
            $image->resize(200, 200);
            $image->save();
            return true;

    }
    public static function imageDelete($image_name)
    {
        if (is_file($image_name))
        {
            unlink('images/books/'.$image_name);
        }
        return true;
    }
} 