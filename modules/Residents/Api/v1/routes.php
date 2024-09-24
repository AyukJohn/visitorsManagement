<?php


use Illuminate\Support\Facades\Route;
use App\Modules\Residents\Api\Controllers\ResidentsController;

Route::prefix('v1')->group(function () {


    Route::get('/residents', [ResidentsController::class, 'returnResidents'])->middleware('admin_superadmin');
    Route::post('/crateResidents', [ResidentsController::class, 'createResidents'])->middleware('admin_superadmin');




    Route::middleware('verified')->group(function () {

        Route::middleware('banned')->group(function () {

            
        });

    });




});