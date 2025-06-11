<?php

/****************** ADMIN MIDDLEWARE PAGES ROUTES START****************/

use App\Http\Controllers\Project\DashboardController;
use App\Http\Controllers\Project\ProjectDashboardController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\Project\ReportController;
use App\Http\Controllers\Project\UserController;

Route::group(['prefix' => 'project', 'as' => 'project.', 'middleware' => 'auth:user'], function () {
    Route::group(['middleware' => 'project'], function () {
        /*******************DASHBOARD ROUTE START*************/
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('dashboard/monthly-progress', [DashboardController::class, 'monthlyProgress'])->name('dashboard.monthly-process');
        Route::get('dashboard/farming-profile', [DashboardController::class, 'framingProfile'])->name('dashboard.farming-profile');
        Route::get('dashboard/farming-profile2', [DashboardController::class, 'framingProfile2'])->name('dashboard.farming-profile2');
        Route::get('dashboard/monthly-training', [DashboardController::class, 'monthlyTraining'])->name('dashboard.monthly-training');
        Route::get('dashboard/respondent', [DashboardController::class, 'respondent'])->name('dashboard.respondent');
        Route::get('dashboard/hr/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.hr-dashboard');
        Route::get('project_dashboard', [ProjectDashboardController::class, 'index'])->name('project_dashboard.index');
        /*******************DASHBOARD ROUTE END*************/
        /*******************Project ROUTE START*************/
        Route::resource('project', ProjectController::class);
        /*******************Project ROUTE END*************/
        /*******************USER ROUTE START*************/
        Route::get('user/verified/{id}', [UserController::class, 'verified'])->name('user.verified');
        Route::get('user/revert_verification/{id}', [UserController::class, 'revert_verification'])->name('user.revert_verification');
        Route::get('user/active/{id}', [UserController::class, 'active'])->name('user.active');
        Route::get('user/in_active/{id}', [UserController::class, 'in_active'])->name('user.in_active');
        Route::post('get_districts', [UserController::class, 'getDistricts'])->name('user.get_districts');
        Route::post('get_blocks', [UserController::class, 'getBlocks'])->name('user.get_blocks');
        Route::post('get_gram_panchyats', [UserController::class, 'getGramPanchyats'])->name('user.get_gram_panchyats');
        Route::post('get_villages', [UserController::class, 'getVillages'])->name('user.get_villages');
        Route::resource('user', UserController::class);
        /*******************USER ROUTE END*************/
        Route::get('report/monthly-progress', [ReportController::class, 'monthlyProgress'])->name('report.monthly-progress');
        Route::get('report/monthly-training', [ReportController::class, 'monthlyTraining'])->name('report.monthly-training');
        Route::get('report/basic-farmer-profile', [ReportController::class, 'basicFarmerProfile'])->name('report.basic-farmer-profile');
        Route::get('report/respondent_master', [ReportController::class, 'respondentMaster'])->name('report.respondent_master');
        Route::get('report/get-blocks/{district_id}', [ReportController::class, 'getBlocksByDistrict'])->name('report.get_blocks');
        Route::get('report/get_gram_panchyats/{block_id}', [ReportController::class, 'getGramPanchyatsByBlock'])->name('report.get_gram_panchyats');
        Route::get('report/get_villages/{gram_panchyat_id}', [ReportController::class, 'getVillagesByGramPanchyat'])->name('report.get_villages');
        Route::get('report/export', [ReportController::class, 'export'])->name('report.export');
        Route::get('report/respondent_master/view{id}', [ReportController::class, 'respondentMasterView'])->name('report.respondent_master_view');
        Route::get('framing/profile', [ReportController::class, 'framingProfile'])->name('framing.profile');
        Route::get('framing/profile/view{id}', [ReportController::class, 'framingProfileView'])->name('framing.profileView');
        Route::get('report/monthly-framing', [ReportController::class, 'monthlyReportFarmer'])->name('report.monthly-framing');
        Route::get('report/monthly-framing/view{id}', [ReportController::class, 'monthlyReportFarmerView'])->name('report.monthly-framing-view');
        Route::get('report/total-training', [ReportController::class, 'totalTraining'])->name('report.total-training');
        Route::get('report/total-training/view{id}', [ReportController::class, 'totalTrainingView'])->name('report.total-training-view');
    });
});
/****************** ADMIN MIDDLEWARE PAGES ROUTES END****************/
