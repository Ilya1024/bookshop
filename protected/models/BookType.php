<?php

/**
 * This is the model class for table "{{book_type}}".
 *
 * The followings are the available columns in table '{{book_type}}':
 * @property integer $id
 * @property string $title
 * @property integer $parent_id
 */
class BookType extends MyActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{book_type}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, parent_id', 'required'),
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, parent_id', 'safe', 'on'=>'search'),
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
            'books' => array(self::HAS_MANY, 'Book', 'book_type'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Категория',
			'parent_id' => 'Родительская категория',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('parent_id',$this->parent_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BookType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /*
    * Возвращает название родительской категории по id
    */
    public function getParentTypeById($id) {
        $title = $this->model()->findByPk($id)->title;
        return $title;
    }

    /*
    * Возвращает все категории
    */

    public function getAllTypes() {
        return CHtml::listData($this->model()->findAll(), 'id', 'title');
    }
    /*
    * Возвращает все категории по родительской категории(один уровень вложенности)
    */
    public function getTypesByParent($parent_id=0)
    {
        $criteria = new CDbCriteria();
        $criteria->compare('parent_id',$parent_id);
        $criteria->condition='id > 0 AND parent_id='.$parent_id;
        $types = new BookType();
        return CHtml::listData($types->findAll($criteria),'id','title');
    }

    public function getCategoryPath($parent_id)
    {
        print($parent_id);die;
    }



    public function getTypesListByParent($parent_id=0) //для представления в виде меню
    {
        $labels = array();
        $types = $this->getTypesByParent($parent_id);
        $i=-1;
        foreach($types as $id=>$name)
        {
            $labels[++$i]['label']=$name;
            $labels[$i]['url'][]='/book/index&book_type='.$id;
        }
       return $labels;
    }


    protected function beforeSave() {
        if(parent::beforeSave()) {
            if($this->isNewRecord) {
                $parent_cat = $this->model()->findbyPk($this->parent_id);
                $this->url = $parent_cat->url.$this->translit($this->title);
            }
            return true;
        } else {
            return false;
        }
    }


}
