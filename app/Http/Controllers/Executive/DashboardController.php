<?php

namespace App\Http\Controllers\Executive;

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
        $field_staff_ids = User::where('executive_id',Auth::user()->id)->get()->pluck('id')->toArray();
        $total_respondent_masters = User::query()
                            ->join('respondent_masters', 'users.id', '=', 'respondent_masters.user_id')
                            ->whereIn('users.field_staff_id', $field_staff_ids)
                            ->select('respondent_masters.*')
                            ->count();
        $farmingProfiles = User::query()->join('farming_profiles', 'users.id', '=', 'farming_profiles.user_id')
                        ->whereIn('users.field_staff_id', $field_staff_ids)
                        ->select('farming_profiles.*')
                        ->count();
        $monthlyFarmingReports = User::query()->join('monthly_farming_reports', 'users.id', '=', 'monthly_farming_reports.user_id')
                        ->whereIn('users.field_staff_id', $field_staff_ids)
                        ->select('monthly_farming_reports.*')
                        ->count();
        $trainingReports = User::query()
                        ->join('training_reports', 'users.id', '=', 'training_reports.user_id')
                        ->whereIn('users.field_staff_id', $field_staff_ids)
                        ->select('training_reports.*')
                        ->count();
        $crpUserIds = User::whereIn('field_staff_id', $field_staff_ids)->get()->pluck('id')->toArray();
        $userGramPanchyatIds = UserGramPanchyat::whereIn('user_id',$crpUserIds)->get()->pluck('gram_panchyat_id')->toArray();
        $gramPanchyats = GramPanchyat::whereIn('id',$userGramPanchyatIds)->get();
        return view('executive.dashboard.index',compact(
            'total_respondent_masters',
            'farmingProfiles',
            'trainingReports',
            'monthlyFarmingReports',
            'gramPanchyats',
            'crpUserIds',
        ));
    }
}
