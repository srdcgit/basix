@extends('admin.layout.index')

@section('title')
Field Staffs
@endsection

@section('content')

<div class="card">
    
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Manage Field Staffs</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('admin.user.create_field_staff')}}" class="btn btn-sm btn-primary float-right">Create Field Staff</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table datatable-save-state">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Profile Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Executive Name</th>
                        <th>Verified</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach (App\Models\User::where('role_id',4)->get()  as $key => $user)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>
                            @if($user->image)
                            <img src="{{asset($user->image)}}" height="100" width="100" alt="">
                            @endif
                        </td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{@$user->executive ? @$user->executive->name : ''}}</td>
                        <td>
                            @if($user->is_verified)
                                <span class="badge badge-success">Verified</span>
                            @else
                                <span class="badge badge-danger">Not Verified</span>
                            @endif
                        </td>
                        <td>
                            @if($user->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Pending</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('admin.user.show',$user->id)}}" class="btn btn-primary btn-sm">Show</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table> 
    
        </div>

    </div>
</div>
@endsection
@section('scripts')
@endsection
