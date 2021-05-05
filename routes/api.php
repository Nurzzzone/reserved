<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\BookingController;

Route::post('/add/booking/',[BookingController::class,'add']);
Route::get('/organization/booking/{id}',[BookingController::class,'getByOrganizationId']);
Route::get('/booking/{id}',[BookingController::class,'getByUserId']);
Route::get('/tables/{id}',[BookingController::class,'tables']);

Route::get('/categories',[CategoryController::class,'list']);
Route::get('/countries',[CountryController::class,'list']);

Route::get('/organizations',[OrganizationController::class,'list']);
Route::get('/organizations/{search}',[OrganizationController::class,'search']);
Route::get('/organization/{id}',[OrganizationController::class,'getById']);

Route::get('/login/{phone}/{password}',[UserController::class,'login']);
Route::get('/register',[UserController::class,'register']);

Route::get('/user/{id}',[UserController::class,'getById']);
Route::get('/token/{token}', [UserController::class,'token']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
