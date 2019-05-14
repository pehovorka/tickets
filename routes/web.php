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

Route::post('/venues/fetch', 'VenuesController@fetch')->name('venues.fetch');
Route::post ( '/venues/storeModal', 'VenuesController@storeModal' );
Route::put('/venues/{venue}', 'VenuesController@updateModal');


//Home auth views
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/events', 'HomeController@events');
Route::get('/home/venues', 'HomeController@venues');




