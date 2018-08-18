<?php
/**
 * @author xiaowang <736523132@qq.com>
 * @copyright Copyright (c) 2013 http://qingmvc.com
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */

function dump($var=''){
	echo "\n[1]------------------------\n";
	var_dump($var);
	echo "\n[2]------------------------\n";
}
function qexport($var,$filename){
	file_put_contents($filename,var_export($var,true)."\n\n",FILE_APPEND);
}
function qurl($url){
	return APP_URL.$url;
}

require_once __DIR__.'/Base.php';
require_once __DIR__.'/utils/Curl.php';


define('APP_URL','/qingmvc_demo/public/index.php/');

require_once __DIR__.'/../vendor/autoload.php';
//require __DIR__.'/../../qingmvc2018/qingmvc07/autoload.php';
?>