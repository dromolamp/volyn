<?php
return array(
    'order'=>'2',
    'rules'=>array(
        '/gii/<controller:\w+>/<id:\d+>'=>'/gii/<controller>/view',
        '/gii/<controller:\w+>/<action:\w+>'=>'/gii/<controller>/<action>',
        '/gii/<controller:\w+>'=>'/gii/<controller>/index',
        '/gii/<controller:\w+>/<action:\w+>/<id:\d+>'=>'/gii/<controller>/<action>',
        '/gii'=>'/gii/default/index',
    )
);