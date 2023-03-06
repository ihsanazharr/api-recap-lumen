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

$router->post('api/register', ['uses'=>'AuthController@register']);
$router->post('api/login', ['uses'=>'AuthController@login']);
$router->group( ['prefix' => 'api'] , function() use($router) {
    
    //Role
    $router->get('role', ['uses' => 'RoleController@index']);
    $router->get('role/{id}', ['uses' => 'RoleController@show']);
    $router->post('role', ['uses' => 'RoleController@create']);
    $router->put('role/{id}', ['uses' => 'RoleController@update']);
    $router->delete('role/{id}', ['uses' => 'RoleController@destroy']);

    //User
    $router->get('user', ['uses' => 'UserController@index'] );
    $router->get('user/{id}', ['uses' => 'UserController@show']);
    $router->get('search-user/{nama}', ['uses' => 'UserController@search']);
    $router->put('user/{id}', ['uses' => 'UserController@update']);
    $router->delete('user/{id}', ['uses' =>'UserController@destroy']);
    $router->post('upload-user/{id}', ['uses'=>'UserController@upload']);


    //Pekerjaan
    $router->get('pekerjaan', ['uses' => 'PekerjaanController@index']);
    $router->get('pekerjaan/{idUser}', ['uses' => 'PekerjaanController@show']);
    $router->get('search-pekerjaan/{bulan}', ['uses' => 'PekerjaanController@search']);
    $router->post('pekerjaan', ['uses' => 'PekerjaanController@create']);
    $router->put('pekerjaan/{id}', ['uses' => 'PekerjaanController@update']);
    $router->delete('pekerjaan/{id}', ['uses' => 'PekerjaanController@destroy']);


    //Detail Pekerjaan
    $router->get('detailpk', ['uses' => 'DetailPekerjaanController@index']);
    $router->get('detailpk/{id}', ['uses' => 'DetailPekerjaanController@show']);
    $router->get('search-detailpk/{namaPekerjaan}', ['uses' => 'DetailPekerjaanController@search']);
    $router->post('detailpk', ['uses' => 'DetailPekerjaanController@create']);
    $router->put('detailpk/{id}', ['uses' => 'DetailPekerjaanController@update']);
    $router->delete('detailpk/{id}', ['uses' => 'DetailPekerjaanController@destroy']);
    

});


