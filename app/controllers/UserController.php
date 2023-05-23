<?php

namespace app\controllers;

use app\core\Request;
use app\support\Csrf;
use app\support\Validate;

class UserController extends Controller
{
    public function edit($params)
    {   
        
        $this->view('user', [
            'title' => 'Editar user'
        ]);
    }

    public function update($params){
        $validate = new Validate;
        $validations = $validate->validations([
            'firstName'=> 'required',
            'lastName' => 'required',
            'email' => 'email|unique',
            'gender' => 'required',
            'city' => 'required',
            'password'=> 'required|maxLen:8'
        ]);
dd($validations);
    }
}
