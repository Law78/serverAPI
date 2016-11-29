<?php
//https://nikic.github.io/2014/02/18/Fast-request-routing-using-regular-expressions.html

//$router->add('/');
//$router->add('/controller/action');
//$router->add('/beeps/{controller}/{action}');
$router->add('/{controller}/action/{id:\d+}');
//$router->add('/', ['controller' => 'home'], 'GET');
$router->add('/beeps', ['controller' => 'Beeps']);
$router->add('/beeps/get', ['controller' => 'Beeps', 'action' =>'get', 'method'=>'GET'], 'GET');
//$router->add('/beeps/errore', ['controller' => 'Beeps', 'action' =>'errore', 'method'=>'GET'], 'GET');
$router->add('/beeps/{id:\d+}/{metodo}', ['controller' => 'Beeps', 'action' =>'like', 'method'=>'GET'], 'GET');
$router->add('/beeps/{action}/{id:\d+}', ['controller' => 'Beeps', 'action' =>'get'], 'GET');
//$router->add('/beeps/{id}', ['controller' => 'Beeps', 'action' =>'get', 'method'=>'GET'], 'GET');
/*
echo '<pre>';
var_dump($router->getRoutes());
echo '</pre>';
*/