<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectUser;
use App\Models\ProjectUserExecutive;
use App\Models\ProjectUserFieldStaff;
use Exception;
use Illuminate\Http\Request;

class ProjectUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.project_user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.project_user.create');
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
                'user_id' => 'required',
            ]);
            $project_user = ProjectUser::create($request->all());
            foreach($request->executive_ids as $executive_id)
            {
                ProjectUserExecutive::create([
                    'user_id' => $executive_id,
                    'project_user_id' => $project_user->id,
                ]);
            }
            foreach($request->field_staff_ids as $field_staff_id)
            {
                ProjectUserFieldStaff::create([
                    'user_id' => $field_staff_id,
                    'project_user_id' => $project_user->id,
                ]);
            }
            toastr()->success('Project User Added Successfully');
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
     * @param  \App\Models\ProjectUser  $projectUser
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectUser $projectUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectUser  $projectUser
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project_user = ProjectUser::find($id);
        $project_user_exectives = ProjectUserExecutive::where('project_user_id',$project_user->id)->get()->pluck('user_id')->toArray();
        $project_user_field_staffs= ProjectUserFieldStaff::where('project_user_id',$project_user->id)->get()->pluck('user_id')->toArray();
        return view('admin.project_user.edit',compact('project_user','project_user_exectives','project_user_field_staffs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectUser  $projectUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $project_user = ProjectUser::find($id);
        $project_user->update($request->all());
        ProjectUserExecutive::whereNotIn('user_id',$request->executive_ids)->where('project_user_id',$project_user->id)->delete();
        foreach($request->executive_ids as $executive_id)
        {
            $project_executive = ProjectUserExecutive::where('user_id',$executive_id)->where('project_user_id',$project_user->id)->first();
            if(!$project_executive)
            {
                ProjectUserExecutive::create([
                    'user_id' => $executive_id,
                    'project_user_id' => $project_user->id
                ]);
            }
        }
        ProjectUserFieldStaff::whereNotIn('user_id',$request->field_staff_ids)->where('project_user_id',$project_user->id)->delete();
        foreach($request->field_staff_ids as $field_staff_id)
        {
            $project_field_staff = ProjectUserFieldStaff::where('user_id',$field_staff_id)->where('project_user_id',$project_user->id)->first();
            if(!$project_field_staff)
            {
                ProjectUserFieldStaff::create([
                    'user_id' => $field_staff_id,
                    'project_user_id' => $project_user->id
                ]);
            }
        }
        toastr()->success('Project Team Updated successfully');
        return redirect()->back(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectUser  $projectUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project_user = ProjectUser::find($id);
        ProjectUserFieldStaff::where('project_user_id',$project_user->id)->delete();
        ProjectUserExecutive::where('project_user_id',$project_user->id)->delete();
        $project_user->delete();
        toastr()->success('Project Team Deleted successfully');
        return redirect()->back();
    }
}
