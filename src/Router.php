<?php

namespace ServerAPI;

use ServerAPI\Controllers\Beeps;
use ServerAPI\ApiExceptions\ApiException;

class Router {
  /**
  * Array Associativo delle routes (la tabella dell'instradamento)
  * @var array
  */
  protected $routes = [];
  /**
  * Parametri restituiti dalla route richiesta
  * @var array
  */
  protected $params = [];
  /**
  * Aggiunge una route alla tabella dei routes
  *
  * @param string $route Rappresenta l'URL del route
  * @param array $params Parametri (controller, action, ecc...)
  *
  * @return void
  */
  public function add($route, $params = [], $method = 'GET'){
    // Cerco una / e la trasformo in \/
    //echo('<br/>'.$route);
    //echo $route;
    $route = preg_replace('/\//','\\/', $route);
    $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
    $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
    //$route = preg_replace('/\{(id+)\}/', '(?P<\1>\2[0-9]+)', $route);
    //echo preg_match('/\{(id+)\}/', $route);
    //$route = preg_replace('/([a-z]+)/', '(?P<\1>[a-z-]+)', $route);

    //$route = preg_replace('/\{([a-z]+)\}/', 'fottiti', $route);
    //echo '<br/>pre: ' . $route;
    $route = '/^' . $method . $route . '$/i';
    
    //echo 'convertita in: ' . $route;
    //echo preg_match('/\/[a-z]+\/[a-z]+/', $route);
    $this->routes[$route] = $params;
  }
  /**
  * Prende tutte le routes dalla tabella di instradamento
  */
  public function getRoutes(){
    return $this->routes;
  }
  /**
  */
  public function match($url){
   
    foreach ($this->routes as $route => $params){
      if(preg_match($route, $url, $matches)){
        foreach($matches as $key => $match){
          if(is_string($key)){
            $params[$key] = $match;
          }
        }
        $this->params = $params;
        return true;
      }
    }
    return false;
  }
  /**
  */
  public function getParams(){
    return $this->params;
  }
  /**
  */
  public function dispatch($url){
    if($this->match($url)){
      var_dump($this->params);
      $controller = $this->params['controller'];
      $controller = $this->convertToStudlyCaps($controller);
      $controller = $this->getNamespace() . $controller;
      
      if (class_exists($controller)) {
        if(isset($this->params['action'])){
          $action = $this->params['action'];
        } else {
          $action = 'index';
        }
        $controller_object = new $controller($this->params);
        
        
        $action = $this->convertToCamelCase($action);

        if (is_callable([$controller_object, $action])) {
          $res = $controller_object->$action();
          return $res;
        } else {
          throw new ApiException(405, ['Metodo non presente']);        }
      } else {
        throw new ApiException(406, ['Richiesta non accettabile']);
      }
    } else {
      throw new ApiException(404, ['Route non presente']);
      //throw new \Exception('No route matched.', 404);
    }
  }

   /**
  * Convert the string with hyphens to StudlyCaps,
  * e.g. post-authors => PostAuthors
  *
  * @param string $string The string to convert
  *
  * @return string
  */
  protected function convertToStudlyCaps($string)
  {
    return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
  }
   /**
  * Convert the string with hyphens to camelCase,
  * e.g. add-new => addNew
  *
  * @param string $string The string to convert
  *
  * @return string
  */
  protected function convertToCamelCase($string)
  {
    return lcfirst($this->convertToStudlyCaps($string));
  }
  /**
  * Get the namespace for the controller class. The namespace defined in the
  * route parameters is added if present.
  *
  * @return string The request URL
  */
  protected function getNamespace()
  {
    $namespace = 'ServerAPI\Controllers\\';
    if (array_key_exists('namespace', $this->params)) {
        $namespace .= $this->params['namespace'] . '\\';
    }
    return $namespace;
  }
  

}   

/*
METHOD, URI, CONTROLLER, ACTION
*/