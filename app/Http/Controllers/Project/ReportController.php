<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\GramPanchyat;
use App\Models\Village;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Block;
use App\Models\District;
use App\Models\RespondentMaster;
use App\Models\FarmingProfile;
use App\Models\TrainingReport;
use App\Models\MonthlyFarmingReport;
use App\Models\UserGramPanchyat;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RespondentMasterExport;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function monthlyProgress()
    {

        $executive_ids = User::where('role_id', 3)->where('user_id', Auth::user()->id)->get()->pluck('id')->toArray();
        $field_staff_ids = User::whereIn('executive_id', $executive_ids)->get()->pluck('id')->toArray();
        $crpUserIds = User::whereIn('field_staff_id', $field_staff_ids)->get()->pluck('id')->toArray();

        return view('project.reports.monthly_progress_report', compact(
            'crpUserIds',
        ));
    }
    public function monthlyTraining()
    {
        $now = Carbon::now();
        $executive_ids = User::where('role_id', 3)->where('user_id', Auth::user()->id)->get()->pluck('id')->toArray();
        $field_staff_ids = User::whereIn('executive_id', $executive_ids)->get()->pluck('id')->toArray();
        $crpUserIds = User::whereIn('field_staff_id', $field_staff_ids)->get()->pluck('id')->toArray();
        return view('project.reports.monthly_training_report', compact(
            'crpUserIds',
        ));
    }
    public function basicFarmerProfile()
    {

        $executive_ids = User::where('role_id', 3)->where('user_id', Auth::user()->id)->get()->pluck('id')->toArray();
        $field_staff_ids = User::whereIn('executive_id', $executive_ids)->get()->pluck('id')->toArray();
        $crpUserIds = User::whereIn('field_staff_id', $field_staff_ids)->get()->pluck('id')->toArray();
        $userGramPanchyatIds = UserGramPanchyat::whereIn('user_id', $crpUserIds)->get()->pluck('gram_panchyat_id')->toArray();
        $gramPanchyats = GramPanchyat::whereIn('id', $userGramPanchyatIds)->get();
        return view('project.reports.report_basic_farmer_profile', compact(
            'gramPanchyats',
            'crpUserIds',
        ));
    }
    public function respondentMaster(Request $request)
    {

        $districts = District::all();
        $blocks = collect();
        $gramPanchyats = collect();
        $villages = collect();

        $query = RespondentMaster::query();

        if ($request->has('district_id') && $request->district_id != '') {
            $query->where('district_id', $request->district_id);
            $blocks = Block::where('district_id', $request->district_id)->get();
        }

        if ($request->has('block_id') && $request->block_id != '') {
            $query->where('block_id', $request->block_id);
            $gramPanchyats = GramPanchyat::where('block_id', $request->block_id)->get();
        }

        if ($request->has('gram_panchyat_id') && $request->gram_panchyat_id != '') {
            $query->where('gram_panchyat_id', $request->gram_panchyat_id);
            $villages = Village::where('gram_panchyat_id', $request->gram_panchyat_id)->get();
        }

        if ($request->has('village_id') && $request->village_id != '') {
            $query->where('village_id', $request->village_id);
        }

        $respondent_masters = $query->get();

        return view('project.reports.respondent_master', compact('respondent_masters', 'districts', 'blocks', 'gramPanchyats', 'villages'));
    }

    public function getBlocksByDistrict($district_id)
    {
        $blocks = Block::where('district_id', $district_id)->get();
        return response()->json($blocks);
    }
    public function getGramPanchyatsByBlock($block_id)
    {
        $gramPanchyats = GramPanchyat::where('block_id', $block_id)->get();
        return response()->json($gramPanchyats);
    }

    public function getVillagesByGramPanchyat($gram_panchyat_id)
    {
        $villages = Village::where('gram_panchyat_id', $gram_panchyat_id)->get();
        return response()->json($villages);
    }
    public function export(Request $request)
    {
        $query = RespondentMaster::query();
    
        if ($request->has('district_id') && $request->district_id != '') {
            $query->where('district_id', $request->district_id);
        }
    
        if ($request->has('block_id') && $request->block_id != '') {
            $query->where('block_id', $request->block_id);
        }
    
        if ($request->has('gram_panchyat_id') && $request->gram_panchyat_id != '') {
            $query->where('gram_panchyat_id', $request->gram_panchyat_id);
        }
    
        if ($request->has('village_id') && $request->village_id != '') {
            $query->where('village_id', $request->village_id);
        }
    
        $respondent_masters = $query->get();
    
        return Excel::download(new RespondentMasterExport($respondent_masters), 'respondent_masters.xlsx');
    }
    
    public function respondentMasterView($id)
    {
        $respondentMasterview = RespondentMaster::find($id);
        return view('project.reports.respondent_master_view', compact('respondentMasterview'));
    }
    public function framingProfile()
    {
        return view('project.reports.framing_profile');
    }
    public function framingProfileView($id)
    {
        $farming_profile = FarmingProfile::find($id);
        return view('project.reports.framing_profile_view', compact('farming_profile'));
    }
    public function monthlyReportFarmer()
    {
        return view('project.reports.monthly_framing_report');
    }
    public function monthlyReportFarmerView($id)
    {
        $monthly_farming_report = MonthlyFarmingReport::find($id);
        return view('project.reports.monthly_framing_report_view', compact('monthly_farming_report'));
    }
    public function totalTraining()
    {
        return view('project.reports.total_training_report');
    }
    public function totalTrainingView($id)
    {
        $training_report = TrainingReport::find($id);
        return view('project.reports.total_training_report_view', compact('training_report'));
    }
}
