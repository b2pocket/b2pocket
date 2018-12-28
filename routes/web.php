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

// SETOVANJE BILANSA USPEHA
Route::get('setovanje_bilansa_uspeha', 'bilansiUspehaController@setovanje_bilansa_uspeha');
Route::get('zaglavljeKonta', 'bilansiUspehaController@zaglavljeKonta')->name('zaglavljeKonta');
Route::get('neklasifikovanaKonta', 'bilansiUspehaController@neklasifikovanaKonta')->name('neklasifikovanaKonta');
Route::get('tableDetail/{klasaKonta}', 'bilansiUspehaController@tableDetail')->name('tableDetail');

Route::get('klasifikujKonto','bilansiUspehaController@klasifikujKonto');
Route::get('obrisiKlasifikacijuKonta','bilansiUspehaController@obrisiKlasifikacijuKonta');
// --------!!!!!!!!-------------

// ANDROID MANIPULACIJA
	Route::get('korisnici_i_prava', 'korisniciIPravaController@korisnici_i_prava');

// --------!!!!!!!!-------------

// AUTHENTICATION SISTEM
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// --------!!!!!!!!-------------