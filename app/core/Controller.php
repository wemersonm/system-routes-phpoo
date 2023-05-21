<?php

namespace app\core;
namespace app\core;

use Exception;

class Controller
{
    public function execute(string $router)
    {
        if(substr_count($router,"@") <= 0){
            throw new Exception("A rota foi registrada incorretamente");
        }
        
        $explodeRouter = explode("@",$router);
        list($controller,$method) = $explodeRouter;
        
        $namespace = "app\\controllers\\";
        $controllerWithNamespace = $namespace.$controller;
        
        if(!class_exists($controllerWithNamespace)){
            throw new Exception("A classe do controller {$controllerWithNamespace} não existe");
        }
        $constrollerInstance = new $controllerWithNamespace;
        if(!\method_exists($constrollerInstance,$method)){
            throw new Exception("O método {$method} do controller {$controllerWithNamespace} não existe");
        }
        
        $params = new ControllerParams;
        $params = $params->get($router);
        return $constrollerInstance->$method($params);
    
    }
}
