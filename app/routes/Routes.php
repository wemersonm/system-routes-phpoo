<?php

namespace app\routes;

class Routes
{
    public static function get()
    {
        return [
            'GET' => [
                '/' => 'HomeController@index',
                '/user/[0-9]+' => "UserController@edit",
                '/contact' => "ContactController@index"
            ],
            'POST' => [
                '/user/update' => 'UserController@update',
                '/contact' => 'ContactController@send'
            ]
        ];
    }
}
