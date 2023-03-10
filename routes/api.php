<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ClientController;
use Illuminate\Support\Facades\Input;
use App\Models\Client;

//Login & Register Route
Route::controller(AuthController::class)->group(function(){
    Route::post('login','login');
    Route::post('register','register');
});

//Client Route(Get,Post,Delete etc)
Route::apiResource('Client',ClientController::class);

//Search Route
Route::controller(ClientController::class)->group(function(){
    Route::get('search/{name}','search');
});
