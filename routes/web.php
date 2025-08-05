<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/login', 'AuthController@login');
    $router->post('/register', 'AuthController@register');

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->get('/me', 'AuthController@index');
        $router->post('/logout', 'AuthController@logout');
        $router->post('/refresh', 'AuthController@refresh');
        
        $router->group(['middleware' => ['auth:api', 'role:admin']], function() use ($router) {
            $router->get('/users', 'userController@index');
            $router->post('/users/store', 'userController@store');
            $router->post('/users/update/{id}', 'userController@update');
            $router->post('/users/delete/{id}', 'userController@delete');
        });
    });
});
