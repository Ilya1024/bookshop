<?php

class PurchaseController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
            'AjaxOnly + ChangeStatus',
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','ChangeStatus'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $condition = '';
        /*
         * только админ может просматривать любой заказ
         * остальные - только свои заказы
         */
        if(!Yii::app()->getModule('user')->isAdmin())
            $condition = 'user_id='.Yii::app()->user->getId();

        $purchase=Purchase::model()->with(array('books','books_in_purchase','user_name'))->findByPk($id,$condition);
        if(!$purchase) throw new CHttpException(404,'Данный заказ не существует');
        /*
         * Статус заказа запрашиваем
         */
        $purchase->status = $purchase->getPurchaseStatusName();
        $purchase->create_time = date("Y-m-d",$purchase->create_time);
		$this->render('view',array(
			'model'=>$purchase,
		));
	}

    public function actionChangeStatus($status,$id)
    {

        if(in_array((int)$status,array(0,1,2)))
        {
            $model = Purchase::model()->findByPk($id);
            $model->status=(int)$status;
            $model->address=$model->purchase_info;
            if($model->save()) echo true;
            else echo false;
        }
        else echo false;
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        if(Cart::getCost()==0)
            $this->redirect(array('cart/index'));

		$model=new Purchase('create');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Purchase']))
		{
            $model->attributes=$_POST['Purchase'];
            /*
             * формируем строку purchase info
             */

            $purchase_info[]= $_POST['Purchase']['address'];
            $purchase_info[]=$model->getAllCarryVariants($_POST['Purchase']['carry_variant']);
            $purchase_info[]= $_POST['Purchase']['purchase_date'];
            $purchase_info[]=$model->getAllTimeVariants($_POST['Purchase']['purchase_time']);
            $model->purchase_info = implode(';',$purchase_info);

            $model->user_id = Yii::app()->user->getId();
            $model->price = Cart::getCost();
            $model->create_time= strtotime(date("Y-m-d",time()));
            $model->status = $model->getStatus();

            if($model->save())
            {
                $model->saveItemsFromCart();
                $this->redirect(array('view','id'=>$model->id));
            }
		}
		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	/*public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Purchase']))
		{
			$model->attributes=$_POST['Purchase'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}*/

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        /*
         * собираем книги которые относятся к заказу и удаляем
         */

        $books_in_purchase = new BooksInPurchase();

        $criteria = new CDbCriteria();
        $criteria->condition='purchase_id=:purchase_id';
        $criteria->params=array(':purchase_id'=>$id);
        $books_in_purchase=$books_in_purchase->findAll($criteria);

       if(count($books_in_purchase))
           foreach($books_in_purchase as $item)
           {
               $item->delete();
           }
        $this->loadModel($id)->delete();


		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($status=NULL)
	{
        $criteria = new CDbCriteria();
        if($status!==NULL)
        {
            $criteria->addInCondition('status',array($status),'AND');
            $criteria->order ='create_time DESC';
        }
        if(!Yii::app()->getModule('user')->isAdmin())
            $criteria->addInCondition('user_id',array(Yii::app()->user->getId()),'AND');

        $dataProvider=new CActiveDataProvider('Purchase', array(
            'criteria'=>$criteria));

        //вывод
        if (Yii::app()->request->isAjaxRequest)
            $this->renderPartial('index',array(
                'dataProvider'=>$dataProvider,));
        else
		    $this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Purchase('search');
        $model->status=$model->getPurchaseStatusName();
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Purchase']))
			$model->attributes=$_GET['Purchase'];

        if (Yii::app()->request->isAjaxRequest)
            $this->renderPartial('admin',array(
                'model'=>$model,
            ));
        else
            $this->render('admin',array(
                'model'=>$model,
            ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Purchase the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Purchase::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Purchase $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='purchase-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
