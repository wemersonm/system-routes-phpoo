<?php

namespace app\traits;

use app\core\Request;
use app\database\models\User;

trait Validations
{
    public function required(string $field, mixed $param = '')
    {
        $value = trim(strip_tags(Request::only($field)));
        if (!preg_match('/^[a-zA-z\s]{2,}$/', $value)) {
            // setar a flashMesasge
            return false;
        }
        return $value;
    }
    public function maxLen(string $field, mixed $param = '')
    {
        $value = strip_tags(Request::only($field));
        if (strlen($value) > 8) {
            // set FlashMessage
            return false;
        }
        return $value;
    }
    public function email(string $field, mixed $param = '')
    {
        $user = new User;
        $email = filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL);
        if (!preg_match("/^[a-zA-z0-9.@_-]$/",$email) && !$email) {
            // set FlashMessage
            return false;
        }
        return strip_tags($email);
    }
    public function unique(string $field, mixed $param = '')
    {
        $user = new User;
        $email = filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL);
        if (!preg_match("/^[a-zA-z0-9.@_-]$/",$email) && !$email) {
            // set FlashMessage
            return false;
        }
        $data = $user->findBy('email', $email);
        if (!empty($data)) {
            // set FlashMessage
            return false;
        }
        return strip_tags($email);
    }
}
