<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MajorDelivery;
use Exception;
use Illuminate\Http\Request;

class MajorDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.major_delivery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.major_delivery.create');
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
                'project_id' => 'required',
            ]);
            foreach($request->deliverable as $key => $deliverable)
            {
                MajorDelivery::create([
                    'project_id' => $request->project_id,
                    'deliverable' => $deliverable,
                    'date' => $request->date[$key],
                ]);

            }
            toastr()->success('Major Delivery Added Successfully');
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
     * @param  \App\Models\MajorDelivery  $majorDelivery
     * @return \Illuminate\Http\Response
     */
    public function show(MajorDelivery $majorDelivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MajorDelivery  $majorDelivery
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $major_delivery = MajorDelivery::find($id);
        return view('admin.major_delivery.edit',compact('major_delivery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MajorDelivery  $majorDelivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $majorDelivery = MajorDelivery::find($id);
        $majorDelivery->update($request->all());
        toastr()->success('Major Delivery Updated successfully');
        return redirect()->back(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MajorDelivery  $majorDelivery
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $majorDelivery = MajorDelivery::find($id);
        $majorDelivery->delete();
        toastr()->success('Major Delivery Deleted successfully');
        return redirect()->back();
    }
}
