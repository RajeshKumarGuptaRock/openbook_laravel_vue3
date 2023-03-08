<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ClientController;

use Illuminate\Support\Facades\Input;
use App\Models\Client;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function(){
    Route::post('login','login');
    Route::post('register','register');
});

Route::apiResource('Client',ClientController::class);

Route::controller(ClientController::class)->group(function(){
    Route::get('search/{name}','search');
});
