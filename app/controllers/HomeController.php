<?php

namespace app\controllers;

use app\database\Filters;
use app\database\models\User;
use app\database\Pagination;

class HomeController extends Controller
{
    public function index()
    {


        $filters = new Filters;
        $user = new User;
        $pagination = new Pagination;
        $user->setFields("persons.id,persons.first_name,persons.last_name,persons.email");

        $filters->where('id', '<',50);
        $user->setFilters($filters);

        $data['data'] = $user->fetchAll();
        var_dump($data['data']);
        die;
        $pagination->setTotalItens($user->count());
        $pagination->setItensPerPage(10);

        $user->setPagination($pagination);
        
      
        $data['totalPages'] = $pagination->getTotalPages();
        $data['currentPage'] = $_GET['page'] ?? 1;

        $this->view('home', $data, "Pagina HOME");
    }
}
