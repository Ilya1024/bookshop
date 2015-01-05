<?php

class CartController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request,
            'postOnly + delete',
            'ajaxOnly + addtocart',
            'ajaxOnly + updatecart',
            'ajaxOnly + getcost',
        );

    }

	public function actionIndex()
	{
        $models = Yii::app()->shoppingCart->getPositions();
        if(count($models))
        {
            foreach($models as $model)
            {
                $models_[$model->attributes['id']]['id']=$model->attributes['id'];
                $models_[$model->attributes['id']]['title']=$model->attributes['title'];
                $models_[$model->attributes['id']]['price']=$model->attributes['price'];
                $models_[$model->attributes['id']]['total price']=$model->attributes['price'];
                $models_[$model->attributes['id']]['quantity']=$model->quantity;

            }
            $dataProvider = new CArrayDataProvider($models_,
                array(
                    'sort'=>array(
                        'attributes'=>array('id','quantity'),
                    ),
                ));

            $get_cost_url = CController::createUrl('/cart/getcost');
            $js_preview =<<< EOD
            function() {
            var th = this;
	        jQuery('#yw0').yiiGridView('update', {
		    type: 'GET',
		    url: jQuery(this).attr('href'),
		    success: function(data) {
                jQuery('#yw0').yiiGridView('update');
                var url ='$get_cost_url';
                $.ajax({url: url,
                        type : 'POST',
                        success: function(c){jQuery('.cost_show #cost_value').text(c);}
                        });
            }
	        });
	        return false;
            }
EOD;
            $this->render('index_',array('dataProvider'=>$dataProvider,
                                        'js_preview'=>$js_preview,
                                        'cost'=>$this->GetCost()));
        }
        else
        {
            $this->render('index_',array(
                'cost'=>$this->GetCost()));
        }

	}

    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array(),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'showcart' actions
                'actions'=>array('index'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'showcart' actions
                'actions'=>array('index'),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionAddToCart($id,$count=1) //Ajax only
    {
        $model = Book::model()->findByPk($id);
        Yii::app()->shoppingCart->put($model,$count);
        return json_encode(true);
    }

    public function GetCost()
    {
        $cost = Cart::getCost().'.00 руб.';
        if( Yii::app()->request->isAjaxRequest ) echo $cost;
        else  return $cost;
    }

    public function actionGetCost()
    {
        $cost = Yii::app()->shoppingCart->getCost().'.00 руб.';
        if( Yii::app()->request->isAjaxRequest ) echo $cost;
    }


    public function actionUpdateCart($id,$count) //Ajax only
    {
        $model = Book::model()->findByPk($id);
        Yii::app()->shoppingCart->update($model,$count);
        return json_encode(true);
    }
    /*
	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}