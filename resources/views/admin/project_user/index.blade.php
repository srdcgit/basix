@extends('admin.layout.index')

@section('title')
    Manage Project Team
@endsection

@section('content')

<div class="card">
    
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Manage Project Teams</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a href="{{route('admin.project_user.create')}}" class="btn btn-primary text-right">Add New Project Team</a>
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
                    <th>Project Manager</th>
                    <th>Project Executive Count</th>
                    <th>Project Field Staff Count</th>
                    <th>Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (App\Models\ProjectUser::all()  as $key => $project_user)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$project_user->project->name}}</td>
                    <td>{{$project_user->user->name}}</td>
                    <td>{{$project_user->project_user_executives->count()}}</td>
                    <td>{{$project_user->project_user_field_staffs->count()}}</td>
                    <td>
                        <a href="{{route('admin.project_user.edit',$project_user->id)}}" class="btn btn-primary btn-sm">Edit</a>
                    </td>
                    <td>
                        <form action="{{route('admin.project_user.destroy',$project_user->id)}}" method="POST">
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