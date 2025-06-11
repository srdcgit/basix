<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectBlock;
use App\Models\ProjectDistrict;
use App\Models\ProjectGramPanchyat;
use App\Models\ProjectVillage;
use Exception;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.project.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.project.create');
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
                'state_id' => 'required',
                'duration' => 'required',
            ]);
            $project = Project::create($request->all());
            foreach($request->district_ids as $district_id)
            {
                ProjectDistrict::create([
                    'district_id' => $district_id,
                    'project_id' => $project->id
                ]);
            }
            foreach($request->block_ids as $block_id)
            {
                ProjectBlock::create([
                    'block_id' => $block_id,
                    'project_id' => $project->id
                ]);
            }

            toastr()->success('Project Added Successfully');
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
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        $project_blocks = ProjectBlock::where('project_id',$project->id)->get()->pluck('block_id')->toArray();
        $project_districts = ProjectDistrict::where('project_id',$project->id)->get()->pluck('district_id')->toArray();
        return view('admin.project.edit',compact('project','project_blocks','project_districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $project = Project::find($id);
        $project->update($request->all());
        ProjectDistrict::whereNotIn('district_id',$request->district_ids)->where('project_id',$project->id)->delete();
        foreach($request->district_ids as $district_id)
        {
            $project_block = ProjectDistrict::where('district_id',$district_id)->where('project_id',$project->id)->first();
            if(!$project_block)
            {
                ProjectDistrict::create([
                    'district_id' => $district_id,
                    'project_id' => $project->id
                ]);
            }
        }
        ProjectBlock::whereNotIn('block_id',$request->block_ids)->where('project_id',$project->id)->delete();
        foreach($request->block_ids as $block_id)
        {
            $project_block = ProjectBlock::where('block_id',$block_id)->where('project_id',$project->id)->first();
            if(!$project_block)
            {
                ProjectBlock::create([
                    'block_id' => $block_id,
                    'project_id' => $project->id
                ]);
            }
        }
        
        toastr()->success('Project Updated successfully');
        return redirect()->back(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        ProjectBlock::where('project_id',$project->id)->delete();
        ProjectGramPanchyat::where('project_id',$project->id)->delete();
        ProjectVillage::where('project_id',$project->id)->delete();
        $project->delete();
        toastr()->success('Project Deleted successfully');
        return redirect()->back();
    }
}
