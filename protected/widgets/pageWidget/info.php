<?php
return array(
    'name'=>'pageWidget',
    'title'=>'pageWidget',
    'description'=>'Статическая страница',
    'version'=>'0.0.1',
    'author'=>array(
        'url'=>'http://web-logic.biz',
        'name'=>'Web-logic',
        'email'=>'i@web-logic.biz',
    ),
    'options'=>array(
        'page' => null,
    ),
    'editableAttributes'=>array(
        'page'=>array(
            'name'=>'Page',
            'type'=>'select',
            'model'=>'Page',
            'valueAttribute' =>'id',
            'titleAttribute' => 'title',
            'import'=>'application.models.Page',
            //'criteria'=>array('id'=>null),
        ),
    ),
);