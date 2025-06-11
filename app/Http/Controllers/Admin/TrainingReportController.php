<?php

namespace App\Http\Controllers\Admin;

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
        return view('admin.training_report.index');
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
       //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TrainingReport  $trainingReport
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $training_report = TrainingReport::find($id);
        return view('admin.training_report.show',compact('training_report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TrainingReport  $trainingReport
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TrainingReport  $trainingReport
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
