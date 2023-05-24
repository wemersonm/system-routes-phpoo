<?php

namespace app\traits;

use app\core\Request;
use app\database\models\User;
use app\support\FlashMessage;

trait Validations
{
    public function required(string $field, mixed $param)
    {
        $value = trim(strip_tags(Request::input($field)));
        if (empty($value)) {
            FlashMessage::setFlashMessage($field, "Preencha o campo corretamente");
            return false;
        }
        return $value;
    }
    public function maxLen(string $field, mixed $param)
    {
        $value = strip_tags(Request::only($field));
        if (strlen($value) > $param) {
            FlashMessage::setFlashMessage($field, "O campo pode ter apenas {$param} caracteres");
            return false;
        }
        return $value;
    }
    public function email(string $field, mixed $param)
    {
        
        $user = new User;
        $email = Request::input($field);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        
        if (!preg_match("/^[a-zA-z0-9.@_-]$/", $email) && !$email) {
            
            FlashMessage::setFlashMessage($field, "Insira um email valido");
            return false;
        }
       
        return strip_tags($email);
    }
    public function unique(string $field, string $param)
    {   
        $model = new $param;
        $email = Request::input($field);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        $data = $model->findBy($field, $email);
        if (!empty($data)) {
            FlashMessage::setFlashMessage($field, "Endereço de e-mail já está cadastrado no sistema");
            return false;
        }
        return strip_tags($email);
    }
    public function in(string $field, mixed $param)
    {

        $valuesAllowed = explode(",", $param);
        $valuesAllowed = array_map(function ($value) {
            return trim($value);
        }, $valuesAllowed);

        $fieldSelected = Request::input($field);

        if (!in_array($fieldSelected, $valuesAllowed)) {
            FlashMessage::setFlashMessage($field, "Selecione o campo corretamente");
            return false;
        }
        return $fieldSelected;
    }
}
