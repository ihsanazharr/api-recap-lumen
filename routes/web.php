<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\UserController;

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

$router->get('login', ['uses' => 'LoginController@index']);

// $router->group(['prefix' => 'auth'] , function() use($router) {
//     $router->post('register', 'AuthController@register');
//     $router->post('login', 'AuthController@login');
// });

$router->post('register', 'AuthController@register');
$router->post('login', 'AuthController@login');

$router->group( ['prefix' => 'api', 'middleware' => 'auth'] , function() use($router) {

    
    //Role
    $router->get('role', 'RoleController@index');
    $router->get('role/{id}','RoleController@show');
    $router->post('role', 'RoleController@create');
    $router->put('role/{id}', 'RoleController@update');
    $router->delete('role/{id}', 'RoleController@destroy');

    //User
    $router->get('user', 'UserController@index');
    $router->get('user/{id}', 'UserController@show');
    $router->get('search-user/{nama}', 'UserController@search');
    $router->put('user/{id}', 'UserController@update');
    $router->delete('user/{id}', 'UserController@destroy');
    $router->post('upload-user/{id}', 'UserController@upload');


    //Pekerjaan
    $router->get('pekerjaan',  'PekerjaanController@index');
    $router->get('pekerjaan/{idUser}',  'PekerjaanController@show');
    $router->get('search-pekerjaan/{bulan}',  'PekerjaanController@search');
    $router->post('pekerjaan',  'PekerjaanController@create');
    $router->put('pekerjaan/{id}',  'PekerjaanController@update');
    $router->delete('pekerjaan/{id}',  'PekerjaanController@destroy');


    //Detail Pekerjaan
    $router->get('detailpk',  'DetailPekerjaanController@index');
    $router->get('detailpk/{id}',  'DetailPekerjaanController@show');
    $router->get('search-detailpk/{namaPekerjaan}',  'DetailPekerjaanController@search');
    $router->post('detailpk',  'DetailPekerjaanController@create');
    $router->put('detailpk/{id}',  'DetailPekerjaanController@update');
    $router->delete('detailpk/{id}',  'DetailPekerjaanController@destroy');
    

});


