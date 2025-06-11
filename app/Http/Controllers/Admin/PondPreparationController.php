<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PondPreparation;
use Exception;
use Illuminate\Http\Request;

class PondPreparationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pond_preparation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pond_preparation.create');
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
            PondPreparation::create($request->all());
            toastr()->success('Pond Preparation Added Successfully');
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
     * @param  \App\Models\PondPreparation  $pondPreparation
     * @return \Illuminate\Http\Response
     */
    public function show(PondPreparation $pondPreparation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PondPreparation  $pondPreparation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pond_preparation = PondPreparation::find($id);
        return view('admin.pond_preparation.edit',compact('pond_preparation'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PondPreparation  $pondPreparation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $pond_preparation = PondPreparation::find($id);
            $pond_preparation->update($request->all());
            toastr()->success('Pond Preparation Updated Successfully');
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
     * @param  \App\Models\PondPreparation  $pondPreparation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pond_preparation = PondPreparation::find($id);
        $pond_preparation->delete();
        toastr()->success('Pond Preparation Deleted successfully');
        return redirect()->back();
    }
}
