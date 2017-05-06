
<?php

ini_set("display_errors", "on");
//error_reporting(E_ALL);
date_default_timezone_set('UTC');


// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';
$global=dirname(__FILE__).'/protected/global/helpers.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);
require_once($global);
Yii::createWebApplication($config)->run();

?>
