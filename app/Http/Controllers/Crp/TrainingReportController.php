<?php

namespace App\Http\Controllers\Crp;

use App\Http\Controllers\Controller;
use App\Models\TrainingReport;
use Exception;
use Illuminate\Http\Request;

class TrainingReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('crp.training_report.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crp.training_report.create');
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
                'date_of_event' => 'required',
            ]);
            TrainingReport::create($request->all());
            toastr()->success('Training Report Added Successfully');
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
     * @param  \App\Models\TrainingReport  $trainingReport
     * @return \Illuminate\Http\Response
     */
    public function show(TrainingReport $trainingReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TrainingReport  $trainingReport
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $training_report = TrainingReport::find($id);
        return view('crp.training_report.edit',compact('training_report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TrainingReport  $trainingReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $trainingReport = TrainingReport::find($id);
            $trainingReport->update($request->all());
            toastr()->success('Training Report Updated successfully');
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
     * @param  \App\Models\TrainingReport  $trainingReport
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $trainingReport = TrainingReport::find($id);
            $trainingReport->delete();
            toastr()->success('Training Report Deleted successfully');
            return redirect()->back();
        }catch (Exception $e)
        {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
}
