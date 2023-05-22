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
        $fieldsPostKeys = array_keys($fieldsPost);

        if (is_string($only)) {
            return $fieldsPost[$only];
        }
        foreach ($fieldsPostKeys as $index => $value) {
            if (!in_array($value, $only)) {
                unset($fieldsPost[$value]);
            }
        }
        return $fieldsPost;
    }

    public static function except(string|array $excepts)
    {
        $fieldsPost = Request::all();
        $fieldsPostKeys = array_keys($fieldsPost);
        if (is_array($excepts)) {
            foreach ($fieldsPostKeys as $index => $value) {
                if (in_array($value, $excepts)) {
                    unset($fieldsPost[$value]);
                }
            }
            return $fieldsPost;
        }
        unset($fieldsPost[$excepts]);
        return $fieldsPost;
    }

    public static function query($name){
        if(!isset($_GET[$name])){
            throw new Exception("Não existe GET {$name}");
        }
        return $_GET[$name];
    }
    public static function toJson(array $data){
        return json_encode($data);
    }
    public static function toArray($data){
        return json_decode($data);
    }

    
    
}
