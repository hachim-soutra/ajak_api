<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('App\Http\Controllers\Api\User')->prefix('auth')->name('auth.')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::post('/forget-password', 'AuthController@postEmail');
    Route::post('/reset-password', 'AuthController@updatePassword');
    Route::middleware('auth:api')->group(function () {
        Route::get('getProfil', 'EquipeController@getProfil');
        Route::resource('equipe', 'EquipeController');
        Route::resource('Agence', 'AgenceController');
        Route::resource('client', 'ClientController');
        Route::resource('livreur', 'LivreurController');
        Route::resource('colis', 'ColisController');
        Route::resource('rammasge', 'RammasageController');
        Route::resource('return-colis', 'ReturnColisController');

        Route::get('client-list', 'ClientController@list');
        Route::get('livreur-list', 'LivreurController@list');
        Route::get('role-list', 'EquipeController@list');
        Route::get('colis-list', 'ColisController@list');
        Route::get('encours', 'RammasageController@encours');
    });
});
Route::namespace('App\Http\Controllers\Api\Client')->prefix('client/auth')->name('client.auth.')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::middleware(['auth:clients_api'])->group(function () {
        // Route::resource('user', 'UserController');
        Route::resource('equipe', 'EquipeController');
        Route::resource('client', 'ClientController');
        Route::resource('livreur', 'LivreurController');
        Route::resource('colis', 'ColisController');
        Route::resource('rammasage', 'RammasageController');
        Route::resource('produit', 'ProduitController');
    });
});
