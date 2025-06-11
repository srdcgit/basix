<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PoliceStation;
use Exception;
use Illuminate\Http\Request;

class PoliceStationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.police_station.index');
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
                'name' => 'required',
            ]);
            PoliceStation::create($request->all());
            toastr()->success('Police Station Added Successfully');
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
     * @param  \App\Models\PoliceStation  $policeStation
     * @return \Illuminate\Http\Response
     */
    public function show(PoliceStation $policeStation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PoliceStation  $policeStation
     * @return \Illuminate\Http\Response
     */
    public function edit(PoliceStation $policeStation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PoliceStation  $policeStation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $policeStation = PoliceStation::find($id);
        $policeStation->update($request->all());
        toastr()->success('Police Station Updated successfully');
        return redirect()->back(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PoliceStation  $policeStation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $policeStation = PoliceStation::find($id);
        $policeStation->delete();
        toastr()->success('Police Station Deleted successfully');
        return redirect()->back();
    }
}
