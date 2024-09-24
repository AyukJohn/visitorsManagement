<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Admin\Api\Controllers\AdminController;
use App\Modules\Admin\Api\Controllers\AdminGetAllTransactionController;
use App\Modules\Admin\Api\Controllers\AdminPrivilegesController;
use App\Modules\Admin\Api\Controllers\AdminUserController;





Route::prefix('v1/admin')->group(function () {


Route::post('registerAdmin', [AdminController::class, 'register'])->middleware('superAdmin');
Route::get('allAdmin', [AdminController::class, 'index'])->middleware('superAdmin');
Route::post('loginAdmin', [AdminController::class, 'login']);
Route::delete('deleteAdmin/{adminId}', [AdminController::class, 'deleteAdmin'])->middleware('superAdmin');


});