<?php

namespace app\core;

use app\routes\Routes;
use app\support\RequestType;
use app\support\Uri;

class RouterFilters 
{
    private string $uri;
    private string $method;
    private array $routesRegistered;

    public function __construct()
    {
        $this->uri = Uri::get();
        $this->method = RequestType::get();
        $this->routesRegistered = Routes::get();
    }
    private function simpleRouter()
    {
        if (array_key_exists($this->uri, $this->routesRegistered[$this->method])) {
            return $this->routesRegistered[$this->method][$this->uri];
        }
        return "NotFoundController@index";
    }
    private function dynamicRouter()
    {
        foreach ($this->routesRegistered[$this->method] as $index => $route) {
            $regex = str_replace("/", "\/", ltrim($index, "/"));
            if(preg_match("/^$regex$/", trim($this->uri, "/"))){
                return $route;  
            }
        }
        return "NotFoundController@index";
        
    }
    public function get()
    {
        return  $this->dynamicRouter();
    }
}
