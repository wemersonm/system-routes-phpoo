<?php
namespace app\support;

class RequestType{

    public static function get(){
        return $_SERVER['REQUEST_METHOD'];
    }
}