<?php 

namespace app\controllers;
use League\Plates\Engine;
use Exception;

abstract class Controller{

    protected  function view(string $view, array $data){
        $viewPath = '../app/views/'.$view.'.php';
        if(!file_exists($viewPath)){
            throw new Exception("A view {$view} não existe");
        }
         
        $templates = new Engine('../app/views');
        echo $templates->render($view, $data);
    }

  
}