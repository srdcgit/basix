<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use App\Models\FarmingProfile;
use Illuminate\Support\Facades\DB;
use App\Models\MonthlyFarmingReport;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helpers;
use App\Models\Block;
use App\Models\District;
use App\Models\FarmingYearling;
use App\Models\GramPanchyat;
use App\Models\RespondentMaster;
use App\Models\TrainingReport;
use App\Models\Village;

class DashboardController extends Controller
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
        $farmingProfiles = User::query()->join('farming_profiles', 'users.id', '=', 'farming_profiles.user_id')
            ->whereIn('users.field_staff_id', $field_staff_ids)
            ->select('farming_profiles.*')
            ->count();
        $monthlyFarmingReports = User::query()->join('monthly_farming_reports', 'users.id', '=', 'monthly_farming_reports.user_id')
            ->whereIn('users.field_staff_id', $field_staff_ids)
            ->select('monthly_farming_reports.*')
            ->count();
        $trainingReports = User::query()->join('training_reports', 'users.id', '=', 'training_reports.user_id')
            ->whereIn('users.field_staff_id', $field_staff_ids)
            ->select('training_reports.*')
            ->count();
        $project_name = Project::where('id', 9)->value('name');
        $districts = District::pluck('name', 'id');
        $blocksCount = [];
        $gramPanchayatsCount = [];
        $villagesCount = [];
        $respondentsCount = [];
        $totalBlocks = 0;
        $totalGramPanchayats = 0;
        $totalVillages = 0;
        $totalRespondents = 0;

        foreach ($districts as $districtId => $districtName) {
            $blocks = Block::where('district_id', $districtId)->get();
            $blocksCount[$districtName] = $blocks->count();

            $totalBlocks += $blocks->count();

            $districtGramPanchayatsCount = [];
            $districtVillagesCount = [];

            foreach ($blocks as $block) {
                $gramPanchayats = GramPanchyat::where('block_id', $block->id)->get();
                $districtGramPanchayatsCount[$block->id] = $gramPanchayats->count();

                $totalGramPanchayats += $gramPanchayats->count();

                $gramPanchayatVillagesCount = [];
                foreach ($gramPanchayats as $panchayat) {
                    $villages = Village::where('gram_panchyat_id', $panchayat->id)->count();
                    $gramPanchayatVillagesCount[$panchayat->id] = $villages;

                    $totalVillages += $villages;
                }

                $districtVillagesCount[$block->id] = $gramPanchayatVillagesCount;
            }

            $gramPanchayatsCount[$districtName] = $districtGramPanchayatsCount;
            $villagesCount[$districtName] = $districtVillagesCount;

            $respondentsCount[$districtName] = RespondentMaster::where('district_id', $districtId)->count();

            $totalRespondents += $respondentsCount[$districtName];
        }
        return view('project.dashboard.index', compact(
            'total_respondent_masters',
            'farmingProfiles',
            'trainingReports',
            'monthlyFarmingReports',
            'districts',
            'blocksCount',
            'gramPanchayatsCount',
            'villagesCount',
            'respondentsCount',
            'project_name',
            'totalBlocks',
            'totalGramPanchayats',
            'totalVillages',
            'totalRespondents'
        ));
    }
    public function monthlyProgress()
    {
        $currentYear = Carbon::now()->year;
        $previousYear = $currentYear - 1;

        $months = collect();
        $registrationsCurrentYear = collect();
        $registrationsPreviousYear = collect();
        $currentMonthFarmingReports = collect();

        $pondCleaningPercentages = collect();
        $limeApplyingPercentages = collect();
        $waterQualityPercentages = collect();
        $feedApplyingPercentages = collect();

        foreach (range(1, 12) as $monthNumber) {
            $monthName = Carbon::create($currentYear, $monthNumber, 1)->format('F');
            $months->push($monthName);

            $registrationsCurrentYear->push(
                FarmingProfile::whereYear('created_at', $currentYear)
                    ->whereMonth('created_at', $monthNumber)
                    ->count()
            );

            $registrationsPreviousYear->push(
                FarmingProfile::whereYear('created_at', $previousYear)
                    ->whereMonth('created_at', $monthNumber)
                    ->count()
            );

            $currentMonthFarmingReportsCount = MonthlyFarmingReport::where('month', $monthName)->count();
            $currentMonthFarmingReports->push($currentMonthFarmingReportsCount);

            $pondCleaning = MonthlyFarmingReport::where('month', $monthName)
                ->where('is_pond_preparation', 1)->count();
            $pondCleaningPercentages->push($currentMonthFarmingReportsCount > 0 ? ($pondCleaning / $currentMonthFarmingReportsCount) * 100 : 0);

            $limeApplying = MonthlyFarmingReport::where('month', $monthName)
                ->where('is_lime_applied', 1)->count();
            $limeApplyingPercentages->push($currentMonthFarmingReportsCount > 0 ? ($limeApplying / $currentMonthFarmingReportsCount) * 100 : 0);

            $waterQualityTesting = MonthlyFarmingReport::where('month', $monthName)
                ->where('is_hydrological', 1)->count();
            $waterQualityPercentages->push($currentMonthFarmingReportsCount > 0 ? ($waterQualityTesting / $currentMonthFarmingReportsCount) * 100 : 0);

            $feedApplying = MonthlyFarmingReport::where('month', $monthName)
                ->where('is_providing_feed', 1)->count();
            $feedApplyingPercentages->push($currentMonthFarmingReportsCount > 0 ? ($feedApplying / $currentMonthFarmingReportsCount) * 100 : 0);
        }
        return view('project.dashboard.monthly-progress', compact(
            'months',
            'currentYear',
            'previousYear',
            'registrationsCurrentYear',
            'registrationsPreviousYear',
            'currentMonthFarmingReports',
            'pondCleaningPercentages',
            'limeApplyingPercentages',
            'waterQualityPercentages',
            'feedApplyingPercentages'
        ));
    }
    public function framingProfile()
    {
        $kcc_account = FarmingProfile::where('has_hh_kcc_account', 1)->count();
        $bank_account = FarmingProfile::where('has_hh_bank_account', 1)->count();
        $mgnrega_card = FarmingProfile::where('has_hh_mgnrega_card', 1)->count();
        $bpl_no = FarmingProfile::where('has_hh_bpl_no', 1)->count();
        $pb_member = FarmingProfile::where('fish_pb_member', 1)->count();
        $shg_member = FarmingProfile::where('shg_member', 1)->count();
        $nursery_farmer = FarmingProfile::where('involvement_in_fishery', 'Nursery Farmer')->count();
        $grower = FarmingProfile::where('involvement_in_fishery', 'Grower')->count();
        $both_count = FarmingProfile::where('involvement_in_fishery', 'Both')->count();
        $totalWaterBody = FarmingProfile::sum('total_water_body');
        $lease_out = FarmingProfile::sum('lease_out_water_body');
        $lease_in = FarmingProfile::sum('lease_in_water_body');
        $own_water = FarmingProfile::sum('own_water_body');
        $aereator = FarmingProfile::where('aereator', 1)->count();
        $fishing_net = FarmingProfile::where('fishing_net', 1)->count();
        $tube_well = FarmingProfile::where('have_tube_well', 1)->count();
        $pump_set = FarmingProfile::where('have_pump_set', 1)->count();
        $cow_dung = FarmingProfile::where('have_apply_cow_dung', 1)->count();
        $applied_lime = FarmingProfile::where('have_applied_lime', 1)->count();
        $black_soil = FarmingProfile::where('have_remove_black_soil', 1)->count();
        $pond_preparation = MonthlyFarmingReport::where('is_pond_preparation', 1)->count();

        // $year1 = FarmingYearling::where('year',2023)->get();
        // $year2 = FarmingYearling::where('year',2024)->get();
        $years = FarmingYearling::distinct()->pluck('year');
        $countData = FarmingYearling::whereIn('year', $years)
            ->select(
                'year',
                DB::raw('SUM(figerlings) as total_figerlings'),
                DB::raw('SUM(yearlings) as total_yearlings')
            )
            ->groupBy('year')
            ->get();

        $percentages = [];

        foreach ($countData as $data) {
            $year = $data->year;
            $totalFigerlings = $data->total_figerlings;
            $totalYearlings = $data->total_yearlings;

            $total = $totalFigerlings + $totalYearlings;

            $percentageFigerlings = ($total > 0) ? ($totalFigerlings / $total) * 100 : 0;
            $percentageYearlings = ($total > 0) ? ($totalYearlings / $total) * 100 : 0;
            $percentages[$year] = [
                'percentage_figerlings' => round($percentageFigerlings, 2),
                'percentage_yearlings' => round($percentageYearlings, 2)
            ];
        }

        return view('project.dashboard.framing_profile', compact(
            'kcc_account',
            'bank_account',
            'bpl_no',
            'mgnrega_card',
            'pb_member',
            'shg_member',
            'nursery_farmer',
            'grower',
            'both_count',
            'totalWaterBody',
            'lease_out',
            'lease_in',
            'own_water',
            'aereator',
            'fishing_net',
            'tube_well',
            'pump_set',
            'cow_dung',
            'applied_lime',
            'black_soil',
            'pond_preparation',
            'percentages'
        ));
    }
    public function monthlyTraining()
    {
        $monthlyData = TrainingReport::select(
            DB::raw('YEAR(date_of_event) as year'),
            DB::raw('MONTH(date_of_event) as month'),
            DB::raw('SUM(number_of_male) as total_male'),
            DB::raw('SUM(number_of_female) as total_female'),
            DB::raw('SUM(number_of_participants) as total_participants')
        )
            ->groupBy(DB::raw('YEAR(date_of_event)'), DB::raw('MONTH(date_of_event)'))
            ->orderBy(DB::raw('YEAR(date_of_event)'), 'desc')
            ->orderBy(DB::raw('MONTH(date_of_event)'), 'desc')
            ->get();
        $village = TrainingReport::where('level_of_training', 'Village')->count();
        $district = TrainingReport::where('level_of_training', 'District')->count();
        $block = TrainingReport::where('level_of_training', 'Block')->count();
        $workshop = TrainingReport::where('type', 'Workshop')->count();
        $training = TrainingReport::where('type', 'Training')->count();
        $others = TrainingReport::where('type', 'Others')->count();
        $exposure = TrainingReport::where('type', 'Exposure')->count();
        $conceptSeeding = TrainingReport::where('type', 'Concept Seeding')->count();
        $farmer = TrainingReport::where('type_of_participants', 'Farmer')->count();
        $boD = TrainingReport::where('type_of_participants', 'BoD')->count();
        $fPOStaff = TrainingReport::where('type_of_participants', 'FPO Staff')->count();
        $govtStaff = TrainingReport::where('type_of_participants', 'Govt Staff')->count();
        return view('project.dashboard.monthly-training', compact(
            'monthlyData',
            'village',
            'district',
            'block',
            'workshop',
            'training',
            'others',
            'exposure',
            'conceptSeeding',
            'farmer',
            'boD',
            'fPOStaff',
            'govtStaff'

        ));
    }

    public function respondent()
    {
        $districts = District::pluck('name', 'id');
        $blocksCount = [];
        $gramPanchayatsCount = [];
        $villagesCount = [];
        $respondentsCount = [];

        foreach ($districts as $districtId => $districtName) {
            $blocks = Block::where('district_id', $districtId)->get();
            $blocksCount[$districtName] = $blocks->count();

            $districtGramPanchayatsCount = [];
            $districtVillagesCount = [];

            foreach ($blocks as $block) {
                $gramPanchayats = GramPanchyat::where('block_id', $block->id)->get();
                $districtGramPanchayatsCount[$block->id] = $gramPanchayats->count();

                $gramPanchayatVillagesCount = [];
                foreach ($gramPanchayats as $panchayat) {
                    $villages = Village::where('gram_panchyat_id', $panchayat->id)->count();
                    $gramPanchayatVillagesCount[$panchayat->id] = $villages;
                }

                $districtVillagesCount[$block->id] = $gramPanchayatVillagesCount;
            }

            $gramPanchayatsCount[$districtName] = $districtGramPanchayatsCount;
            $villagesCount[$districtName] = $districtVillagesCount;

            $respondentsCount[$districtName] = RespondentMaster::where('district_id', $districtId)->count();
        }
        $male = RespondentMaster::where('gender', 'Male')->count();
        $female = RespondentMaster::where('gender', 'Female')->count();
        $education_Primary = RespondentMaster::where('education', 'Primary')->count();
        $education_Illiterate = RespondentMaster::where('education', 'Illiterate')->count();
        $education_HSLC = RespondentMaster::where('education', 'HSLC')->count();
        $education_Graduate = RespondentMaster::where('education', 'Graduate')->count();
        $education_PG = RespondentMaster::where('education', 'PG')->count();
        $education_Technical = RespondentMaster::where('education', 'Technical Education')->count();
        $caste_general = RespondentMaster::where('caste', 'General')->count();
        $caste_st = RespondentMaster::where('caste', 'ST')->count();
        $caste_obc = RespondentMaster::where('caste', 'OBC')->count();
        $caste_sc = RespondentMaster::where('caste', 'SC')->count();

        return view('project.dashboard.respondent', compact(
            'districts',
            'blocksCount',
            'gramPanchayatsCount',
            'villagesCount',
            'respondentsCount',
            'male',
            'female',
            'education_Primary',
            'education_Illiterate',
            'education_HSLC',
            'education_Graduate',
            'education_PG',
            'education_Technical',
            'caste_general',
            'caste_st',
            'caste_obc',
            'caste_sc'
        ));
    }
    public function framingProfile2()
    {
        $water_ph_regularly = FarmingProfile::where('have_water_ph_regularly', 1)->count();
        $feeding_regularly = FarmingProfile::where('done_feeding_regularly', 1)->count();
        $regularly_cow_dung = FarmingProfile::where('have_regularly_apply_cow_dung', 1)->count();
        $regularly_apply_lime = FarmingProfile::where('have_regularly_apply_lime', 1)->count();
        $training = FarmingProfile::where('attend_training_programme', 1)->count();
        $exposure = FarmingProfile::where('exposure_good_practics', 1)->count();

        $averageFishQuantities = DB::table('monthly_farming_reports')
            ->select(
                DB::raw('YEAR(date_of_update) as year'),
                DB::raw('AVG(fish_quantity) as avg_quantity')
            )
            ->whereNotNull('date_of_update')
            ->whereIn(DB::raw('YEAR(date_of_update)'), [2023, 2024])
            ->groupBy(DB::raw('YEAR(date_of_update)'))
            ->get();
        // dd($averageFishQuantities);
        $averageFishAmounts = DB::table('monthly_farming_reports')
            ->select(
                DB::raw('YEAR(date_of_update) as year'),
                DB::raw('AVG(fish_amount) as avg_amount')
            )
            ->whereNotNull('date_of_update')
            ->whereIn(DB::raw('YEAR(date_of_update)'), [2023, 2024])
            ->groupBy(DB::raw('YEAR(date_of_update)'))
            ->get();
        //  dd($averageFishAmounts);    
        return view('project.dashboard.framing_profile2', compact(
            'water_ph_regularly',
            'feeding_regularly',
            'regularly_cow_dung',
            'regularly_apply_lime',
            'training',
            'exposure',
            'averageFishQuantities',
            'averageFishAmounts'
        ));
    }
    public function dashboard()
    {
        $executives = User::where('role_id', 3)->where('is_verified',1)->where('is_active',1)->count();
        $field_staff = User::where('role_id', 4)->where('is_verified',1)->where('is_active',1)->count();
        $crp = User::where('role_id', 5)->where('is_verified',1)->where('is_active',1)->count();
        $executives_names = User::where('role_id', 3)->where('is_verified',1)->where('is_active',1)->pluck('name');
        $field_staff_names = User::where('role_id', 4)->where('is_verified',1)->where('is_active',1)->pluck('name');
        $crp_names = User::where('role_id', 5)->where('is_verified',1)->where('is_active',1)->pluck('name');
        return view('project.dashboard.hr_dashboard', compact(
            'executives',
            'field_staff',
            'crp',
            'executives_names',
            'field_staff_names',
            'crp_names'
        ));
    }
}
