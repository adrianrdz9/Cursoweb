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
Auth::routes();



Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('index');
    
    Route::resource('assignment', 'AssignmentsController');

    Route::resource('delivery', 'DeliveriesController');

    Route::resource('comment', 'CommentsController');
    
    Route::resource('announcements', 'AnnouncementsController');

    Route::get('/calendario', 'HomeController@calendar')->name('calendar');
    
    Route::resource('resources', 'ResourcesController');

    Route::resource('users', 'UsersController');

    Route::resource('roles', 'RolesController');

    Route::resource('permissions', 'PermissionsController');

    Route::resource('posts', 'PostsController');

    Route::resource('exams', 'ExamsController');
});