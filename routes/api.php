<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\OrganizationCityController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\PaymentController;

Route::prefix('payment')->group(function() {

    Route::get('/card/add/{id}',[PaymentController::class,'cardAdd']);
    Route::get('/card/list/{id}',[PaymentController::class,'cardList']);

    Route::get('/result',[PaymentController::class,'result']);

    Route::get('/success',[PaymentController::class,'success']);
    Route::get('/failure',[PaymentController::class,'failure']);

    Route::get('/post',[PaymentController::class,'post']);
    Route::get('/check',[PaymentController::class,'check']);

});

Route::prefix('review')->group(function () {
    Route::post('/create/',[ReviewController::class,'create']);
    Route::post('/update/{id}',[ReviewController::class,'update']);
    Route::get('/delete/{id}',[ReviewController::class,'delete']);
    Route::get('/list/organization/{id}',[ReviewController::class,'getByOrganizationId']);
    Route::get('/list/user/{id}',[ReviewController::class,'getByUserId']);
});

Route::post('/add/booking/',[BookingController::class,'add']);
Route::get('/organization/booking/{id}',[BookingController::class,'getByOrganizationId']);
Route::get('/booking/{id}',[BookingController::class,'getByUserId']);
Route::get('/tables/{id}',[BookingController::class,'tables']);

Route::get('/categories',[CategoryController::class,'list']);
Route::get('/countries',[CountryController::class,'list']);
Route::get('/organization/section/{id}',[OrganizationController::class,'getSectionsById']);

Route::get('/organizations',[OrganizationController::class,'list']);
Route::get('/organizations/{search}',[OrganizationController::class,'search']);
Route::get('/organization/{id}',[OrganizationController::class,'getById']);
Route::get('/city/organizations/{id}/',[OrganizationCityController::class,'getByCityId']);
Route::get('/category/organizations/{id}',[OrganizationController::class,'getByCategoryId']);

Route::get('/sms/{phone}/{code}',[UserController::class,'smsVerify']);
Route::get('/login/{phone}/{password}',[UserController::class,'login']);
Route::get('/register',[UserController::class,'register']);

Route::get('/user/{id}',[UserController::class,'getById']);
Route::get('/token/{token}', [UserController::class,'token']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
