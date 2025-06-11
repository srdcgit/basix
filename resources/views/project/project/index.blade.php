@extends('project.layout.index')

@section('title')
    Manage Project
@endsection

@section('content')

<div class="card">
    
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Manage Projects</h5>
        <div class="header-elements">
            <div class="list-icons">
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
                    <th>Project District Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach (Auth::user()->projects  as $key => $project_user)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        <a href="{{route('project.project_dashboard.index')}}">
                            {{$project_user->project->name}}
                        </a>
                    </td>
                    <td>{{$project_user->project->duration}}</td>
                    <td>{{@$project_user->project->state->name}}</td>
                    <td>{{@$project_user->project->district->name}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection

@section('scripts')
@endsection