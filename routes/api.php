<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\LanguageController;

Route::prefix('table')->group(function() {
    Route::get('status/lock/{id}',[OrganizationController::class,'tableLock']);
    Route::get('status/unlock/{id}',[OrganizationController::class,'tableUnlock']);
});

Route::prefix('contacts')->group(function() {
    Route::get('contracts',[ContactController::class,'contracts'])->name('contacts.contracts');
    Route::get('privacy',[ContactController::class,'privacy'])->name('contacts.privacy');
});

Route::prefix('card')->group(function() {

    Route::post('post',[CardController::class,'post'])->name('card.post');
    Route::post('update/{id}',[CardController::class,'update'])->name('card.update');
    Route::get('delete/{id}',[CardController::class,'delete'])->name('card.delete');
    Route::get('id/{id}',[CardController::class,'getById'])->name('card.id');
    Route::get('user/{userId}',[CardController::class,'getByUserId'])->name('card.user');

});

Route::prefix('booking')->group(function() {

    Route::get('completed/{userId}',[BookingController::class,'getCompletedByUserId'])->name('booking.status.user');
    Route::post('create',[BookingController::class,'create'])->name('booking.create');
    Route::get('delete/{id}',[BookingController::class,'delete'])->name('booking.delete');
    Route::get('id/{id}',[BookingController::class,'getById'])->name('booking.id');
    Route::get('user/{userId}',[BookingController::class,'getByUserId'])->name('booking.user');
    Route::get('organization/{organizationId}',[BookingController::class,'getByOrganizationId'])->name('booking.organization');
    Route::get('table/{tableId}',[BookingController::class,'getByTableId'])->name('booking.table');
    Route::get('date/{date}',[BookingController::class,'getByDate'])->name('booking.date');
    Route::post('guest',[BookingController::class,'guest'])->name('booking.guest');

});

Route::prefix('payment')->group(function() {

    Route::post('card/result',[PaymentController::class,'cardResult'])->name('payment.card.result');
    Route::get('card/result',[PaymentController::class,'cardResult'])->name('payment.card.result');
    Route::get('card/{id}',[PaymentController::class,'card']);
    Route::post('result',[PaymentController::class,'result']);
    Route::get('post',[PaymentController::class,'post']);
    Route::get('check',[PaymentController::class,'check']);

});

Route::prefix('review')->group(function () {

    Route::post('create',[ReviewController::class,'create']);
    Route::post('update/{id}',[ReviewController::class,'update']);
    Route::get('delete/{id}',[ReviewController::class,'delete']);
    Route::get('count/organization/{organizationId}',[ReviewController::class,'getCountByOrganizationId']);
    Route::get('list/organization/{id}',[ReviewController::class,'getByOrganizationId']);
    Route::get('list/user/{id}',[ReviewController::class,'getByUserId']);

});

Route::prefix('organization')->group(function() {
    Route::get('/status/{id}/{date}',[OrganizationController::class,'status'])->name('organization.status');
    Route::post('/ids',[OrganizationController::class,'getByIds'])->name('organization.ids');
    Route::get('section/{id}',[OrganizationController::class,'getSectionsById']);
    Route::get('{id}',[OrganizationController::class,'getById']);
    Route::get('user/{userId}',[OrganizationController::class,'getByUserId'])->name('organization.getByUserId');
});

Route::get('/categories',[CategoryController::class,'list']);
Route::get('countries',[CountryController::class,'list']);


Route::get('/organizations',[OrganizationController::class,'list']);
Route::get('/organizations/{search}',[OrganizationController::class,'search']);


Route::prefix('category')->group(function() {
    Route::get('organizations/{id}',[OrganizationController::class,'getByCategoryId']);
    Route::get('organizations/{id}/{cityId}',[OrganizationController::class,'getByCategoryIdAndCityId']);
});

Route::prefix('languages')->group(function() {
    Route::get('list',[LanguageController::class ,'list'])->name('languages.list');
});

Route::prefix('sms')->group(function() {
    Route::get('{phone}/{code}',[UserController::class,'smsVerify']);
});

Route::prefix('user')->group(function() {
    Route::post('update/{id}',[UserController::class,'update'])->name('user.update');
    Route::post('password/{id}',[UserController::class,'updatePassword'])->name('user.update.password');
    Route::get('/{id}',[UserController::class,'getById'])->name('user.id');
    Route::get('phone/{phone}',[UserController::class,'getByPhone'])->name('user.phone');
    Route::post('booking',[UserController::class,'booking'])->name('user.booking');
    Route::post('new',[UserController::class,'guest'])->name('user.guest');
});

Route::get('/sms_resend/{phone}',[UserController::class,'smsResend']);
Route::get('/login/{phone}/{password}',[UserController::class,'login']);
Route::get('/register',[UserController::class,'register']);
Route::post('/register',[UserController::class,'register']);

Route::get('/token/{token}', [UserController::class,'token']);
Route::post('/token/{token}', [UserController::class,'token']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
