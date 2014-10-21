<?php
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'VOLYN',
    'charset'=>'utf-8',
    'sourceLanguage' => 'en',
    'language' => 'en',

    'preload'=>array('log'),

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.modules.*',
        'application.components.*',
        'application.components.cms.*',
        'application.helpers.*',
        'application.extensions.eoauth.*',
        'application.extensions.eoauth.lib.*',
        'application.extensions.lightopenid.*',
        'application.extensions.eauth.*',
        'application.extensions.eauth.services.*',
    ),

    'modules'=>require(dirname(__FILE__) . '/modules.php'),

    // application components
    'components'=>array(
        /*'swiftMailer' =>  array(
            'class' => 'application.modules.mailing.extensions.swiftMailer.SwiftMailer',
        ),*/
        'user'=>array(
            'class' => 'application.components.WebUser',
            'allowAutoLogin'=>true,
        ),
        'authManager' => array(
            'class' => 'application.components.cms.CmsAuthManager',
            'defaultRoles' => array('guest'),
            'itemTable' => '{{auth_item}}',
            'itemChildTable' => '{{auth_item_child}}',
            'assignmentTable' => '{{auth_assignment}}',
        ),
        'request'=>array(
            'class'=>'HttpRequest',
        ),
        'urlManager'=>array(
            'class'=>'application.components.DLanguageUrlManager',
            'urlFormat'=>'path',
            'showScriptName'=>false,
            'rules'=>array(
                // Site index
                '/'=>'site/index',
                'admin/<controller:\w+>/<action:\w+>'=>'admin/<controller>/<action>',
                'admin/<module>/<controller:\w+>/<action:\w+>'=>'<module>/admin/<controller>/<action>',
                'admin'=>'/admin/default/index',
                'feedback/<action:\w+>'=>'/feedback/<action>',
                'user/<action:\w+>'=>'/user/<action>',
                '/profile'=>'/lesson/profile/index',
                '/profile/update'=>'/lesson/profile/update',
                '/communication'=>'/lesson/message/index',

            ),
        ),
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=volin',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '123123',
            'charset' => 'utf8',
            'tablePrefix'=>'tbl_',
            'enableProfiling'=>true,
            'enableParamLogging'=>true,
        ),
        'cache'=>array(
            'class'=>'system.caching.CFileCache',
        ),
        'errorHandler'=>array(
            // use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        'image'=>array(
            'class' => 'application.extensions.image.CImageComponent',
            'driver'=>'GD',
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                /*array(
                    'class'=>'CWebLogRoute',
                ),*/
            ),
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>require(dirname(__FILE__) . '/params.php'),
    'theme'=>'volyn',
);