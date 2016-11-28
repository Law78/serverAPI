<?php

namespace ServerAPI;

use ServerAPI\ApiExceptions\ApiException;

require __DIR__ . '/../vendor/autoload.php';

$url  = parse_url($_SERVER['REQUEST_URI']);

$url = $_SERVER['REQUEST_METHOD'].$url['path'];
//print_r($_SERVER['REQUEST_URI']);
//print_r($_SERVER['REQUEST_METHOD'] );

//require __DIR__ . '/../src/Router.php';

$router = new Router();

require __DIR__ . '/../src/Routes.php';

/*if($router->match($url)){
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
} else {
    echo '<br/>Nessuna router trovata!<br/>'; 
}*/


$json = '';

try {
  $json = $router->dispatch($url);
  header('Content-type: application/json');
  echo json_encode($json);
} catch (ApiException $e) {
  header('Content-type: application/json', true, $e->getCode());
  //$json = '{error: ' . '.'$e->getMessage() . ', code:' . $e->getCode(). '}';
  $json = "{error:{$e->getMessage()}, code:{$e->getCode()}}";
  echo json_encode($json);
}

/**
 * RESPONSE
 */
/*$response->setHeader('Content-Type', 'application/json');
foreach ($response->getHeaders() as $header) {
    header($header);
}
echo $response->getContent();*/

