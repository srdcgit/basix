<?php

namespace App\Http\Controllers\Crp;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\GramPanchyat;
use App\Models\MonthlyFarmingReport;
use App\Models\UserBlock;
use App\Models\UserGramPanchyat;
use App\Models\UserVillage;
use App\Models\Village;
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
        return view('crp.monthly_farming_report.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crp.monthly_farming_report.create');
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
            MonthlyFarmingReport::create($request->all());
            toastr()->success('Monthly Farming Report Added Successfully');
            return redirect()->back();
        }catch (Exception $e)
        {
            toastr()->error($e->getMessage());
            return redirect()->back();
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
    public function edit($id)
    {
        $monthly_farming_report = MonthlyFarmingReport::find($id);
        $have_months = MonthlyFarmingReport::where('respondent_master_id',$monthly_farming_report->respondent_master_id)->pluck('month')->toArray();
        $months = Helpers::getMonths();
        $available_months = [];
        foreach($months as $month)
        {
            if(!in_array($month,$have_months))
            {
                $available_months[] = $month;
            }
        }
        return view('crp.monthly_farming_report.edit',compact('monthly_farming_report','available_months'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MonthlyFarmingReport  $monthlyFarmingReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $monthly_farming_report = MonthlyFarmingReport::find($id);
            $monthly_farming_report->update($request->all());
            toastr()->success('Monthly Farming Report Updated Successfully');
            return redirect()->back();
        }catch (Exception $e)
        {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MonthlyFarmingReport  $monthlyFarmingReport
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $monthly_farming_report = MonthlyFarmingReport::find($id);
        $monthly_farming_report->delete();
        toastr()->success('Monthly Farming Report Deleted successfully');
        return redirect()->back();
    }
    
    public function getMonths(Request $request)
    {
        $have_months = MonthlyFarmingReport::where('respondent_master_id',$request->master_id)->pluck('month')->toArray();
        $months = Helpers::getMonths();
        $available_months = [];
        foreach($months as $month)
        {
            if(!in_array($month,$have_months))
            {
                $available_months[] = $month;
            }
        }
        return response()->json([
            'available_months' => $available_months,
        ]);
    }
    public function getBlocks(Request $request)
    {
        $user_blocks= UserBlock::where('user_id',Auth::user()->id)->get()->pluck('block_id')->toArray();
        $blocks = Block::whereIn('id',$user_blocks)->where('district_id',$request->district_id)->get();
        return response()->json([
            'blocks' => $blocks,
        ]);
    }
    public function getGramPanchyats(Request $request)
    {
        $user_gram_panchyats = UserGramPanchyat::where('user_id',Auth::user()->id)->get()->pluck('gram_panchyat_id')->toArray();        
        $gram_panchyats = GramPanchyat::whereIn('id',$user_gram_panchyats)->where('block_id',$request->block_id)->get();
        return response()->json([
            'gram_panchyats' => $gram_panchyats,
        ]);
    }
    public function getVillages(Request $request)
    {
        $user_villages = UserVillage::where('user_id',Auth::user()->id)->get()->pluck('village_id')->toArray();
        $villages = Village::whereIn('id',$user_villages)->where('gram_panchyat_id',$request->gram_panchyat_id)->get();
        return response()->json([
            'villages' => $villages,
        ]);
    }
}
