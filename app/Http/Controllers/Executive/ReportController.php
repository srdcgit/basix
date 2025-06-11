<?php

namespace App\Http\Controllers\Executive;

use App\Http\Controllers\Controller;
use App\Models\GramPanchyat;
use App\Models\User;
use App\Models\UserGramPanchyat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function monthlyProgress()
    {
        $field_staff_ids = User::where('executive_id',Auth::user()->id)->get()->pluck('id')->toArray();
        $crpUserIds = User::whereIn('field_staff_id', $field_staff_ids)->get()->pluck('id')->toArray();
        return view('executive.reports.monthly_progress_report',compact(
            'crpUserIds',
        ));
    }
    public function monthlyTraining()
    {
        $field_staff_ids = User::where('executive_id',Auth::user()->id)->get()->pluck('id')->toArray();
        $crpUserIds = User::whereIn('field_staff_id', $field_staff_ids)->get()->pluck('id')->toArray();
        return view('executive.reports.monthly_training_report',compact(
            'crpUserIds',
        ));
    }
    public function basicFarmerProfile()
    {
        $field_staff_ids = User::where('executive_id',Auth::user()->id)->get()->pluck('id')->toArray();
        $crpUserIds = User::whereIn('field_staff_id', $field_staff_ids)->get()->pluck('id')->toArray();
        $userGramPanchyatIds = UserGramPanchyat::whereIn('user_id',$crpUserIds)->get()->pluck('gram_panchyat_id')->toArray();
        $gramPanchyats = GramPanchyat::whereIn('id',$userGramPanchyatIds)->get();
        return view('executive.reports.report_basic_farmer_profile',compact(
            'gramPanchyats',
            'crpUserIds',
        ));   
    }
}
