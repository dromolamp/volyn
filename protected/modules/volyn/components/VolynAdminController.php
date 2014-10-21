<?php

class VolynAdminController extends CmsAdminController
{
    public $menuTitle = "Управление контентом";
    public $menu = array(

        array('label'=>'Управление статьями', 'url'=>array('/volyn/admin/article/index')),
        array('label'=>'Управление продукцией', 'url'=>array('/volyn/admin/production/index')),

    );
    public $subMenuTitle = "Действия";
    public $subMenu = array(
        array('label'=>'Добавить статью', 'url'=>array('/volyn/admin/article/create')),
        array('label'=>'Добавить продукт', 'url'=>array('/volyn/admin/production/create')),
    );
} 