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
    return response()->json([
        'success' => true,
        'message' => "Welcome to lumen based book api",
    ]);
});

$router->post('/login', 'LoginController@index');
$router->post('/register', 'UserController@register');
$router->get('/user/{id}', ['middleware' => 'auth', 'uses' => 'UserController@getUser']);

$router->get('/category', 'CategoryController@index');
$router->post('/category/create', 'CategoryController@create');
$router->get('/category/{id}', 'CategoryController@show');
$router->put('/category/update/{id}', 'CategoryController@update');
$router->delete('/category/delete/{id}', 'CategoryController@delete');

$router->get('/book', 'BookController@index');
$router->post('/book/create', 'BookController@create');
$router->get('/book/{id}', 'BookController@show');
$router->put('/book/update/{id}', 'BookController@update');
$router->delete('/book/delete/{id}', 'BookController@delete');