<?php

namespace app\controllers;

use app\database\Filters;
use app\database\models\User;

class HomeController extends Controller
{
    public function index()
    {


        $filters = new Filters;
        $user = new User;


        $filters->where("id", ">",500);
        $user->setFilters($filters);
        dd($user->count());



        //$this->view('home',[],"Pagina HOME");

    }
}
