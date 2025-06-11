@extends('admin.layout.index')

@section('title')
    Manage Project
@endsection

@section('content')

<div class="card">
    
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Manage Projects</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a href="{{route('admin.project.create')}}" class="btn btn-primary text-right">Add New Project</a>
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table datatable-save-state">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Project Name</th>
                    <th>Project Duration</th>
                    <th>Project State Name</th>
                    {{-- <th>Project District Name</th> --}}
                    <th>Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (App\Models\Project::all()  as $key => $project)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$project->name}}</td>
                    <td>{{$project->duration}}</td>
                    <td>{{$project->state->name}}</td>
                    {{-- <td>{{$project->district->name}}</td> --}}
                    <td>
                        <a href="{{route('admin.project.edit',$project->id)}}" class="btn btn-primary btn-sm">Edit</a>
                        {{-- <button data-toggle="modal" data-target="#edit_modal" name="{{$project->name}}" 
                            duration="{{$project->duration}}" district_id="{{$project->district_id}}" state_id="{{$project->state_id}}" id="{{$project->id}}" class="edit-btn btn btn-primary">Edit</button> --}}
                    </td>
                    <td>
                        <form action="{{route('admin.project.destroy',$project->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                        <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection

@section('scripts')
@endsection