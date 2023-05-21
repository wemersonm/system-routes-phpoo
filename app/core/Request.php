<?php

namespace app\core;

use Exception;

class Request
{

    public static function input(string $name)
    {
        if (isset($_POST[$name])) {
            return $_POST[$name];
        }
        return throw new Exception("O indice {$name} não existe");
    }
    public static function all()
    {
        return $_POST;
    }

    public static function only(string|array $only)
    {
        $fieldsPost = Request::all();
        $fields = [];
        $fieldsPostKeys = array_keys($fieldsPost);
        
        if (is_string($only)) {
            $fields[$only] =  $fieldsPost[$only];
        }
         foreach ($fieldsPostKeys as $index => $value) {
           
        } 
        return  $fieldsPost;
       // return $fieldsPostKeys;
    }
}
//only => [0 => "email",
//         1 => "firstName"]