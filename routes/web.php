<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::middleware('auth') //autenticazione
    ->namespace('Admin') //-> direttiva al path Admin/HomeController
    ->name('admin.') // direttiva alla route admin.pizzas.index admin.yournames.show
    ->prefix('admin') //url rotte
    ->group(function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('houses', 'HouseController');	
    Route::get('houses/{slug}', 'HouseController@show');
    Route::get('houses/{slug}/edit', 'HouseController@edit');
    Route::post('houses/{house_id}/payments/{promotion_name}', 'HouseController@payments')->name('success');
    Route::get('houses/{house_id}/payments/{promotion_name}', 'PaymentsController@make')->name('payment');
    Route::get('houses/{house_id}/promotions', 'PromotionsController@promote')->name('promotions');
    Route::resource('messages', 'MessageController');
    Route::get('chart/', 'ChartController@index')->name('chart');
    
    
    Route::get("{any?}", "HomeController@index")->where("any", ".*");

});

Route::get("{any?}", "HomeController@index")->where("any", ".*")->name('home');

// Route::get('/home', 'HomeController@index')->name('home');
