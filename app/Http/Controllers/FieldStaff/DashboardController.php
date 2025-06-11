<?php

namespace App\Http\Controllers\FieldStaff;

use App\Http\Controllers\Controller;
use App\Models\GramPanchyat;
use App\Models\User;
use App\Models\UserGramPanchyat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $total_respondent_masters = User::query()
                            ->join('respondent_masters', 'users.id', '=', 'respondent_masters.user_id')
                            ->where('users.field_staff_id', '=', Auth::user()->id)
                            ->select('respondent_masters.*')
                            ->count();
        $farmingProfiles = User::query()->join('farming_profiles', 'users.id', '=', 'farming_profiles.user_id')
                        ->where('users.field_staff_id', '=', Auth::user()->id)
                        ->select('farming_profiles.*')
                        ->count();
        $monthlyFarmingReports = User::query()->join('monthly_farming_reports', 'users.id', '=', 'monthly_farming_reports.user_id')
                        ->where('users.field_staff_id', '=', Auth::user()->id)
                        ->select('monthly_farming_reports.*')
                        ->count();
        $trainingReports = User::query()->join('training_reports', 'users.id', '=', 'training_reports.user_id')
                        ->where('users.field_staff_id', '=', Auth::user()->id)
                        ->select('training_reports.*')
                        ->count();
        return view('field_staff.dashboard.index',compact(
            'total_respondent_masters',
            'farmingProfiles',
            'trainingReports',
            'monthlyFarmingReports'
        ));
    }
}
