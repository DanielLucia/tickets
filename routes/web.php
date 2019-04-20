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

Route::get('/', 'HomeController@index')->name('home');

Route::redirect('/home', '/', 301);
Route::redirect('/', '/ticket', 301);

Route::get('/ticket', 'TicketsController@index')->name('tickets');
Route::get('/ticket/{id}', 'TicketsController@view')->name('tickets.view');
Route::get('/ticket/remove/{id}', 'TicketsController@remove')->name('tickets.remove');

Route::post('/ticket', 'TicketsController@save')->name('tickets.save');
Route::post('/ticket/save-product', 'TicketsController@saveProduct')->name('tickets.save.product');
