<?php
/*@var $r \FastRoute\RouteCollector */
$r->addRoute('POST', 'post', 'post');
$r->addRoute('GET', 'users', 'users/index');
$r->addRoute('GET', 'login', ['login','index']);

$r->addRoute('GET', '/user/{name}/{id:[0-9]+}', 'handler0');
$r->addRoute('GET', '/user/{id:[0-9]+}', 'handler1');
$r->addRoute('GET', '/user/{name}', 'handler2');
