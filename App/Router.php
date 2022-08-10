<?php

namespace App\Core;

class Router{

  public $routes =[

      "GET"=>[],

      "POST"=>[]
  ];

  public function get($uri,$controller){

    $this->routes['GET'][$uri] = $controller;
  }

  public function post($uri,$controller){

    $this->routes['POST'][$uri] = $controller;
  }



  public static function load($file){

    $router = new static;

    require $file;

    return $router;
  }

  public function direct($url,$requestType){
    
    if(array_key_exists($url,$this->routes[$requestType])){
      

      return $this->callActon(
        ...explode('@',$this->routes[$requestType][$url])
      );

    }else{

      throw new \Exception("no routes find in this URL");

    }
  }
  public function callActon($controller,$action){
    
    $controller ="App\\Controllers\\{$controller}" ;
    $controller = new $controller;


    if(!method_exists($controller,$action)){
      throw new \Exception("{$controller} does not response {$action} action");
    }
    return (new $controller)->$action();

  }

}