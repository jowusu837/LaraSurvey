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

Route::name('complete-survey')->group(function () {
    Route::get('complete-survey/{survey}', 'CompleteSurveyController@view');
    Route::post('complete-survey/{survey}', 'CompleteSurveyController@submit');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', 'HomeController@index')->name('home');
    Route::resource('surveys', 'SurveysController')->except(['store']);
});

Auth::routes();
