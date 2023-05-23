<?php

namespace app\routes;

class Routes
{
    public static function get()
    {
        return [
            'GET' => [
                '/' => 'HomeController@index',
                '/user/[0-9]+' => "UserController@edit"
            ],
            'POST' => [
                '/user/update' => 'UserController@update'
            ]
        ];
    }
}
