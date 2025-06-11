@extends('admin.layout.index')

@section('title')
    Add New Project Team
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Add New Project Team</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('admin.project_user.store')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Choose Project</label>
                            <select  name="project_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Project</option>
                                @foreach(App\Models\Project::all() as $project)
                                <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Project Manager</label>
                            <select  name="user_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select User</option>
                                @foreach(App\Models\User::where('role_id',2)->get() as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Executive</label>
                            <select  name="executive_ids[]" multiple class="form-control select-search" data-fouc required>
                                <option disabled>Select Executive</option>
                                @foreach(App\Models\User::where('role_id',3)->get() as $executive)
                                <option value="{{$executive->id}}">{{$executive->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Field Staff</label>
                            <select  name="field_staff_ids[]" multiple class="form-control select-search" data-fouc required>
                                <option disabled>Select Executive</option>
                                @foreach(App\Models\User::where('role_id',4)->get() as $field_staff)
                                <option value="{{$field_staff->id}}">{{$field_staff->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Create <i class="icon-paperplane ml-2"></i></button>
                    </div>
                    
                </form>
            </div>
        </div>
        <!-- /basic layout -->

    </div>
</div>

@endsection

@section('scripts')
@endsection