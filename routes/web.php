<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes([
    'confirm' => false,
    'reset' => false
]);

Route::get('/', 'HomeController@index')->name('home');

Route::get('/ckeditor', function () {
    return view('ckeditor');
});

Route::group(['middleware' => ['auth']], function () {

    Route::name('teacher.')
        ->prefix('teacher')
        ->middleware('authorize:admin,teacher')
        ->group(function () {
            Route::name('index')->get('/', 'TeacherController@index');
            Route::name('question.')->prefix('question')->group(function () {
                Route::name('list')->get('/', 'QuestionController@index');
                Route::name('create')->get('/create', 'QuestionController@create')->middleware('authorize:teacher');
                Route::name('store')->post('/', 'QuestionController@store')->middleware('authorize:teacher');
                Route::name('destroy')->get('/destroy/{id}', 'QuestionController@destroy')->middleware('authorize:teacher');
                Route::name('edit')->get('/edit/{id}', 'QuestionController@edit')->middleware('authorize:teacher');
                Route::name('update')->post('/update', 'QuestionController@update')->middleware('authorize:teacher');
            });

            Route::name('test.')->prefix('test')->group(function () {
                Route::name('list')->get('/', 'TestController@index');
                Route::name('create')->get('/create', 'TestController@create');
            });
        });

    Route::name('admin.')
        ->prefix('admin')
        ->middleware('authorize:admin')
        ->group(function () {
            Route::name('index')->get('/', 'AdminController@index');
            Route::name('user.')->prefix('user')->group(function () {
                Route::name('list')->get('/', 'UserController@index');
                Route::name('create')->post('/create', 'UserController@createUser')->middleware('authorize:admin');
                Route::name('destroy')->get('/destroy/{id}', 'UserController@destroy')->middleware('authorize:admin');
                Route::name('update')->post('/update/{id}', 'UserController@update')->middleware('authorize:admin');
            });
        });
    Route::name('student.')
        ->prefix('student')
        ->middleware('authorize:student')
        ->group(function () {
            Route::name('index')->get('/', 'StudentController@index');
            Route::name('user.')->prefix('user')->group(function () {
                Route::name('list')->get('/', 'UserController@index');
            });
        });
});
