<?php

use App\Controllers\ProcureVisa\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

//     $userData = date('Y-m-d H:i:s');

//     $timeString = "2024-04-28T09:10:19.000000Z";
// $dateTime = new DateTime($timeString);
// $normalTime = $dateTime->format('Y-m-d H:i:s');
//     dd($normalTime);

    return view('welcome');
});


// Route::post('/verify-payment', [PaymentController::class, 'verifyPayment']);
