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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['confirm' => false,
            'reset' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/ckeditor', function () {
    return view('ckeditor');
});

    
Route::name('teacher.')
    ->prefix('teacher')
        ->middleware('auth', 'authorize:admin,teacher')
            ->group(function() {
                Route::name('question.')->prefix('question')->group(function () {
                    Route::get('/', 'QuestionController@index')->name('list');
                    Route::get('/create', 'QuestionController@create')->name('create');
                    Route::post('/store', 'QuestionController@store')->name('store');
                });
            });