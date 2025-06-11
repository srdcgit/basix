<?php

namespace App\Http\Controllers\FieldStaff;

use App\Http\Controllers\Controller;
use App\Models\RespondentMaster;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RespondentMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $respondentMasters = User::query()->join('respondent_masters', 'users.id', '=', 'respondent_masters.user_id')
                            ->where('users.field_staff_id', '=', Auth::user()->id)
                            ->select('respondent_masters.*')
                            ->get();
        return view('field_staff.respondent_master.index',compact('respondentMasters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('field_staff.respondent_master.create');
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
                'name' => 'required',
                'district_id' => 'required',
            ]);
            $randomNumber = random_int(100000, 999999);
            $request->merge([
                'farmer_id' => 'SDS-'.$randomNumber
            ]);
            RespondentMaster::create($request->all());
            toastr()->success('Respondent Master Added Successfully');
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
     * @param  \App\Models\RespondentMaster  $respondentMaster
     * @return \Illuminate\Http\Response
     */
    public function show(RespondentMaster $respondentMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RespondentMaster  $respondentMaster
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $respondent_master = RespondentMaster::find($id);
        return view('field_staff.respondent_master.edit',compact('respondent_master'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RespondentMaster  $respondentMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $respondentMaster = RespondentMaster::find($id);
        $respondentMaster->update($request->all());
        toastr()->success('Respondent Master Updated successfully');
        return redirect()->back(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RespondentMaster  $respondentMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $respondentMaster = RespondentMaster::find($id);
        $respondentMaster->delete();
        toastr()->success('Respondent Master Deleted successfully');
        return redirect()->back();
    }
    public function validateReport($id)
    {
        $respondentMaster = RespondentMaster::find($id);
        $respondentMaster->update([
            'is_validate' => true
        ]);
        toastr()->success('Respondent Master Validated successfully');
        return redirect()->back();
    }
    public function un_validate($id)
    {
        $respondentMaster = RespondentMaster::find($id);
        $respondentMaster->update([
            'is_validate' => false
        ]);
        toastr()->success('Responden Master Unvalidated successfully');
        return redirect()->back();
    }
}