<?php
/**
 * Created by PhpStorm.
 * User: peter
 * E-mail: petro.stasuk.990@gmail.com
 * Date: 27.01.14
 * Time: 14:39
 */
?>
<span class="auth-service">
    <a href="<?php echo Yii::app()->controller->createUrl($action, array('service'=>'twitter'))?>" class="twitter">twitter</a>
    <a href="<?php echo Yii::app()->controller->createUrl($action, array('service'=>'vkontakte'))?>" class="vk">vk</a>
    <a href="<?php echo Yii::app()->controller->createUrl($action, array('service'=>'facebook'))?>" class="fc">fc</a>
    <a href="<?php echo Yii::app()->controller->createUrl($action, array('service'=>'mailru'))?>" class="mail">mail</a>
    <a href="<?php echo Yii::app()->controller->createUrl($action, array('service'=>'odnoklassniki'))?>" class="odn">odn</a>
</span>