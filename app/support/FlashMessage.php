<?php

namespace app\support;

class FlashMessage
{
    public static function setFlashMessage(string $field, string $message){
        if(!isset($_SESSION['flash'][$field])){
            $_SESSION['flash'][$field] = $message;
        }
    }
    public static function getFlashMessage(string $field){
      
        if(isset($_SESSION['flash'][$field])){
            $flash = $_SESSION['flash'][$field];
            unset($_SESSION['flash'][$field]);
            return $flash;
        }
        
    }
}