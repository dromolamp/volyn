<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 21.03.13
 * Time: 10:02
 * To change this template use File | Settings | File Templates.
 */

Yii::import('application.models.Language');

class CmsMultiLanguageWidget extends CWidget {

    public $model;
    public $viewItem;
    public $form;

    public function init()
    {
        $tabs = array();
        foreach ($this->model->languages as $modelLanguage) {
            $row = $this->owner->renderPartial($this->viewItem, array('model'=>$modelLanguage, 'form'=>$this->form), true);
            $tabs[] = array('label'=>$modelLanguage->language->title,'content'=>$row, 'active'=>(empty($tabs)? true:false));
        }
        $this->widget('bootstrap.widgets.TbTabs', array(
            'type'=>'tabs',
            'tabs'=>$tabs,
        ));
    }

}