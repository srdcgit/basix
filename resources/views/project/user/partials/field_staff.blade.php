
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
            
            @foreach ($users->where('role_id',4)  as $key => $field_staff)
            <tr>
                {{-- <td>{{$key+1}}</td> --}}
                <td>
                    @if($field_staff->image)
                    <img src="{{asset($field_staff->image)}}" height="100" width="100" alt="">
                    @endif
                </td>
                <td>{{$field_staff->name}}</td>
                <td>{{$field_staff->email}}</td>
                <td>{{$field_staff->phone}}</td>
                <td>
                    @if($field_staff->is_active)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">Pending</span>
                    @endif
                </td>
                <td>
                    <a href="{{route('project.user.show',$field_staff->id)}}" class="btn btn-primary btn-sm">Update</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table> 

</div>