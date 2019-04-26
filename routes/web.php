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

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::resource('events', 'EventsController');
Route::resource('venues', 'VenuesController');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/venues/fetch', 'VenuesController@fetch')->name('venues.fetch');

