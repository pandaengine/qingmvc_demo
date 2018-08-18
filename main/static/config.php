<?php 
/**
 * 
 */
$staticDir=__DIR__.'/../../public/static';

$_config=[
	[
		'type'	=>'css',
		'files'	=>__DIR__.'/css/filelist',
		'cache'	=>$staticDir.'/main.css',
	],
	[
		'type'	=>'js',
		'files'	=>__DIR__.'/js/filelist',
		'cache'	=>$staticDir.'/main.js',
	],
];
return $_config;
?>