<?php

namespace app\support;

use app\traits\Validations;
use Exception;

class Validate
{
    use Validations;

    private $validations = [];

    public function getMethodAndParams($validation, $param)
    {
        if (substr_count($validation, ":") > 0) { // existe param ?
            list($validation, $param) = explode(":", $validation);
            
        }
        return [$validation, $param];
    }

    public function methodValidationExists($validation)
    {
        if (!method_exists($this, $validation)) {
            throw new Exception("O método {$validation} não existe");
        }
    }
    private function uniqueValidation($validation, $field, $param)
    {
        list($validation, $param) = $this->getMethodAndParams($validation, $param);
        $this->methodValidationExists($validation);
        $this->validations[$field] = $this->$validation($field, $param);
    }
    private function multipleValidation($explodeValidations, $field, $param)
    {
        foreach ($explodeValidations as $index => $validation) {
            list($validation, $param) = $this->getMethodAndParams($validation, $param);
            
            $this->methodValidationExists($validation);
            $this->validations[$field] = $this->$validation($field, $param);
            
            if (!$this->validations[$field]) {
                break;
            }
        }
    }
    public function validations(array $data)
    {
        $param = '';
        foreach ($data as $field => $validation) {
            $havePipes = substr_count($validation, "|") == 0 ? false : true;
            if (!$havePipes) {
                $this->uniqueValidation($validation, $field, $param);
            } else {
                $explodeValidations = explode("|", $validation);
                $this->multipleValidation($explodeValidations, $field, $param);
            }
        }
        if (in_array(false, $this->validations)) {
            return false;
        }
       
        return $this->validations;
    }
}
