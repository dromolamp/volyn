<?php
/**
 * This file is part of Furia CMS.
 *
 * @author     Firs Yuriy <info@furiacms.com>
 * @copyright  Copyright (C) 2012-2013 FuriaCMS
 * @license    http://www.gnu.org/licenses/lgpl-3.0.txt GNU LESSER GENERAL PUBLIC LICENSE (LGPL) version 3
 * @link       http://www.furiacms.com   FuriaCMS.com
 */

$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/install.php';

if (file_exists(dirname(__FILE__).'/protected/config/main.php'))
    header( 'Location: index.php' ) ;

require_once($yii);
Yii::createWebApplication($config)->run();
