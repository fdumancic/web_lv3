<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', 'UserController@read')->name('users');

Route::get('/users/{id}/projects', 'UserController@showUserProjects');

Route::get('/myprojects', 'UserController@showMyProjects');

Route::post('/projects', 'ProjectController@store');

Route::put('/project/{id}', 'ProjectController@update');