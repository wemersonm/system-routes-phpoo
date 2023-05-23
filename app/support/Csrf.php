<?php

namespace app\support;

use app\core\Request;
use Exception;

class Csrf
{
    public static function getToken(){

        if(isset($_SESSION['csrfToken'])){
            unset($_SESSION['csrfToken']);
        }

        $_SESSION['csrfToken'] = md5(uniqid());
        return "<input type='hidden' name='csrfToken' value='{$_SESSION['csrfToken']}'>";
    }
    public static function validateToken(){

        if(!isset($_SESSION['csrfToken'])){
            throw new Exception("Token invalido :#");
        }

      $token = Request::only("csrfToken");

      if($_SESSION['csrfToken'] != $token){
        throw new Exception("Token invalido :#");
      }
      unset($_SESSION['csrfToken']);
    }
}