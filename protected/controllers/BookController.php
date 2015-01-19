<?php

class BookController extends Controller
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
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('getAllTypes','GetBooksByParentId'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Book;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model)
        if(isset($_POST['Book']))
        {
            /*$dir = Yii::getPathOfAlias('images');*/

            $model->attributes = $_POST['Book'];
            $image = CUploadedFile::getInstance($model,'image');

            if( $model->validate() )
            {
                $img = new ImageManager($image,$model->translit($model->title.$image->getName()));
                $model->image = $img->imageSave() ? $model->image : NULL;
                if($model->save())
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
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

        if(isset($_POST['Book']))
        {
            $model->attributes = $_POST['Book'];

            if( $model->validate() )
            {
                if(!empty($_POST['Book']['image']))
                {
                    $image = CUploadedFile::getInstance($model,'image');
                    $img = new ImageManager($image,$model->translit($model->title.$image->getName()));
                    $model->image = $img->imageSave() ? $model->image : NULL;
                }

                if($model->save())
                    $this->redirect(array('view','id'=>$model->id));

            }
        }

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        $model = $this->loadModel($id);
        if($model->image) ImageManager::imageDelete($model->image);

        $model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

    /**
	 * Вывод каталога книг по типу книги или всех книг
	 */

    public function actionIndex($book_type=NULL)
    {
        if($book_type==NULL)
        {
            $books=Book::model()->with('category')->findAll();
            $dataProvider=new CArrayDataProvider($books);
        }
        else
        {
            /*
             * Выбираем все дочерние категории, от данной категории
             * и добавляем этот массив в критерий
             */
            $url = BookType::model()->findByPk($book_type)->url;
            $criteria = new CDbCriteria();
            $criteria->select='id';
            $criteria->condition="url LIKE :url";
            $criteria->params=array(":url"=>$url.'%');

            $types =  BookType::model()->with('books')->findAll($criteria);
            foreach($types as $type) $types['ids'][]=$type->id;

            $criteria = new CDbCriteria();
            $dataProvider=new CActiveDataProvider('Book');

            $criteria->addInCondition('book_type', $types['ids']);
            $dataProvider->criteria=$criteria;
        }
        $this->render('index_',array(
            'dataProvider'=>$dataProvider,
            'book_type'=>(int)$book_type,
        ));
    }


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Book('search');
		$model->unsetAttributes();
		if(isset($_GET['Book']))
			$model->attributes = $_GET['Book'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


	public function loadModel($id)
	{
		$model=Book::model()->with('category')->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}



	/**
	 * Performs the AJAX validation.
	 * @param Book $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='book-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
