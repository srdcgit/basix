<?php

namespace App\Http\Controllers\FieldStaff;

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
        $crpUserIds = User::where('field_staff_id', Auth::user()->id)->get()->pluck('id')->toArray();
        return view('field_staff.reports.monthly_progress_report',compact(
            'crpUserIds',
        ));
    }
    public function monthlyTraining()
    {
        $crpUserIds = User::where('field_staff_id', Auth::user()->id)->get()->pluck('id')->toArray();
        return view('field_staff.reports.monthly_training_report',compact(
            'crpUserIds',
        ));
    }
     
    public function basicFarmerProfile()
    {
        $crpUserIds = User::where('field_staff_id', Auth::user()->id)->get()->pluck('id')->toArray();
        $userGramPanchyatIds = UserGramPanchyat::whereIn('user_id',$crpUserIds)->get()->pluck('gram_panchyat_id')->toArray();
        $gramPanchyats = GramPanchyat::whereIn('id',$userGramPanchyatIds)->get();
        return view('field_staff.reports.report_basic_farmer_profile',compact(
            'gramPanchyats',
            'crpUserIds',
        ));   
    }
}
