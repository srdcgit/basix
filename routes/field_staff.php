<?php 
/****************** ADMIN MIDDLEWARE PAGES ROUTES START****************/

use App\Http\Controllers\FieldStaff\DashboardController;
use App\Http\Controllers\FieldStaff\FarmingProfileController;
use App\Http\Controllers\FieldStaff\MonthlyFarmingReportController;
use App\Http\Controllers\FieldStaff\ReportController;
use App\Http\Controllers\FieldStaff\RespondentMasterController;
use App\Http\Controllers\FieldStaff\TrainingReportController;
use App\Http\Controllers\FieldStaff\UserController;

Route::group(['prefix' => 'field_staff', 'as'=>'field_staff.','middleware' => 'auth:user'], function () { 
    Route::group(['middleware' => 'field_staff'], function () { 

        /*******************DASHBOARD ROUTE START*************/       
        Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard.index');
        /*******************DASHBOARD ROUTE END*************/       
        /*******************TRAINING REPORT ROUTE START*************/    
        Route::get('training_report/un_validate/{id}',[TrainingReportController::class,'un_validate'])->name('training_report.un_validate');   
        Route::get('training_report/validate/{id}',[TrainingReportController::class,'validateReport'])->name('training_report.validate');   
        Route::resource('training_report',TrainingReportController::class);
        /*******************TRAINING REPORT ROUTE END*************/   
        /*******************Respondent Master ROUTE START*************/       
        Route::get('respondent_master/un_validate/{id}',[RespondentMasterController::class,'un_validate'])->name('respondent_master.un_validate');   
        Route::get('respondent_master/validate/{id}',[RespondentMasterController::class,'validateReport'])->name('respondent_master.validate');      
        Route::resource('respondent_master',RespondentMasterController::class);
        Route::get('report/export', [RespondentMasterController::class, 'export'])->name('report.export');
        /*******************Respondent Master ROUTE END*************/   
        /*******************Farming Profile ROUTE START*************/       
        Route::get('farming_profile/un_validate/{id}',[FarmingProfileController::class,'un_validate'])->name('farming_profile.un_validate');   
        Route::get('farming_profile/validate/{id}',[FarmingProfileController::class,'validateReport'])->name('farming_profile.validate');   
        Route::resource('farming_profile',FarmingProfileController::class);
        /*******************Farming Profile ROUTE END*************/  
        /*******************Monthly Farming Report ROUTE START*************/       
        Route::post('get_months',[MonthlyFarmingReportController::class,'getMonths'])->name('monthly_farming_report.getMonths');
        Route::post('get_blocks',[MonthlyFarmingReportController::class,'getBlocks'])->name('monthly_farming_report.get_blocks');
        Route::post('get_gram_panchyats',[MonthlyFarmingReportController::class,'getGramPanchyats'])->name('monthly_farming_report.get_gram_panchyats');
        Route::post('get_villages',[MonthlyFarmingReportController::class,'getVillages'])->name('monthly_farming_report.get_villages');
            
        Route::get('monthly_farming_report/un_validate/{id}',[MonthlyFarmingReportController::class,'un_validate'])->name('monthly_farming_report.un_validate');   
        Route::get('monthly_farming_report/validate/{id}',[MonthlyFarmingReportController::class,'validateReport'])->name('monthly_farming_report.validate');   
       
        Route::resource('monthly_farming_report',MonthlyFarmingReportController::class);
        /*******************Monthly Farming Report ROUTE END*************/  
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