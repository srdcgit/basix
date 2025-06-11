<?php

namespace App\Http\Controllers\FieldStaff;

use App\Http\Controllers\Controller;
use App\Models\FarmingIncome;
use App\Models\FarmingProfile;
use App\Models\FarmingYearling;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Type\FalseType;

class FarmingProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
                        
        $farmingProfilesIds = User::query()->join('farming_profiles', 'users.id', '=', 'farming_profiles.user_id')
                    ->where('users.field_staff_id', '=', Auth::user()->id)
                    ->select('farming_profiles.*')
                    ->get()->pluck('id')->toArray();
        $farmingProfiles = FarmingProfile::whereIn('id',$farmingProfilesIds)->get();
        return view('field_staff.farming_profile.index',compact('farmingProfiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('field_staff.farming_profile.create');
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
            $profile = FarmingProfile::create($request->all());
            FarmingYearling::create([
                'year' => $request->year,
                'figerlings' => $request->figerlings,
                'yearlings' => $request->yearlings,
                'farming_profile_id' => $profile->id
            ]);
            FarmingIncome::create([
                'year' => $request->fish_sold_year,
                'quantity' => $request->fish_sold_quantity,
                'rate' => $request->fish_sold_rate,
                'amount' => $request->fish_sold_amount,
                'farming_profile_id' => $profile->id
            ]);
            toastr()->success('Farming Profile Added Successfully');
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
    public function edit($id)
    {
        $farming_profile = FarmingProfile::find($id);
        return view('field_staff.farming_profile.edit',compact('farming_profile'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FarmingProfile  $farmingProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $farming_profile = FarmingProfile::find($id);
            $farming_profile->update($request->all());
            if($request->farming_yearling_id)
            {
                $farming_yearling = FarmingYearling::find($request->farming_yearling_id);
                $farming_yearling->update([
                    'year' => $request->year,
                    'figerlings' => $request->figerlings,
                    'yearlings' => $request->yearlings,
                ]);

            }else{
                FarmingYearling::create([
                    'year' => $request->year,
                    'figerlings' => $request->figerlings,
                    'yearlings' => $request->yearlings,
                    'farming_profile_id' => $farming_profile->id
                ]);
            }
            if($request->farming_income_id)
            {
                $farming_income = FarmingIncome::find($request->farming_income_id);
                $farming_income->update([
                    'year' => $request->fish_sold_year,
                    'quantity' => $request->fish_sold_quantity,
                    'rate' => $request->fish_sold_rate,
                    'amount' => $request->fish_sold_amount
                ]);

            }else{
                FarmingIncome::create([
                    'year' => $request->fish_sold_year,
                    'quantity' => $request->fish_sold_quantity,
                    'rate' => $request->fish_sold_rate,
                    'amount' => $request->fish_sold_amount,
                    'farming_profile_id' => $farming_profile->id
                ]);
            }
            toastr()->success('Farming Profile Updated Successfully');
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
     * @param  \App\Models\FarmingProfile  $farmingProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $farmingProfile = FarmingProfile::find($id);
        $farmingProfile->delete();
        toastr()->success('Farming Profile Deleted successfully');
        return redirect()->back();
    }
    public function validateReport($id)
    {
        $farmingProfile = FarmingProfile::find($id);
        $farmingProfile->update([
            'is_validate' => true
        ]);
        toastr()->success('Farming Profile Validated successfully');
        return redirect()->back();
    }
    public function un_validate($id)
    {
        $farmingProfile = FarmingProfile::find($id);
        $farmingProfile->update([
            'is_validate' => false
        ]);
        toastr()->success('Farming Profile Unvalidated successfully');
        return redirect()->back();
    }
}
