<?php

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

Auth::routes();

Route::middleware('auth')
    ->name('admin.')
    ->prefix('admin')
    ->namespace('Admin')
    ->group(function() {
// con middleware('auth') specifico che a tutte le rotte di questo gruppo verrà applicato il middleware auth, quindi posso andare nell'home controller ed eliminare il costruttore che applica il middleware auth perché già lo applico qui
// uso il metodo name() a cui passo il prefisso del nome della rotta, quindi non sarà necessario specificare admin nel nome della rotta, ovvero non dovrò scrivere ->name('admin.home')
// uso il metodo prefix() a cui passo il prefisso del percorso delle rotte, quindi non sarà necessario specificare admin nel percorso, per esempio non dovrò più scrivere: Route::get('/admin/home', 'HomeController@index')->name('home');
// uso il metodo namespace() per specificare che tutti i controller che si collegano a queste rotte si trovano nel name space Admin, invece che specificare ogni volta 'Admin\HomeController@index'

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('posts', 'PostController');
});
