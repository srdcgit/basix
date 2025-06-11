<?php 
/****************** ADMIN MIDDLEWARE PAGES ROUTES START****************/

use App\Http\Controllers\Admin\BlockController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\FarmingProfileController;
use App\Http\Controllers\Admin\GramPanchyatController;
use App\Http\Controllers\Admin\MajorDeliveryController;
use App\Http\Controllers\Admin\MonthlyFarmingReportController;
use App\Http\Controllers\Admin\PoliceStationController;
use App\Http\Controllers\Admin\PondPreparationController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ProjectUserController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RespondentMasterController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\TrainingReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VillageController;

Route::group(['prefix' => 'admin', 'as'=>'admin.','middleware' => 'auth:user'], function () {
    Route::group(['middleware' => 'admin'], function () {  
        /*******************DASHBOARD ROUTE START*************/       
        Route::view('dashboard','admin.dashboard.index')->name('dashboard.index');
        /*******************DASHBOARD ROUTE END*************/       
        /*******************USER ROUTE START*************/       
        Route::view('user/create_project_manager','admin.user.project_manager.create')->name('user.create_project_manager');
        Route::view('user/project_manager','admin.user.project_manager.index')->name('user.project_manager');
        Route::view('user/create_admin','admin.user.admin.create')->name('user.create_admin');
        Route::view('user/admin','admin.user.admin.index')->name('user.admin');
        Route::view('user/create_field_staff','admin.user.field_staff.create')->name('user.create_field_staff');
        Route::view('user/field_staff','admin.user.field_staff.index')->name('user.field_staff');
        Route::view('user/create_executive','admin.user.executive.create')->name('user.create_executive');
        Route::view('user/executive','admin.user.executive.index')->name('user.executive');
        Route::view('user/create_crp','admin.user.crp.create')->name('user.create_crp');
        Route::view('user/crp','admin.user.crp.index')->name('user.crp');
        Route::get('user/verified/{id}',[UserController::class,'verified'])->name('user.verified');
        Route::get('user/revert_verification/{id}',[UserController::class,'revert_verification'])->name('user.revert_verification');
        Route::get('user/active/{id}',[UserController::class,'active'])->name('user.active');
        Route::get('user/in_active/{id}',[UserController::class,'in_active'])->name('user.in_active');
        Route::resource('user',UserController::class);
        /*******************USER ROUTE END*************/          
        /*******************COUNTRY ROUTE START*************/       
        Route::resource('country',CountryController::class);
        /*******************COUNTRY ROUTE END*************/            
        /*******************STATE ROUTE START*************/       
        Route::resource('state',StateController::class);
        /*******************STATE ROUTE END*************/               
        /*******************CITY ROUTE START*************/       
        Route::resource('city',CityController::class);
        /*******************CITY ROUTE END*************/
        /*******************POLICE STATION ROUTE START*************/       
        Route::resource('police_station',PoliceStationController::class);
        /*******************POLICE STATION  ROUTE END*************/  
        /*******************District ROUTE START*************/       
        Route::resource('district',DistrictController::class);
        /*******************District ROUTE END*************/      
        /*******************Block ROUTE START*************/       
        Route::resource('block',BlockController::class);
        /*******************Block ROUTE END*************/    
        /*******************Gram Panchyat ROUTE START*************/       
        Route::post('location/get_village_data',[ReportController::class,'getVillagesData'])->name('location.get_village_data');
        Route::get('location/report',[ReportController::class,'getLocationReport'])->name('location.report');
        Route::resource('gram_panchyat',GramPanchyatController::class);
        /*******************Gram Panchyat ROUTE END*************/     
        /*******************Village ROUTE START*************/       
        Route::resource('village',VillageController::class);
        /*******************Village ROUTE END*************/        
        /*******************Project ROUTE START*************/       
        Route::resource('project',ProjectController::class);
        /*******************Project ROUTE END*************/        
        /*******************Project User ROUTE START*************/       
        Route::resource('project_user',ProjectUserController::class);
        /*******************Project User ROUTE END*************/      
        /*******************Major Delivery ROUTE START*************/       
        Route::resource('major_delivery',MajorDeliveryController::class);
        /*******************Major Delivery ROUTE END*************/      
        /*******************Respondent Master ROUTE START*************/       
        Route::resource('respondent_master',RespondentMasterController::class);
        /*******************Respondent Master ROUTE END*************/   
        /*******************Farming Profile ROUTE START*************/       
        Route::resource('farming_profile',FarmingProfileController::class);
        /*******************Farming Profile ROUTE END*************/   
        /*******************Pond Preparation ROUTE START*************/       
        Route::resource('pond_preparation',PondPreparationController::class);
        /*******************Pond Preparation ROUTE END*************/   
        /*******************Monthly Farming Report ROUTE START*************/       
        Route::post('get_months',[MonthlyFarmingReportController::class,'getMonths'])->name('monthly_farming_report.getMonths');
        Route::post('get_districts',[MonthlyFarmingReportController::class,'getDistricts'])->name('monthly_farming_report.get_districts');
        Route::post('get_blocks',[MonthlyFarmingReportController::class,'getBlocks'])->name('monthly_farming_report.get_blocks');
        Route::post('get_gram_panchyats',[MonthlyFarmingReportController::class,'getGramPanchyats'])->name('monthly_farming_report.get_gram_panchyats');
        Route::post('get_villages',[MonthlyFarmingReportController::class,'getVillages'])->name('monthly_farming_report.get_villages');
        Route::resource('monthly_farming_report',MonthlyFarmingReportController::class);
        /*******************Monthly Farming Report ROUTE END*************/   
        /*******************TRAINING REPORT ROUTE START*************/       
        Route::resource('training_report',TrainingReportController::class);
        /*******************TRAINING REPORT ROUTE END*************/   
    });
});
/****************** ADMIN MIDDLEWARE PAGES ROUTES END****************/
?>