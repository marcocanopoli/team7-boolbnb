<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\HouseType;
use App\Service;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')
    ->group(function() {
        
        Route::get('/houses', 'HouseController@index');
        Route::get('/sponsored', 'HouseController@sponsored');
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

        //form send message la rotta è api/messages
        Route::post('messages', 'MessageController@store')->name('message');
    });