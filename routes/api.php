<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\StoresController;
use App\Http\Controllers\RestaurantInfoController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;


Route::group(['middleware' =>'auth:sanctum'],function(){
    Route::post('foods',[FoodController::class,'createFood']);
    Route::put('foods/{foodId}', [FoodController::class, 'editfood']);
    Route::delete('foods/{foodId}', [FoodController::class, 'deleteFood']);

    Route::post('groups', [GroupsController::class, 'createGroup']);
    Route::put('groups/{groupsId}', [GroupsController::class, 'editGroup']);

    Route::post('stores', [StoresController::class, 'createStore']);
    Route::put('stores/{storesId}', [StoresController::class, 'editStore']);

    Route::post('restaurantInfo', [RestaurantInfoController::class, 'createInfo']);
    Route::put('restaurantInfo/{restaurantInfoId}', [RestaurantInfoController::class, 'editInfo']);

    Route::post('table', [TableController::class, 'createTable']);
    Route::put('table/{tableId}', [TableController::class, 'editTable']);

    Route::delete('delete/user', [UserController::class, 'deleteUser']);
    Route::post('change/password', [UserController::class, 'changePassword']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::post('edit/user',[UserController::class,'editUser']);

});


Route::post('login',[UserController::class,'login']);
Route::post('reg',[UserController::class,'register']);
