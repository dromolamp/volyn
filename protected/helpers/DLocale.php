<?php
/**
 * Created by PhpStorm.
 * User: mukolla
 * Date: 16.04.14
 * Time: 10:38
 */

class DLocale {
    public static function dateFormatter($pattern = 'd MMMM yyyy', $data)
    {
        return Yii::app()->getLocale(Yii::app()->language == 'ua' ? 'uk' : Yii::app()->language)->dateFormatter->format($pattern, $data);
    }
} 