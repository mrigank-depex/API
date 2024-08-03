<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\DRController;
Route::get('/', function () {
    return view('welcome');
});

Route::post('/send-otp1', [OTPController::class, 'sendOTP1']);
Route::post('/verify-otp', [OTPController::class, 'verifyOTP']);
Route::post('/register', [OTPController::class, 'register']); // Make this publicly accessible
Route::post('/register1', [OTPController::class, 'register1']);
Route::post('/send-otpdr', [DRController::class, 'sendOTP']);
Route::post('/verify-otpdr', [DRController::class, 'verifyOTP']);
Route::post('/dr-register1', [DRController::class, 'register1']);
Route::get('/country-codes', [OTPController::class, 'CountryCode']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
