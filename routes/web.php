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

//Static and index pages
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/privacy-policy', 'PagesController@privacy_policy');

//Events
Route::get('/events/past/', 'EventsController@index_past');
Route::get('/events/upcoming', 'EventsController@index_upcoming');
Route::resource('events', 'EventsController');


//Venues
Route::resource('venues', 'VenuesController');
Route::post('/venues/fetch', 'VenuesController@fetch')->name('venues.fetch');
Route::post ( '/venues/storeModal', 'VenuesController@storeModal' );
Route::put('/venues/{venue}', 'VenuesController@updateModal');


//Auth routes
Auth::routes();
Route::get('/login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('/login/facebook/callback', 'Auth\LoginController@handleProviderCallback');


//Home routes
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/events', 'HomeController@events');
Route::get('/home/venues', 'HomeController@venues');
Route::get('/home/tickets', 'HomeController@tickets');
Route::get('/home/users', 'HomeController@users');

Route::post('/home/users', 'HomeController@storeUserRoles');



//Tickets
Route::match(array('GET', 'POST'), '/tickets/buy/{ticket}', 'TicketsController@showOrder');
Route::post('/tickets/store/{ticket_user}', 'TicketsController@store');
Route::get('/tickets/show/{uuid}', 'TicketsController@show');
Route::get('/tickets/validate/{uuid}', 'TicketsController@validateTicket')->name('validateTicket');
Route::post('/tickets/use/', 'TicketsController@useTicket');


