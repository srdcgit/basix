<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GramPanchyat;
use Exception;
use Illuminate\Http\Request;

class GramPanchyatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.gram_panchyat.index');
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
                'block_id' => 'required',
            ]);
            GramPanchyat::create($request->all());
            toastr()->success('Gram Panchyat Added Successfully');
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
     * @param  \App\Models\GramPanchyat  $gramPanchyat
     * @return \Illuminate\Http\Response
     */
    public function show(GramPanchyat $gramPanchyat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GramPanchyat  $gramPanchyat
     * @return \Illuminate\Http\Response
     */
    public function edit(GramPanchyat $gramPanchyat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GramPanchyat  $gramPanchyat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $gramPanchyat = GramPanchyat::find($id);
        $gramPanchyat->update($request->all());
        toastr()->success('Gram Panchyat Updated successfully');
        return redirect()->back(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GramPanchyat  $gramPanchyat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gramPanchyat = GramPanchyat::find($id);
        $gramPanchyat->delete();
        toastr()->success('Gram Panchyat Deleted successfully');
        return redirect()->back();
    }
}
