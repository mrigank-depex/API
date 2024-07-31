<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\DRController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/send-otp1', [OTPController::class, 'sendOTP1']);
Route::get('/verify-otp', [OTPController::class, 'verifyOTP']);
Route::get('/register', [OTPController::class, 'register']); // Make this publicly accessible
Route::get('/register1', [OTPController::class, 'register1']);
Route::get('/send-otpdr', [DRController::class, 'sendOTP']);
Route::get('/verify-otpdr', [DRController::class, 'verifyOTP']);
Route::get('/dr-register1', [DRController::class, 'register1']);
Route::get('/country-codes', [OTPController::class, 'CountryCode']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
