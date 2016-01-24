<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

  Route::auth();


  Route::get('/tasks/tag', ['as' => 'task_tag','uses' => 'TaskController@displayTag']);
  

  Route::get('/tasks', ['as' => 'task', 'uses' => 'TaskController@index']);


  Route::get('/tasks/{id}', ['as' => 'task_show', 'uses' => 'TaskController@show'])->where('id', '[0-9]+');

  /**
  * Add A New Task
  */
  Route::get('/tasks/add', ['as' => 'task_add','uses' => 'TaskController@add']);

  /**
  * Add A New Task Traitement
  */
  Route::post('/tasks/store', ['as' => 'task_store','uses' => 'TaskController@store']);

  /**
  * Delete An Existing Task
  */
  Route::get('/tasks/delete/{id}', ['as' => 'task_delete','uses' => 'TaskController@delete'])->where('id', '[0-9]+');


  Route::group(['prefix' => 'admin'], function () {
    
    Route::get('login', ['as' => 'admin_login', 'uses' => 'AdminController@login']);

    Route::get('dashboard', ['as' => 'admin_dashboard', 'uses' => 'AdminController@dashboard']);

  });


});
