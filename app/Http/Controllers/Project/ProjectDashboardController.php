<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\GramPanchyat;
use App\Models\User;
use App\Models\FarmingProfile;
use App\Models\TrainingReport;
use App\Models\RespondentMaster;
use App\Models\MonthlyFarmingReport;
use App\Models\UserGramPanchyat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectDashboardController extends Controller
{
    public function index()
    {
        $executive_ids = User::where('role_id', 3)->where('user_id', Auth::user()->id)->get()->pluck('id')->toArray();
        $field_staff_ids = User::whereIn('executive_id', $executive_ids)->get()->pluck('id')->toArray();
        $total_respondent_masters = User::query()
            ->join('respondent_masters', 'users.id', '=', 'respondent_masters.user_id')
            ->whereIn('users.field_staff_id', $field_staff_ids)
            ->select('respondent_masters.*')
            ->count();
        $total_respondent_masters2 = count(RespondentMaster::all());   
        $farmingProfiles = User::query()->join('farming_profiles', 'users.id', '=', 'farming_profiles.user_id')
            ->whereIn('users.field_staff_id', $field_staff_ids)
            ->select('farming_profiles.*')
            ->count();
        $farmingProfiles2 = count(FarmingProfile::all());

        $monthlyFarmingReports = User::query()->join('monthly_farming_reports', 'users.id', '=', 'monthly_farming_reports.user_id')
            ->whereIn('users.field_staff_id', $field_staff_ids)
            ->select('monthly_farming_reports.*')
            ->count();
        $monthlyFarmingReports2 = count(MonthlyFarmingReport::all());    
        $trainingReports = User::query()->join('training_reports', 'users.id', '=', 'training_reports.user_id')
            ->whereIn('users.field_staff_id', $field_staff_ids)
            ->select('training_reports.*')
            ->count();
            $trainingReports2 = count(TrainingReport::all());    
        return view('project.project_dashboard.index', compact(
            'total_respondent_masters',
            'farmingProfiles',
            'trainingReports',
            'monthlyFarmingReports',
            'farmingProfiles2',
            'monthlyFarmingReports2',
            'total_respondent_masters2',
            'trainingReports2',
        ));
    }
}
