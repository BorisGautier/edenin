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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api'], function (){
    Route::resource('ages', 'AgeController');
    Route::resource('users', 'UserController');
    Route::resource('livres', 'LivreController');
    Route::post('achat-livre', 'LivreController@achatLivre');
    Route::resource('textes', 'TexteController');
    Route::resource('langues', 'LangueController');
    Route::resource('auteurs', 'AuteurController');
    Route::resource('contenus', 'ContenuController');
    Route::resource('partages', 'PartageController');
    Route::resource('categories', 'CategorieController');
    Route::resource('dispositions', 'DispositionController');

});
