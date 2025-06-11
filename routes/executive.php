<?php 
/****************** ADMIN MIDDLEWARE PAGES ROUTES START****************/

use App\Http\Controllers\Executive\DashboardController;
use App\Http\Controllers\Executive\ReportController;
use App\Http\Controllers\Executive\UserController;

Route::group(['prefix' => 'executive', 'as'=>'executive.','middleware' => 'auth:user'], function () { 
    Route::group(['middleware' => 'executive'], function () { 

        /*******************DASHBOARD ROUTE START*************/       
        Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard.index');
        /*******************DASHBOARD ROUTE END*************/       
        /*******************USER ROUTE START*************/       
        Route::get('user/verified/{id}',[UserController::class,'verified'])->name('user.verified');
        Route::get('user/revert_verification/{id}',[UserController::class,'revert_verification'])->name('user.revert_verification');
        Route::get('user/active/{id}',[UserController::class,'active'])->name('user.active');
        Route::get('user/in_active/{id}',[UserController::class,'in_active'])->name('user.in_active');
        Route::resource('user',UserController::class);
        /*******************USER ROUTE END*************/     
        Route::get('report/monthly-progress',[ReportController::class,'monthlyProgress'])->name('report.monthly-progress');
        Route::get('report/monthly-training',[ReportController::class,'monthlyTraining'])->name('report.monthly-training');
        Route::get('report/basic-farmer-profile',[ReportController::class,'basicFarmerProfile'])->name('report.basic-farmer-profile');
       
    });        
});        
/****************** ADMIN MIDDLEWARE PAGES ROUTES END****************/
?>