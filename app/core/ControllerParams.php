<?php

namespace app\core;

use app\routes\Routes;
use app\support\RequestType;
use app\support\Uri;

class ControllerParams 
{

    public function get(string $router)
    {
        $uri = Uri::get();
        $requestMethod = RequestType::get();
        $routes = Routes::get();
        $indexRouter = array_search($router, $routes[$requestMethod]);
        $explodeUri = explode("/",ltrim($uri,"/"));
        $explodeIndexRouter = explode("/",ltrim($indexRouter,"/"));

        $params = [];
        foreach ($explodeIndexRouter as $index => $routerSeparate) {
            if($routerSeparate != $explodeUri[$index]){
                $params[] = $explodeUri[$index];
            }
        }
        return $params;  
    }
}
