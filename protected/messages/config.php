<?php
/**
 * This is the configuration for generating message translations
 * for the Yii framework. It is used by the 'yiic message' command.
 */
return array(
	'sourcePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.'/modules/agrocorm',
	//'sourcePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.'/../themes/agrocorm',

	'messagePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'messages',
	'languages'=>array('ua', 'ru'),
	'fileTypes'=>array('php'),
	'overwrite'=>false,
    'removeOld'=>false,
	'exclude'=>array(
		'.svn',
		'.gitignore',
		'yiilite.php',
		'yiit.php',
		'/i18n/data',
		'/messages',
		'/vendors',
		'/web/js',
	),
);
