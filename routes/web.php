<?php

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'v1/users'], function () use ($router) {
    $router->get('list','UserController@list');
    $router->get('show/{id}','UserController@show');
    $router->post('create','UserController@create');
    $router->post('update','UserController@update');
    $router->post('delete','UserController@delete');
});
