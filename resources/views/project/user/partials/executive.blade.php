
<div class="table-responsive">
    <table class="table datatable-save-state">
        <thead>
            <tr>
                {{-- <th>#</th> --}}
                <th>Profile Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($users->where('role_id',3)  as $key => $executive)
            <tr>
                {{-- <td>{{$key+1}}</td> --}}
                <td>
                    @if($executive->image)
                    <img src="{{asset($executive->image)}}" height="100" width="100" alt="">
                    @endif
                </td>
                <td>{{$executive->name}}</td>
                <td>{{$executive->email}}</td>
                <td>{{$executive->phone}}</td>
                <td>
                    @if($executive->is_active)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">Pending</span>
                    @endif
                </td>
                <td>
                    <a href="{{route('project.user.show',$executive->id)}}" class="btn btn-primary btn-sm">Update</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table> 

</div>