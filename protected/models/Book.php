<?php

/**
 * This is the model class for table "{{book}}".
 *
 * The followings are the available columns in table '{{book}}':
 * @property integer $id
 * @property string $title
 * @property string $author
 * @property string $description
 * @property integer $book_type
 * @property integer $release_date
 * @property integer $num_pages
 * @property string $image
 * @property double $price
 */
class Book extends MyActiveRecord implements IECartPosition
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{book}}';
	}

    /*
     * Ужас, ужас
     */
    public function getAllTypeParents(array $categories)
    {
        $result=$categories;
        $categories_=array();

        while($categories_=$this->getAllParentsByType($categories))
        {
            $categories=$categories_;
            foreach($categories_ as $c)
            {
                array_push($result, $c);
            }
        }
        return $result;
    }

    public function getAllParentsByType($categories)
    {
        if(!is_array($categories) || in_array(0,$categories))
        {
            return false;
        }
        else
        {
            $categories_=array();
            $criteria = new CDbCriteria();
            $types = new BookType();

            foreach($categories as $book_type)
            {
                $criteria->condition='parent_id='.(int)$book_type;
                $data = $types->findAll($criteria);

                if(count($data)>0)
                {
                    foreach($data as $t)
                    {
                        $categories_[] = $t->attributes['id'];
                    }
                    return $categories_;
                }
                else return false;
            }

        }
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, author, description, price', 'required'),
            array('book_type, num_pages', 'numerical', 'integerOnly'=>true),
            array('release_date', 'date', 'format'=>'dd.MM.yyyy'),
            array('title, author', 'length', 'max'=>255),
            array('image','file','allowEmpty'=>true,'types'=>'jpg,png,gif,jpeg'),
            array('image','unsafe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, author,  book_type, release_date, num_pages, category', 'safe', 'on'=>'search'),
        );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
        return array(
            'category' => array(self::BELONGS_TO, 'BookType', 'book_type'),
        );
	}

	protected function beforeSave() 
	{
	    if(parent::beforeSave()) 
	    {
	        $this->release_date = strtotime($this->release_date);
	        return true;
	    } 
	    else 
	    {
	        return false;
	    }
	}

	protected function afterFind() 
	{
	    $date = date('d.m.Y', $this->release_date);
	    $this->release_date = $date;
	    parent::afterFind();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Название',
			'author' => 'Автор',
			'description' => 'Описание',
			'book_type' => 'Категория',
            'category'=>'Категория',
			'release_date' => 'Дата издания',
            'num_pages'=>'Кол-во страниц',
			'image' => 'Изображение',
			'price' => 'Цена',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
        $criteria->with = "category";

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('author',$this->author,true);
        $criteria->compare('category.title',$this->category,true);
		$criteria->compare('release_date',$this->release_date,true);
        $criteria->compare('num_pages',$this->num_pages);
		$criteria->compare('price',$this->price);
        $criteria->compare('image',$this->image);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Book the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
     
    function getId(){
        return 'Book'.$this->id;
    }
      
    function getPrice(){
        return $this->price;
    }
 
}
