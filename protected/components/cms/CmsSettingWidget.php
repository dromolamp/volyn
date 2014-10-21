<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14.02.13
 * Time: 11:06
 * To change this template use File | Settings | File Templates.
 */
class CmsSettingWidget extends CWidget
{
    public $model;
    public $attribute;
    public $attributesNames = true;

    public function init()
    {
        $this->fetchAttributes ($this->attributesNames);
    }

    public function fetchAttributes ($attributes, $parent='')
    {
        if (is_array($attributes)) {
            foreach ($attributes as $key=>$value) {
                if (!isset($value['name'])) {
                    $this->fetchAttributes($value, $key);
                } else {
                    $this->rendFormElement($key, $value, $parent);
                }
            }
        }
    }

    public function rendFormElement ($key,$value, $parent)
    {
        if ($key==='blockTitle')
            echo CHtml::tag("h4", array(), $value);
        else {

            echo CHtml::activeLabel($this->model, $this->attribute.($parent ? '['.$parent.']' : '').'['.$key.']', array('label'=>$value['name']));

            switch ($value['type']) {

                case 'password':
                    echo CHtml::activePasswordField($this->model, $this->attribute.($parent ? '['.$parent.']' : '').'['.$key.']');
                    break;

                case 'number':
                    echo CHtml::activeTextField($this->model, $this->attribute.($parent ? '['.$parent.']' : '').'['.$key.']');
                    break;

                case 'text':
                    echo CHtml::activeTextArea($this->model, $this->attribute.($parent ? '['.$parent.']' : '').'['.$key.']');
                    break;

                case 'list':
                    echo CHtml::activeDropDownList(
                        $this->model,
                        $this->attribute.($parent ? '['.$parent.']' : '').'['.$key.']',
                        is_array($value['values']) ? $value['values'] : array()
                    );
                    break;

                case 'boolean':
                    echo CHtml::activeCheckBox($this->model, $this->attribute.($parent ? '['.$parent.']' : '').'['.$key.']');
                    break;

                case 'select':
                    if (isset($value['import']))
                        Yii::import($value['import']);
                    echo Chtml::activeDropDownList(
                        $this->model,
                        $this->attribute.($parent ? '['.$parent.']' : '').'['.$key.']',
                        CHtml::listData($value['model']::model()->findAllByAttributes(isset($value['criteria']) ? $value['criteria'] : array()), $value['valueAttribute'], $value['titleAttribute'])
                    );
                    break;

                default:
                    echo CHtml::activeTextField($this->model, $this->attribute.($parent ? '['.$parent.']' : '').'['.$key.']');
            }
        }
    }
}
