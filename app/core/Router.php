<?php

namespace app\core;

use Exception;

class Router 
{

    public static function run()
    {
        try {
            $routerRegistered = new RouterFilters; 
            $router = $routerRegistered->get(); // rota exata

            $controller = new Controller;
            // PEGO A ROTA EXATA, o execute($rotaExata) vai destrinchar o controller@action e chamar a 
            // action  e retornar os dados da action e chamar as views e pegar os dados($DATA) aqui 
            return $controller->execute($router);



        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
}
