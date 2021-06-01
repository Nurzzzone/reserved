<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\OrganizationCrudController;
use App\Http\Controllers\Admin\UserCrudController;
use App\Http\Controllers\Admin\OrganizationTablesCrudController;
use App\Http\Controllers\Admin\OrganizationTableListCrudController;
use App\Http\Controllers\Admin\BookingCrudController;
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

Route::prefix('contacts')->group(function() {
    Route::get('contracts',[ContactController::class,'contracts']);
    Route::get('privacy',[ContactController::class,'privacy']);
});

Route::get('users',[UserCrudController::class, 'list']);
Route::get('tables',[OrganizationTableListCrudController::class,'list']);
Route::get('tables/{id}',[OrganizationTableListCrudController::class,'getBySectionId']);
Route::get('organization',[OrganizationCrudController::class, 'list']);
Route::get('organizationTables',[OrganizationTablesCrudController::class, 'list']);
Route::get('organizationTables/{id}',[OrganizationTablesCrudController::class, 'getByOrganizationId']);
Route::get('lk/{id}',[LinkController::class, 'link']);

Route::get('/', [MainController::class, 'index']);

Route::get('/queue', function() {
    Artisan::call('queue:work');
    dd('queue work');
});

Route::get('exit',[LoginController::class, 'logout'])->name('exit');

Route::prefix('admin')->group(function () {
    //Route::get('login', [LoginController::class, 'showLoginForm'])->name('backpack.auth.register');
    Route::get('dashboard',[MainController::class, 'dashboard'])->name('dashboard');
    Route::get('dashboard/booking/{id}',[MainController::class, 'dashboardBooking'])->name('dashboard.booking');
    Route::get('register',[RegisterController::class, 'showRegistrationForm'])->name('backpack.auth.register');
    Route::post('register',[RegisterController::class, 'register'])->name('backpack.auth.register');
    Route::get('phone_verify',[UserController::class, 'phoneVerify'])->name('phone.verify');
    Route::post('phone_verify',[UserController::class, 'checkPhoneCode'])->name('phone.code');
    Route::get('blocked_user',[UserController::class, 'blockedUser'])->name('user.blocked');
    Route::get('blocked_restricted',[UserController::class, 'restrictedUser'])->name('user.restricted');
    Route::get('booking/status',[BookingCrudController::class, 'bookingStatus']);
});
