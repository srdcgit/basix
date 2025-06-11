<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FarmingIncome;
use App\Models\FarmingProfile;
use App\Models\FarmingYearling;
use App\Models\RespondentMaster;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FarmingProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $farmingProfiles = FarmingProfile::select('farming_profiles.*')
                ->where('user_id',Auth::user()->id)
                ->where('is_validate',1)
                ->with(
                    'respondent_master',
                    'project',
                    'farming_income',
                    'farming_yearling'
                    )->get();

            return response([
                "farmingProfiles" => $farmingProfiles,
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
            $profile = FarmingProfile::create($request->all());
            $farmingYearling = FarmingYearling::create([
                'year' => $request->year,
                'figerlings' => $request->figerlings,
                'yearlings' => $request->yearlings,
                'farming_profile_id' => $profile->id
            ]);
            $farmingIncome = FarmingIncome::create([
                'year' => $request->fish_sold_year,
                'quantity' => $request->fish_sold_quantity,
                'rate' => $request->fish_sold_rate,
                'amount' => $request->fish_sold_amount,
                'farming_profile_id' => $profile->id
            ]);    
            $profile->farmingYearling = $farmingYearling;
            $profile->farmingIncome = $farmingIncome;
            return response([
                "profile" => $profile,
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
     * @param  \App\Models\FarmingProfile  $farmingProfile
     * @return \Illuminate\Http\Response
     */
    public function show(FarmingProfile $farmingProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FarmingProfile  $farmingProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(FarmingProfile $farmingProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FarmingProfile  $farmingProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FarmingProfile $farmingProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FarmingProfile  $farmingProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(FarmingProfile $farmingProfile)
    {
        //
    }
    
    public function getFieldStaffIndex()
    {
        try {
            $farmingProfiles = User::query()->join('farming_profiles', 'users.id', '=', 'farming_profiles.user_id')
                ->where('users.field_staff_id', '=', Auth::user()->id)
                ->select('farming_profiles.*')->get();
            return response([
                "farmingProfiles" => $farmingProfiles,
            ], 200);
        } catch (\Exception $e) {
            return response([
                "error" => $e->getMessage()
            ], 500);
        }
    }
    public function getRPForFP()
    {
        try {
            $respondent_masters = RespondentMaster::where('user_id',Auth::user()->id)
                                ->where('is_validate',1)->get();
            $ids = [];
            foreach($respondent_masters as $respondent_master)
            {
                if($respondent_master->farming_profile->count() == 0)
                {
                    $ids[] = $respondent_master->id;
                }
            }
            $respondentMasters = RespondentMaster::whereIn('id',$ids)->get();
            return response([
                "respondentMasters" => $respondentMasters,
            ], 200);
        } catch (\Exception $e) {
            return response([
                "error" => $e->getMessage()
            ], 500);
        }
    }
    public function getRPForMFR()
    {
        try {
            $respondent_masters = RespondentMaster::where('user_id',Auth::user()->id)
                                ->where('is_validate',1)->get();
            $ids = [];
            foreach($respondent_masters as $respondent_master)
            {
                if($respondent_master->farming_profile->where('is_validate',1)->count() > 0)
                {
                    $ids[] = $respondent_master->id;
                }
            }
            $respondentMasters = RespondentMaster::whereIn('id',$ids)->get();
            return response([
                "respondentMasters" => $respondentMasters,
            ], 200);
        } catch (\Exception $e) {
            return response([
                "error" => $e->getMessage()
            ], 500);
        }
    }
}
