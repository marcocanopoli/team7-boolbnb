<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\HouseType;
use App\Service;
use App\User;

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

Route::namespace('Api')
    ->group(function() {
        
        Route::get('/houses', 'HouseController@index');
        Route::get('/houses/{id}', 'HouseController@show');
        Route::get('/search', 'HouseController@search');

        Route::get('/housetypes', function() {
            $house_types = HouseType::all();
            return response()->json($house_types);
        });

        Route::get('/services', function() {
            $services = Service::all();
            return response()->json($services);
        });

        Route::get('/authuser', function() {
            $authuser = User::all();
            return response()->json($authuser);
        });

        //form send message la rotta è api/messages
        Route::post('messages', 'MessageController@store')->name('message');
    });