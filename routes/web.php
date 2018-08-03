<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'LoginController@get')->name('login');
Route::post('/login', 'LoginController@post')->name('login.proccess');

Route::get('/administrator', 'Administrator\HomeController@index')->name('administrator.home');

Route::get('/administrator/administrator', 'Administrator\AdministratorController@listing')->name('administrator.administrator.listing');
Route::get('/administrator/administrator/{id}', 'Administrator\AdministratorController@read')->name('administrator.administrator.read');
Route::get('/administrator/administrator/create', 'Administrator\AdministratorController@createView')->name('administrator.administrator.createView');
Route::post('/administrator/administrator/create', 'Administrator\AdministratorController@createProcess')->name('administrator.administrator.createProcess');
Route::get('/administrator/administrator/{id}/update', 'Administrator\AdministratorController@updateView')->name('administrator.administrator.updateView');
Route::post('/administrator/administrator/{id}/update', 'Administrator\AdministratorController@updateProcess')->name('administrator.administrator.updateProcess');
Route::get('/administrator/administrator/{id}/delete', 'Administrator\AdministratorController@deleteView')->name('administrator.administrator.deleteView');
Route::post('/administrator/administrator/{id}/delete', 'Administrator\AdministratorController@deleteProcess')->name('administrator.administrator.deleteProcess');

Route::get('/administrator/instructor', 'Administrator\InstructorController@listing')->name('administrator.instructor.listing');
Route::get('/administrator/instructor/{id}', 'Administrator\InstructorController@read')->name('administrator.instructor.read');
Route::get('/administrator/instructor/create', 'Administrator\InstructorController@createView')->name('administrator.instructor.createView');
Route::post('/administrator/instructor/create', 'Administrator\InstructorController@createProcess')->name('administrator.instructor.createProcess');
Route::get('/administrator/instructor/{id}/update', 'Administrator\InstructorController@updateView')->name('administrator.instructor.updateView');
Route::post('/administrator/instructor/{id}/update', 'Administrator\InstructorController@updateProcess')->name('administrator.instructor.updateProcess');
Route::get('/administrator/instructor/{id}/delete', 'Administrator\InstructorController@deleteView')->name('administrator.instructor.deleteView');
Route::post('/administrator/instructor/{id}/delete', 'Administrator\InstructorController@deleteProcess')->name('administrator.instructor.deleteProcess');

Route::get('/administrator/user', 'Administrator\UserController@listing')->name('administrator.user.listing');
Route::get('/administrator/user/{id}', 'Administrator\UserController@read')->name('administrator.user.read');
Route::get('/administrator/user/create', 'Administrator\UserController@createView')->name('administrator.user.createView');
Route::post('/administrator/user/create', 'Administrator\UserController@createProcess')->name('administrator.user.createProcess');
Route::get('/administrator/user/{id}/update', 'Administrator\UserController@updateView')->name('administrator.user.updateView');
Route::post('/administrator/user/{id}/update', 'Administrator\UserController@updateProcess')->name('administrator.user.updateProcess');
Route::get('/administrator/user/{id}/delete', 'Administrator\UserController@deleteView')->name('administrator.user.deleteView');
Route::post('/administrator/user/{id}/delete', 'Administrator\UserController@deleteProcess')->name('administrator.user.deleteProcess');

Route::get('/administrator/group', 'Administrator\GroupController@listing')->name('administrator.group.listing');
Route::get('/administrator/group/{id}', 'Administrator\GroupController@read')->name('administrator.group.read');
Route::get('/administrator/group/create', 'Administrator\GroupController@createView')->name('administrator.group.createView');
Route::post('/administrator/group/create', 'Administrator\GroupController@createProcess')->name('administrator.group.createProcess');
Route::get('/administrator/group/{id}/update', 'Administrator\GroupController@updateView')->name('administrator.group.updateView');
Route::post('/administrator/group/{id}/update', 'Administrator\GroupController@updateProcess')->name('administrator.group.updateProcess');
Route::get('/administrator/group/{id}/delete', 'Administrator\GroupController@deleteView')->name('administrator.group.deleteView');
Route::post('/administrator/group/{id}/delete', 'Administrator\GroupController@deleteProcess')->name('administrator.group.deleteProcess');