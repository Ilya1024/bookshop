<?php

/**
 * This is the model class for table "{{purchase}}".
 *
 * The followings are the available columns in table '{{purchase}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $price
 * @property integer $create_time
 * @property string $purchase_info
 * @property integer $status
 * @property integer $phone_number
 */

class Purchase extends CActiveRecord
{
    public $address; //адрес доставки товара

    public $comment; //коментарий по поводу доставки

    public $purchase_date; //дата доставки

    public $purchase_time;//удобное время доставки

    public $carry_variant;//вариант получения товара

    /*public $user_name;*/

    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{purchase}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('purchase_date, carry_variant, phone_number', 'required','on'=>'create'),
            array('phone_number', 'numerical', 'integerOnly'=>true),
            array('address','validAddress','on'=>'create'),
			array('purchase_date', 'validDate','on'=>'create'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, price, create_time, purchase_info, status, user_name', 'safe', 'on'=>'search'),
		);
	}

    public function validAddress()
    {
        if($this->carry_variant!=0 && empty($this->address))
            $this->addError('carry_variant','Укажите адрес доставки.');
    }

    public function validDate()
    {
        if(strtotime($this->purchase_date)<time('Ymd')+(1*24*60*60))
            $this->addError('purchase_date','Дата доставки допускает занчение не ранее, чем через 2 дня после оформления заказа.');
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
        return array(
            'books_in_purchase' => array(self::HAS_MANY, 'BooksInPurchase', 'purchase_id'),
            'books'=>array(self::HAS_MANY,'Book',array('item_id'=>'id'),'through'=>'books_in_purchase'),
            'user_name'=>array(self::BELONGS_TO,'User','user_id'),
        );
	}

    public function saveItemsFromCart()
    {
        $positions = Cart::getPositions();
        foreach($positions as $item)
        {
            $book_in_purchase = new BooksInPurchase();
            $book_in_purchase->purchase_id=$this->id;
            $book_in_purchase->item_id=$item->id;
            $book_in_purchase->count=Cart::getCount($item);
            if($book_in_purchase->save())
            {
                Cart::removeItem($item->getId());
            }
        }
    }


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID Заказа',
			'user_id' => 'ID пользователя',
			'price' => 'Суммарная стоимость',
            'carry_variant'=>'Вариант получения товара',
            'purchase_time'=>'Удобное время доставки',
            'phone_number'=>'Номер телефона',
            'address'=>'Адрес доставки',
			'create_time' => 'Дата создания заказа',
            'purchase_date' => 'Дата доставки',
			'purchase_info' => 'Информация по заказу',
			'status' => 'Статус заказа',
		);
	}

    public function getAllTimeVariants($variant=null)
    {
        $time = array('9:00-10:00','10:00-11:00','11:00-12:00','12:00-13:00','13:00-14:00',
            '14:00-15:00','15:00-16:00','16:00-17:00','17:00-18:00','18:00-19:00','19:00-20:00');
        return $variant!=NULL ? $time[$variant]:$time;
    }

    public function getPurchaseStatusName($all=false)
    {
        $status_variants = array('Не обработан','Обработан','Выполнен');
        if(!$all)
        {
            return $status_variants[$this->status];
        }
        else return $status_variants;
    }


    public function getAllCarryVariants($variant_id=NULL)
    {
        $variants = array('Самовывоз','Доставка по Москве','Доставка за МКАД в границах Московской обл.',
                        'Доставка в города России');
        return $variant_id!=NULL ? $variants[$variant_id] : $variants;
    }

    public function getStatus()
    {
        if($this->isNewRecord) return 0;
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
        $criteria->with = array( 'user_name' );

		$criteria->compare('price',$this->price);
		$criteria->compare('purchase_info',$this->purchase_info,true);
        $criteria->compare('phone_number',$this->phone_number,true);
        $criteria->compare('create_time', $this->dateSearch($this->create_time),true);
		$criteria->compare('status',$this->status);
        $criteria->compare( 'user_name.username', $this->user_name, true );
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    public function dateSearch($date)
    {
        if(substr_count($date,'-')) return strtotime($date);
        else{
            return $date;
        }
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Purchase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
