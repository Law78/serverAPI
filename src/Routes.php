<?php

$router->add('/', ['controller' => 'home'], 'GET');
$router->add('/beeps', ['controller' => 'Beeps']);
$router->add('/beeps/get', ['controller' => 'Beeps', 'action' =>'get', 'method'=>'GET'], 'GET');
$router->add('/beeps/errore', ['controller' => 'Beeps', 'action' =>'errore', 'method'=>'GET'], 'GET');
$router->add('/beeps/{id}/like', ['controller' => 'Beeps', 'action' =>'like', 'method'=>'GET'], 'GET');
$router->add('/beeps/{id}', ['controller' => 'Beeps', 'action' =>'prendo id', 'method'=>'GET'], 'GET');
/*
echo '<pre>';
var_dump($router->getRoutes());
echo '</pre>';
*/