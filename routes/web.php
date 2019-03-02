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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::name('complete-survey.')->prefix('complete-survey')->group(function () {
    Route::get('/done', 'CompleteSurveyController@done')->name('done');
    Route::get('/{survey}', 'CompleteSurveyController@view')->name('view');
    Route::post('/{survey}', 'CompleteSurveyController@submit')->name('submit');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', 'HomeController@index')->name('home');
    Route::resource('surveys', 'SurveysController')->except(['store']);
});

Auth::routes();
