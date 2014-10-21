<?php
return array(
    'name'=>'mailing',
    'title'=>'Email рассылка',
    'description'=>'Модуль email рассылки',
    'version'=>'0.0.1',
    'author'=>array(
        'url'=>'http://web-logic.biz',
        'name'=>'Web-logic',
        'email'=>'i@web-logic.biz',
    ),
    'admin_controller'=>'/admin/default/index',
    'options'=>array(
        'host'=>null,
        'port'=>null,
        'login'=>null,
        'password'=>null
    ),
    'editableAttributes'=>array(
        'host'=>array(
            'name'=>'Сервер',
            'type'=>'string'
        ),
        'port'=>array(
            'name'=>'Порт',
            'type'=>'string'
        ),
        'login'=>array(
            'name'=>'Пользователь',
            'type'=>'string'
        ),
        'password'=>array(
            'name'=>'Пароль',
            'type'=>'password'
        ),
    )
);
