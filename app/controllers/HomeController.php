<?php

namespace app\controllers;

class HomeController extends Controller
{
    public function index()
    {
        $this->view('home', [
            'nome' => 'LIONEL MESSI',
            'title' => 'Home page'
        ]);
    }
}
