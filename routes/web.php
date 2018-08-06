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
Route::get('/logout', 'LogoutController@get')->name('logout');

Route::get('/administrator', 'Administrator\HomeController@index')->name('administrator.home');

Route::get('/administrator/administrator', 'Administrator\AdministratorController@listing')->name('administrator.administrator.listing');
Route::get('/administrator/administrator/{id}', 'Administrator\AdministratorController@read')->name('administrator.administrator.read')->where('id', '[1-9][0-9]*');
Route::get('/administrator/administrator/create', 'Administrator\AdministratorController@createView')->name('administrator.administrator.createView');
Route::post('/administrator/administrator/create', 'Administrator\AdministratorController@createProcess')->name('administrator.administrator.createProcess');
Route::get('/administrator/administrator/{id}/update', 'Administrator\AdministratorController@updateView')->name('administrator.administrator.updateView')->where('id', '[1-9][0-9]*');
Route::post('/administrator/administrator/{id}/update', 'Administrator\AdministratorController@updateProcess')->name('administrator.administrator.updateProcess')->where('id', '[1-9][0-9]*');
Route::get('/administrator/administrator/{id}/delete', 'Administrator\AdministratorController@deleteView')->name('administrator.administrator.deleteView')->where('id', '[1-9][0-9]*');
Route::post('/administrator/administrator/{id}/delete', 'Administrator\AdministratorController@deleteProcess')->name('administrator.administrator.deleteProcess')->where('id', '[1-9][0-9]*');

Route::get('/administrator/instructor', 'Administrator\InstructorController@listing')->name('administrator.instructor.listing');
Route::get('/administrator/instructor/{id}', 'Administrator\InstructorController@read')->name('administrator.instructor.read')->where('id', '[1-9][0-9]*');
Route::get('/administrator/instructor/create', 'Administrator\InstructorController@createView')->name('administrator.instructor.createView');
Route::post('/administrator/instructor/create', 'Administrator\InstructorController@createProcess')->name('administrator.instructor.createProcess');
Route::get('/administrator/instructor/{id}/update', 'Administrator\InstructorController@updateView')->name('administrator.instructor.updateView')->where('id', '[1-9][0-9]*');
Route::post('/administrator/instructor/{id}/update', 'Administrator\InstructorController@updateProcess')->name('administrator.instructor.updateProcess')->where('id', '[1-9][0-9]*');
Route::get('/administrator/instructor/{id}/delete', 'Administrator\InstructorController@deleteView')->name('administrator.instructor.deleteView')->where('id', '[1-9][0-9]*');
Route::post('/administrator/instructor/{id}/delete', 'Administrator\InstructorController@deleteProcess')->name('administrator.instructor.deleteProcess')->where('id', '[1-9][0-9]*');

Route::get('/administrator/user', 'Administrator\UserController@listing')->name('administrator.user.listing');
Route::get('/administrator/user/{id}', 'Administrator\UserController@read')->name('administrator.user.read')->where('id', '[1-9][0-9]*');
Route::get('/administrator/user/create', 'Administrator\UserController@createView')->name('administrator.user.createView');
Route::post('/administrator/user/create', 'Administrator\UserController@createProcess')->name('administrator.user.createProcess');
Route::get('/administrator/user/{id}/update', 'Administrator\UserController@updateView')->name('administrator.user.updateView')->where('id', '[1-9][0-9]*');
Route::post('/administrator/user/{id}/update', 'Administrator\UserController@updateProcess')->name('administrator.user.updateProcess')->where('id', '[1-9][0-9]*');
Route::get('/administrator/user/{id}/delete', 'Administrator\UserController@deleteView')->name('administrator.user.deleteView')->where('id', '[1-9][0-9]*');
Route::post('/administrator/user/{id}/delete', 'Administrator\UserController@deleteProcess')->name('administrator.user.deleteProcess')->where('id', '[1-9][0-9]*');

Route::get('/administrator/group', 'Administrator\GroupController@listing')->name('administrator.group.listing');
Route::get('/administrator/group/{id}', 'Administrator\GroupController@read')->name('administrator.group.read')->where('id', '[1-9][0-9]*');
Route::get('/administrator/group/create', 'Administrator\GroupController@createView')->name('administrator.group.createView');
Route::post('/administrator/group/create', 'Administrator\GroupController@createProcess')->name('administrator.group.createProcess');
Route::get('/administrator/group/{id}/update', 'Administrator\GroupController@updateView')->name('administrator.group.updateView')->where('id', '[1-9][0-9]*');
Route::post('/administrator/group/{id}/update', 'Administrator\GroupController@updateProcess')->name('administrator.group.updateProcess')->where('id', '[1-9][0-9]*');
Route::get('/administrator/group/{id}/delete', 'Administrator\GroupController@deleteView')->name('administrator.group.deleteView')->where('id', '[1-9][0-9]*');
Route::post('/administrator/group/{id}/delete', 'Administrator\GroupController@deleteProcess')->name('administrator.group.deleteProcess')->where('id', '[1-9][0-9]*');