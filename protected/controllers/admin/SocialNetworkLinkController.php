<?php

class SocialNetworkLinkController extends CmsAdminController
{

    public function accessSpecs()
    {
        return array(
            'operations'=>array(
                'index'=>'Список записей',
                'update'=>'Редактирование записи',
                'create'=>'Создание записи',
                'delete'=>'Удаление записи',
                // 'statusList'=>array(
                //     'access'=>'isAdmin'
                // ),
                // 'updateField'=>array(
                //     'access'=>'isAdmin'
                // ),
            ),
        );
    }

    public $menuTitle = "Название модуля";
    public $menu = array(
        array('label'=>'Управление настройками', 'url'=>array('/admin/settings/descriptions')),
        array('label'=>'Управление параметрами', 'url'=>array('/admin/setting/index')),
        array('label'=>'Управление линками соц. сетей', 'url'=>array('/admin/socialNetworkLink/index')),

    );
    public $subMenuTitle = "Действия";
    public $subMenu = array(
        array('label'=>'Добавить запись', 'url'=>array('create')),
    );

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
		$model=new SocialNetworkLink;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SocialNetworkLink']))
		{
			$model->attributes=$_POST['SocialNetworkLink'];
			if($model->save())
				$this->redirect(array('index'));
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

		if(isset($_POST['SocialNetworkLink']))
		{
			$model->attributes=$_POST['SocialNetworkLink'];
			if($model->save())
				$this->redirect(array('index'));
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
        $model=new SocialNetworkLink('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['SocialNetworkLink']))
        $model->attributes=$_GET['SocialNetworkLink'];

        $this->render('index',array(
        'model'=>$model,
        ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return SocialNetworkLink the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=SocialNetworkLink::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param SocialNetworkLink $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='social-network-link-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
