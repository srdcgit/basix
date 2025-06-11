<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\MonthlyFarmingReport;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonthlyFarmingReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $monthlyFarmingReports = MonthlyFarmingReport::select('monthly_farming_reports.*')
            ->where('user_id',Auth::user()->id)
            ->where('is_validate',1)
            ->with(
                'respondent_master',
                'user'
                )->get();

            return response([
                "monthlyFarmingReports" => $monthlyFarmingReports,
            ], 200);
        } catch (\Exception $e) {
            return response([
                "error" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $this->validate($request,[
                'user_id' => 'required',
            ]);
            $monthlyFarmingReport = MonthlyFarmingReport::create($request->all());
            return response([
                "monthlyFarmingReport" => $monthlyFarmingReport,
            ], 200);
        }catch (Exception $e)
        {
            return response([
                "success" => false,
                "message" => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MonthlyFarmingReport  $monthlyFarmingReport
     * @return \Illuminate\Http\Response
     */
    public function show(MonthlyFarmingReport $monthlyFarmingReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MonthlyFarmingReport  $monthlyFarmingReport
     * @return \Illuminate\Http\Response
     */
    public function edit(MonthlyFarmingReport $monthlyFarmingReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MonthlyFarmingReport  $monthlyFarmingReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MonthlyFarmingReport $monthlyFarmingReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MonthlyFarmingReport  $monthlyFarmingReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(MonthlyFarmingReport $monthlyFarmingReport)
    {
        //
    }
    
    public function getFieldStaffIndex()
    {
        try {
            $monthlyFarmingReports = User::query()->join('monthly_farming_reports', 'users.id', '=', 'monthly_farming_reports.user_id')
                    ->where('users.field_staff_id', '=', Auth::user()->id)
                    ->select('monthly_farming_reports.*')->get();
            return response([
                "monthlyFarmingReports" => $monthlyFarmingReports,
            ], 200);
        } catch (\Exception $e) {
            return response([
                "error" => $e->getMessage()
            ], 500);
        }
    }
    public function getMonths(Request $request)
    {
        try{
            $this->validate($request,[
                'respondent_master_id' => 'required',
            ]);
            $have_months = MonthlyFarmingReport::where('respondent_master_id',$request->respondent_master_id)->pluck('month')->toArray();
            $months = Helpers::getMonths();
            $available_months = [];
            foreach($months as $month)
            {
                if(!in_array($month,$have_months))
                {
                    $available_months[] = $month;
                }
            }
            return response([
                "available_months" => $available_months,
            ], 200);
        }catch (Exception $e)
        {
            return response([
                "success" => false,
                "message" => $e->getMessage(),
            ], 500);
        }
    }
}
