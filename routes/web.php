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

Route::get('/', "LogonController@index")->name('login');
Route::post('/login', "LogonController@login")->name('logar');

Route::post('/registro', "RegistroController@registro")->name('registrar');

Route::post('/ativa', "RegistroController@ativa")->name('ativar');

Route::post('/ativaLogin', "LogonController@ativaLogin")->name('ativaLogin');

Route::post('/relembrar', "LogonController@relembrar")->name('relembrar');

Route::post('/mudaSenha', "LogonController@mudaSenha")->name('mudaSenha');

Route::group(['middleware' =>['auth']],function() {
    
    Route::get('/logout', function(){
        Auth::logout();
        return redirect()->route('login');
    });

    Route::get('/home', 'LogonController@home')->name('home');

    Route::get('/contracheque', 'ContrachequeController@index')->name('contracheque');

    Route::post('/buscaContracheque', 'ContrachequeController@buscaContracheque')->name('buscaContracheque');
});