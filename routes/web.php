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

/**
 * Panel administrador
 */
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
Route::get('/administrator/instructor/{id}/group', 'Administrator\InstructorController@groupView')->name('administrator.instructor.groupView')->where('id', '[1-9][0-9]*');
Route::post('/administrator/instructor/{id}/group', 'Administrator\InstructorController@groupProcess')->name('administrator.instructor.groupProcess')->where('id', '[1-9][0-9]*');

Route::get('/administrator/user', 'Administrator\UserController@listing')->name('administrator.user.listing');
Route::get('/administrator/user/{id}', 'Administrator\UserController@read')->name('administrator.user.read')->where('id', '[1-9][0-9]*');
Route::get('/administrator/user/create', 'Administrator\UserController@createView')->name('administrator.user.createView');
Route::post('/administrator/user/create', 'Administrator\UserController@createProcess')->name('administrator.user.createProcess');
Route::get('/administrator/user/{id}/update', 'Administrator\UserController@updateView')->name('administrator.user.updateView')->where('id', '[1-9][0-9]*');
Route::post('/administrator/user/{id}/update', 'Administrator\UserController@updateProcess')->name('administrator.user.updateProcess')->where('id', '[1-9][0-9]*');
Route::get('/administrator/user/{id}/delete', 'Administrator\UserController@deleteView')->name('administrator.user.deleteView')->where('id', '[1-9][0-9]*');
Route::post('/administrator/user/{id}/delete', 'Administrator\UserController@deleteProcess')->name('administrator.user.deleteProcess')->where('id', '[1-9][0-9]*');
Route::get('/administrator/user/{id}/group', 'Administrator\UserController@groupView')->name('administrator.user.groupView')->where('id', '[1-9][0-9]*');
Route::post('/administrator/user/{id}/group', 'Administrator\UserController@groupProcess')->name('administrator.user.groupProcess')->where('id', '[1-9][0-9]*');

Route::get('/administrator/group', 'Administrator\GroupController@listing')->name('administrator.group.listing');
Route::get('/administrator/group/{id}', 'Administrator\GroupController@read')->name('administrator.group.read')->where('id', '[1-9][0-9]*');
Route::get('/administrator/group/create', 'Administrator\GroupController@createView')->name('administrator.group.createView');
Route::post('/administrator/group/create', 'Administrator\GroupController@createProcess')->name('administrator.group.createProcess');
Route::get('/administrator/group/{id}/update', 'Administrator\GroupController@updateView')->name('administrator.group.updateView')->where('id', '[1-9][0-9]*');
Route::post('/administrator/group/{id}/update', 'Administrator\GroupController@updateProcess')->name('administrator.group.updateProcess')->where('id', '[1-9][0-9]*');
Route::get('/administrator/group/{id}/delete', 'Administrator\GroupController@deleteView')->name('administrator.group.deleteView')->where('id', '[1-9][0-9]*');
Route::post('/administrator/group/{id}/delete', 'Administrator\GroupController@deleteProcess')->name('administrator.group.deleteProcess')->where('id', '[1-9][0-9]*');
Route::get('/administrator/group/{id}/instructor', 'Administrator\GroupController@instructorView')->name('administrator.group.instructorView')->where('id', '[1-9][0-9]*');
Route::post('/administrator/group/{id}/instructor', 'Administrator\GroupController@instructorProcess')->name('administrator.group.instructorProcess')->where('id', '[1-9][0-9]*');
Route::get('/administrator/group/{id}/user', 'Administrator\GroupController@userView')->name('administrator.group.userView')->where('id', '[1-9][0-9]*');
Route::post('/administrator/group/{id}/user', 'Administrator\GroupController@userProcess')->name('administrator.group.userProcess')->where('id', '[1-9][0-9]*');

/**
 * Panel instructor
 */
Route::get('/instructor', 'Instructor\HomeController@index')->name('instructor.home');

Route::get('/instructor/group', 'Instructor\GroupController@listing')->name('instructor.group.listing');
Route::get('/instructor/group/{id}', 'Instructor\GroupController@read')->name('instructor.group.read')->where('id', '[1-9][0-9]*');

Route::get('/instructor/instructor/{id}', 'Instructor\InstructorController@read')->name('instructor.instructor.read')->where('id', '[1-9][0-9]*');

Route::get('/instructor/user/{id}', 'Instructor\UserController@read')->name('instructor.user.read')->where('id', '[1-9][0-9]*');
Route::get('/instructor/user/{idUser}/questionary/{idQuestionary}', 'Instructor\UserController@questionaryDetails')->name('instructor.user.questionaryDetails')->where('idUser', '[1-9][0-9]*')->where('idQuestionary', '[1-9][0-9]*');

Route::get('/instructor/questionary', 'Instructor\QuestionaryController@listing')->name('instructor.questionary.listing');
Route::get('/instructor/questionary/{id}', 'Instructor\QuestionaryController@read')->name('instructor.questionary.read')->where('id', '[1-9][0-9]*');
Route::get('/instructor/questionary/create', 'Instructor\QuestionaryController@createView')->name('instructor.questionary.createView');
Route::post('/instructor/questionary/create', 'Instructor\QuestionaryController@createProcess')->name('instructor.questionary.createProcess');
Route::get('/instructor/questionary/{id}/update', 'Instructor\QuestionaryController@updateView')->name('instructor.questionary.updateView')->where('id', '[1-9][0-9]*');
Route::post('/instructor/questionary/{id}/update', 'Instructor\QuestionaryController@updateProcess')->name('instructor.questionary.updateProcess')->where('id', '[1-9][0-9]*');
Route::get('/instructor/questionary/{id}/delete', 'Instructor\QuestionaryController@deleteView')->name('instructor.questionary.deleteView')->where('id', '[1-9][0-9]*');
Route::post('/instructor/questionary/{id}/delete', 'Instructor\QuestionaryController@deleteProcess')->name('instructor.questionary.deleteProcess')->where('id', '[1-9][0-9]*');
Route::get('/instructor/questionary/{id}/update/questions', 'Instructor\QuestionaryController@updateQuestionsView')->name('instructor.questionary.updateQuestionsView')->where('id', '[1-9][0-9]*');
Route::post('/instructor/questionary/{id}/update/questions', 'Instructor\QuestionaryController@updateQuestionsProcess')->name('instructor.questionary.updateQuestionsProcess')->where('id', '[1-9][0-9]*');

/**
 * Panel usuario
 */
Route::get('/user', 'User\HomeController@index')->name('user.home');

Route::get('/user/group', 'User\GroupController@listing')->name('user.group.listing');
Route::get('/user/group/{id}', 'User\GroupController@read')->name('user.group.read')->where('id', '[1-9][0-9]*');

Route::get('/user/instructor/{id}', 'User\InstructorController@read')->name('user.instructor.read')->where('id', '[1-9][0-9]*');

Route::get('/user/user/{id}', 'User\UserController@read')->name('user.user.read')->where('id', '[1-9][0-9]*');
Route::get('/user/user/questionary/{id}', 'User\UserController@questionaryDetails')->name('user.user.questionaryDetails')->where('id', '[1-9][0-9]*');

Route::get('/user/questionary', 'User\QuestionaryController@listing')->name('user.questionary.listing');
Route::get('/user/questionary/{id}/do-attempt', 'User\QuestionaryController@doAttemptView')->name('user.questionary.doAttemptView')->where('id', '[1-9][0-9]*');
Route::post('/user/questionary/{id}/do-attempt', 'User\QuestionaryController@doAttemptProcess')->name('user.questionary.doAttemptProcess')->where('id', '[1-9][0-9]*');