<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.08.13
 * Time: 12:34
 */

class AdminMailController extends CmsAdminController {
    public $menuTitle = "Название модуля";
    public $menu = array(
        array('label'=>'Управление рассылками', 'url'=>array('admin/default/index')),
    );
    public $subMenuTitle = "Действия";
    public $subMenu = array(
        array('label'=>'Добавить письмо', 'url'=>array('create')),
    );
} 