<?php

class SeotextController extends CmsAdminController
{
    protected $_controllerName = 'Сео';

    public function accessSpecs()
    {
        return array(
            'operations'=>array(
                'create'=>Yii::t('core/admin','Создание сео'),
                'update'=>Yii::t('core/admin','Редактирование сео'),
                'delete'=>Yii::t('core/admin','Удаление сео'),
                'index'=>Yii::t('core/admin','Управление сео'),
                'updateField'=>array(
                    'access'=>'isAdmin'
                ),
                'statusList'=>array(
                    'access'=>'isAdmin'
                ),
            ),
        );
    }

    public function getMenuTitle()
    {
        return 'Модуль Сео';
    }

    public function getMenu()
    {
        return array(
            array('label'=> 'Управление сео', 'url'=>array('seotext/admin')),
            array('label'=> 'Добавит сео', 'url'=>array('seotext/create')),
        );
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Seotext;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Seotext']))
		{
			$model->attributes=$_POST['Seotext'];
			if($model->save())
				$this->redirect(array('admin'));
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Seotext']))
		{
			$model->attributes=$_POST['Seotext'];
			if($model->save())
				$this->redirect(array('admin'));
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
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Seotext');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Seotext('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Seotext']))
			$model->attributes=$_GET['Seotext'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Seotext::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='seotext-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
