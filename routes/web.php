<?php

use App\Http\Controllers\Auth\RegisteredDriverController;
use App\Http\Controllers\Auth\RegisteredQuartermasterController;
use App\Http\Controllers\Auth\RegisteredRefugeeController;
use App\Http\Controllers\Driver\DriverHomeController;
use App\Http\Controllers\Driver\DriverLocationController;
use App\Http\Controllers\Driver\DriverLocationsController;
use App\Http\Controllers\Driver\DriverOfferedRidesController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Quartermaster\QuartermasterHomeController;
use App\Http\Controllers\Refugee\RefugeeHomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;

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
Route::redirect('','cs/welcome');

Route::group(['prefix' => '{locale}', 'middleware' => 'locale'], function (){
    Route::get('/welcome', [WelcomeController::class, 'create'])
        ->name('welcome');

    // if you are logged in you will be redirected when accessing these routes
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'store']);

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
            ->name('password.request');

        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
            ->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
            ->name('password.reset');

        Route::post('reset-password', [NewPasswordController::class, 'store'])
            ->name('password.update');

        Route::get('register-driver', [RegisteredDriverController::class, 'create'])
            ->name('register.driver');

        Route::post('register-driver', [RegisteredDriverController::class, 'store']);

        Route::get('register-refugee', [RegisteredRefugeeController::class, 'create'])
            ->name('register.refugee');

        Route::post('register-refugee', [RegisteredRefugeeController::class, 'store']);

        Route::get('register-quartermaster', [RegisteredQuartermasterController::class, 'create'])
            ->name('register.quartermaster');

        Route::post('register-quartermaster', [RegisteredQuartermasterController::class, 'store']);
    });

    // you need to be logged in to access these routes
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('confirm-password', [ConfirmablePasswordController::class, 'create'])
            ->name('password.confirm');

        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        Route::group(['prefix' => 'driver'], function () {
            Route::get('home', [DriverHomeController::class, 'create'])
                ->name('driver.home');

            Route::get('offered_rides', [DriverOfferedRidesController::class, 'create'])
                ->name('driver.offered_rides');

            Route::get('location/{id}', [DriverLocationController::class, 'create'])
                ->name('driver.location');

            Route::get('locations', [DriverLocationsController::class, 'create'])
                ->name('driver.locations');

            Route::post('/change_offer_status', [DriverOfferedRidesController::class, 'changeOfferStatus']);
            Route::post('/location_send_offer', [DriverLocationController::class, 'sendOffer']);
        });

        Route::group(['prefix' => 'quartermaster'], function () {
           Route::get('home', [QuartermasterHomeController::class, 'create'])
               ->name('quartermaster.home');
        });

        Route::group(['prefix' => 'refugee'], function () {
            Route::get('home', [RefugeeHomeController::class, 'create'])
                ->name('refugee.home');
            Route::post('/change_offer_status', [RefugeeHomeController::class, 'changeOfferStatus']);
        });
    });

    Route::middleware('auth')->group(function (){
        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('verification.send');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
    });
});

Route::middleware('auth')->group(function() {
    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
});


Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
    ->name('verification.notice');
