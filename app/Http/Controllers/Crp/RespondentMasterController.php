<?php

namespace App\Http\Controllers\Crp;

use App\Exports\CrpRespondentMaster;
use App\Http\Controllers\Controller;
use App\Models\RespondentMaster;
use App\Models\UserBlock;
use App\Models\UserGramPanchyat;
use App\Models\UserVillage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class RespondentMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $respondentMasters = RespondentMaster::where('user_id', Auth::id())
            ->with('farming_profile')
            ->get();
        // dd($respondentMasters->toArray());
        return view('crp.respondent_master.index', compact('respondentMasters'));
    }

    public function export()
    {
        return Excel::download(new CrpRespondentMaster, 'Crp_respondent_master_list.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user_block_ids = UserBlock::where('user_id', Auth::user()->id)->get()->pluck('block_id')->toArray();
        $user_gram_panchyat_ids = UserGramPanchyat::where('user_id', Auth::user()->id)->get()->pluck('gram_panchyat_id')->toArray();
        $user_villages_ids = UserVillage::where('user_id', Auth::user()->id)->get()->pluck('village_id')->toArray();
        return view('crp.respondent_master.create', compact('user_block_ids', 'user_gram_panchyat_ids', 'user_villages_ids'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'district_id' => 'required',
            ]);
            $randomNumber = random_int(100000, 999999);
            $request->merge([
                'farmer_id' => 'SDS-' . $randomNumber
            ]);
            RespondentMaster::create($request->all());
            toastr()->success('Respondent Master Added Successfully');
            return redirect()->back();
        } catch (Exception $e) {
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
        return view('crp.respondent_master.edit', compact('respondent_master'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RespondentMaster  $respondentMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
}
