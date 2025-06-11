
<div class="table-responsive">
    <table class="table datatable-save-state">
        <thead>
            <tr>
                {{-- <th>#</th> --}}
                <th>Profile Image</th>
                <th>Name</th>
                <th>Village Names</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($users->where('role_id',5)  as $key => $crp)
            <tr>
                {{-- <td>{{$key+1}}</td> --}}
                <td>
                    @if($crp->image)
                    <img src="{{asset($crp->image)}}" height="100" width="100" alt="">
                    @endif
                </td>
                <td>{{$crp->name}}</td>
                <td>{{App\Helpers\Helpers::getUserVillages($crp->id)}}</td>
                <td>{{$crp->email}}</td>
                <td>{{$crp->phone}}</td>
                <td>
                    @if($crp->is_active)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">Pending</span>
                    @endif
                </td>
                <td>
                    <a href="{{route('project.user.show',$crp->id)}}" class="btn btn-primary btn-sm">Update</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table> 

</div>