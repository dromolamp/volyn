<?php

class SettingsController extends CmsAdminController
{
    protected $_controllerName = 'Site settings';

    public function accessSpecs()
    {
        return array(
            'operations'=>array(
                'index'=>Yii::t('core/admin','Manage settings'),
            ),
        );
    }

    public $menu = array(
        array('label'=>'Управление настройками', 'url'=>array('/admin/settings/descriptions')),
        array('label'=>'Управление параметрами', 'url'=>array('/admin/setting/index')),
        array('label'=>'Управление линками соц. сетей', 'url'=>array('/admin/socialNetworkLink/index')),

    );

    public function getSubMenu()
    {
        return array(
            array('label'=> Yii::t('core/admin','Create params'), 'url'=>array('create')),
        );
    }

    public function actionIndex()
    {
        $params = require(Yii::app()->basePath.'/config/params.php');
        $paramsDesc = Params::model()->findAll();
        if (isset($_POST['save'])) {
            $configArray = array();
            foreach ($paramsDesc as $desc) {
                if (isset($_POST[$desc->key]))
                    $configArray[$desc->key] = $_POST[$desc->key];
            }
            $configString = "<?php\n return " . var_export($configArray, true) . " ;\n?>";
            $paramsFile = Yii::app()->basePath.'/config/params.php';
            $config = fopen($paramsFile, 'w+');
            if ($config)
            {
                fwrite($config, $configString);
                fclose($config);
                @chmod($paramsFile, 0666);
            }
            $this->redirect(array('index'));

        }
        $this->render('index', array(
            'params'=>$params,
            'paramsDesc'=>$paramsDesc
        ));
    }

    public function actionDescriptions()
    {
        $model = new Params();
        $this->render('descriptions', array(
            'model'=>$model
        ));
    }

    public function actionCreate()
    {
        $model = new Params();
        if (isset($_POST['Params'])) {
            $model->attributes = $_POST['Params'];
            if ($model->save())
                $this->redirect(array('descriptions'));
        }
        $this->render('create', array('model'=>$model));

    }

    public function actionUpdateField()
    {
        Yii::import('ext.bootstrap.widgets.TbEditableSaver');
        $es = new TbEditableSaver('Params');
        $es->update();
    }
}