<?php

namespace App\Http\Controllers\FieldStaff;

use App\Http\Controllers\Controller;
use App\Models\TrainingReport;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainingReportsIds = User::query()->join('training_reports', 'users.id', '=', 'training_reports.user_id')
                            ->where('users.field_staff_id', '=', Auth::user()->id)
                            ->select('training_reports.*')
                            ->get()->pluck('id')->toArray();
        $trainingReports = TrainingReport::whereIn('id',$trainingReportsIds)->get();
        return view('field_staff.training_report.index',compact('trainingReports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('field_staff.training_report.create');
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
        return view('field_staff.training_report.edit',compact('training_report'));
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
    public function validateReport($id)
    {
        $trainingReport = TrainingReport::find($id);
        $trainingReport->update([
            'is_validate' => true
        ]);
        toastr()->success('Training Report Validated successfully');
        return redirect()->back();
    }
    public function un_validate($id)
    {
        $trainingReport = TrainingReport::find($id);
        $trainingReport->update([
            'is_validate' => false
        ]);
        toastr()->success('Training Report Unvalidated successfully');
        return redirect()->back();
    }
}
