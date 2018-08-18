<?php
/**
 * 执行应用
 */
define('IN_WWW'		 ,true);
define('ROOT_PATH'    ,realpath(__DIR__.'/../..'));
define('ROOT_CONFIG'  ,ROOT_PATH.'/config');

define('APP_DEBUG'			,true);
//define('APP_ERROR_LEVEL'	,E_ALL); // ^E_NOTICE
define('APP_ERROR_LEVEL'	,E_ALL ^E_NOTICE);

//composer
$Q_composer=require __DIR__.'/../vendor/autoload.php';
//require_once __DIR__.'/../../qingmvc2018/qingmvc07/autoload.php';

$configFile=__DIR__.'/config/main.php';
\qing\Qing::runWebApp($configFile);
?>