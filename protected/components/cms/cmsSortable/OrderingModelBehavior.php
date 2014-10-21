<?php
/**
 * Created by PhpStorm.
 * User: peter
 * Date: 09.09.13
 * Time: 14:50
 */

class OrderingModelBehavior extends CActiveRecordBehavior
{
    public $attribute = 'ordering';

    public function beforeSave($event)
    {
        $owner = $this->owner;
        if ($owner->isNewRecord) {
            $count = $owner->count();
            $owner->{$this->attribute} = $count + 1;
        }
        $event->isValid = true;
    }

    public function afterDelete($event)
    {
        $current_ordering = $this->owner->{$this->attribute};
        CActiveRecord::model(get_class($this->owner))->updateCounters(array($this->attribute=>-1), $this->attribute.' > '.$current_ordering);
    }


    public function attach($owner) {
        parent::attach($owner);
        $validators = $this->owner->getValidatorList();
        $validator = CValidator::createValidator('safe', $this->owner, $this->attribute);
        $validators->add($validator);
    }

} 