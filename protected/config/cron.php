<?php
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Cron',
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
        'application.modules.mailing.helpers.*',

    ),

    'modules'=>require(dirname(__FILE__) . '/modules.php'),

    // application components
    'components'=>array(
        'swiftMailer'=>array(
            'class'=>'application.modules.mailing.extensions.swiftMailer.SwiftMailer'
        ),
        'request'=>array(
            'class'=>'HttpRequest',
            'hostInfo' => 'http://academ.firs.org.ua',
            'baseUrl' => '',
            'scriptUrl' => '',
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
            'connectionString' => 'mysql:host=localhost;dbname=euroregionbug',
            'emulatePrepare' => true,
            'username' => 'euroregionbug',
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
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'cron.log',
                    'levels'=>'error, warning',
                ),
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'cron_trace.log',
                    'levels'=>'trace',
                ),
            ),
        ),
    ),
    'params'=>require(dirname(__FILE__) . '/params.php'),
);