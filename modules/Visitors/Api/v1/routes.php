<?php


use Illuminate\Support\Facades\Route;
// use App\Modules\Residents\Api\Controllers\ResidentsController;
use App\Modules\Visitors\Api\Controllers\VisitorController;

Route::prefix('v1')->group(function () {


    Route::get('/visitors', [VisitorController::class, 'returnVisitors'])->middleware('admin_superadmin');
    Route::post('/crateVisitors', [VisitorController::class, 'createVisitors'])->middleware('admin_superadmin');


    Route::get('/visits', [VisitorController::class, 'returnVisits'])->middleware('admin_superadmin');
    Route::post('/crateVisits', [VisitorController::class, 'createVisits'])->middleware('admin_superadmin');






    Route::middleware('verified')->group(function () {

        Route::middleware('banned')->group(function () {

            
        });

    });




});