<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 21.03.13
 * Time: 11:32
 * To change this template use File | Settings | File Templates.
 */

class MultiLanguageBehavior extends CActiveRecordBehavior
{

    protected $_languages = array();

    public function getLanguages()
    {
        $className = get_class($this->owner);

        if (!empty($this->_languages)) {
            return $this->_languages;
        } else {
            $langs = Language::model()->findAll(
                array(
                    'order'=>'status DESC',
                    'condition'=>"status != :status",
                    'params'=>array(':status'=>Language::STATUS_NO_PUBLISHED)
                )
            );

            foreach ($langs as $lang) {
                if($lang->status == Language::STATUS_SYSTEM) {
                    $this->_languages[$lang->name] = $this->owner;
                } else {
                    if ($this->owner->isNewRecord) {
                        $this->_languages[$lang->name] = new $className();
                    } else {
                        $model = $this->owner->findByAttributes(array(
                            'parent_id'=>$this->owner->id,
                            'lang_id'=>$lang->id
                        ));
                        if ($model===null) {
                            $model = new $className();
                        }
                        $this->_languages[$lang->name] = $model;
                    }
                }
                $this->_languages[$lang->name]->lang_id = $lang->id;
            }
        }
        return $this->_languages;
    }

    public function beforeValidate($event)
    {
        $return = true;
        if ($this->owner->lang_id==Language::systemId()) {
            $langs = Language::model()->findAll("status != :status", array(':status'=>Language::STATUS_NO_PUBLISHED));
            foreach ($langs as $lang) {
                $isAllEmpty = true;
                foreach ($this->owner->multilanguageField as $field) {
                    $isAllEmpty = $isAllEmpty&&empty($this->languages[$lang->name]->$field);
                }
                if ($lang->status != Language::STATUS_SYSTEM && $isAllEmpty == false) {
                    $return = $this->languages[$lang->name]->validate();
                }
                foreach ($this->owner->multiLanguageField as $field) {
                    if ($this->languages[$lang->name]->hasErrors($field)){
                        $this->languages[$lang->name]->clearErrors($field);
                        $this->languages[$lang->name]->addErrors(array(
                            $field=>'Enter '.$field.' for language '.$lang->title,
                        ));
                        $return = false;
                    }
                }
            }
        }
        $event->isValid = $return;
    }

    public function afterSave()
    {
        if($this->owner->parent_id==null) {
            $systemLanguage = Language::model()->findByAttributes(array('status'=>Language::STATUS_SYSTEM));
            if ($this->owner->isNewRecord) {
                foreach ($this->languages as $lang=>$childModel) {
                    $isAllEmpty = true;
                    foreach ($this->owner->multilanguageField as $field) {
                        $isAllEmpty = $isAllEmpty&&empty($childModel->$field);
                    }
                    if ($lang != $systemLanguage->name && $isAllEmpty == false) {
                        $childModel->parent_id = $this->owner->id;
                        if (isset($this->owner->seo_link))
                            $childModel->seo_link = $this->owner->seo_link;
                        if (isset($this->owner->status))
                            $childModel->status = $this->owner->status;
                        $childModel->save(false);
                    }
                }
            } else {
                foreach ($this->languages as $lang=>$model) {
                    $isAllEmpty = true;
                    foreach ($this->owner->multilanguageField as $field) {
                        $isAllEmpty = $isAllEmpty&&empty($model->$field);
                    }
                    if ($lang != $systemLanguage->name && $isAllEmpty == false) {
                        $model->parent_id = $this->owner->id;
                        if (isset($this->owner->seo_link))
                            $model->seo_link = $this->owner->seo_link;
                        if (isset($this->owner->status))
                            $model->status = $this->owner->status;
                        $model->save(false);
                    }
                    $oldModel = $this->owner->findByAttributes(array(
                        'parent_id'=>$this->owner->id,
                        'lang_id'=>$model->lang_id,
                    ));
                    if ($lang != $systemLanguage->name && !empty($oldModel) && $isAllEmpty == true) {
                        $model->deleteByPk($model->id);
                    }
                }
            }
        }
    }

    public function setMultiLanguageData($data)
    {
        $langs = Language::model()->findAll(array(
            'order'=>'status DESC',
            'condition'=>"status != :status",
            'params'=>array(':status'=>Language::STATUS_NO_PUBLISHED)
        ));
        foreach ($langs as $lang) {
            $this->languages[$lang->name]->attributes = $data;
            $this->languages[$lang->name]->attributes = $data[$lang->name];
        }
    }

}