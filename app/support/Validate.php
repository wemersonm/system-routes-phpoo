<?php

namespace app\support;

use app\traits\Validations;
use Exception;

class Validate
{
    use Validations;

    public function validations(array $data)
    {
        $validations = [];
        $param = '';
        foreach ($data as $field => $validation) {
            if (substr_count($validation, "|") <= 0) { // validação unica
                if (substr_count($validation, ":")) { // existe param ?
                    list($validation, $param) = explode(":", $validation);
                }
                if (!method_exists($this, $validation)) {
                    throw new Exception("O método {$validation} não existe");
                }
                // chama a validation
                $validations[$field] = $this->$validation($field, $param);
            } else { // mais de 1 validação
                $explodeValidations = explode("|", $validation);

                foreach ($explodeValidations as $validation) {
                    if (substr_count($validation, ":")) {
                        list($validation, $param) = explode(":", $validation);
                    }
                    if (!method_exists($this, $validation)) {
                        throw new Exception("O método {$validation} não existe");
                    }
                    // chama a validation
                    $validations[$field] = $this->$validation($field, $param);
                }
            }
        }

        if (in_array(false, $validations)) {
            dd($validations);
            return false;
        }

        return $validations;
    }
}
