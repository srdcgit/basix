@extends('admin.layout.index')

@section('title')
    Add City
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Add New City</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('admin.city.store')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>City Name</label>
                            <input name="name" type="text" class="form-control" placeholder="Enter City Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>City Slug</label>
                            <input name="slug" type="text" class="form-control" placeholder="Enter City Slug" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>City Code</label>
                            <input name="code" type="text" class="form-control" placeholder="Enter City Code" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose State</label>
                            <select  name="state_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select State</option>
                                @foreach(App\Models\State::all() as $state)
                                <option value="{{$state->id}}">{{$state->name}}</option>
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

<div class="card">

    <table class="table datatable-save-state">
        <thead>
            <tr>
                <th>#</th>
                <th>City Name</th>
                <th>City State Name</th>
                <th>City Slug</th>
                <th>City Code</th>
                <th>Action</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach (App\Models\City::all()  as $key => $city)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$city->name}}</td>
                <td>{{$city->state->name}}</td>
                <td>{{$city->slug}}</td>
                <td>{{$city->code}}</td>
                <td>
                    <button data-toggle="modal" data-target="#edit_modal" name="{{$city->name}}" 
                        code="{{$city->code}}" slug="{{$city->slug}}" state_id="{{$city->state_id}}" id="{{$city->id}}" class="edit-btn btn btn-primary">Edit</button>
                </td>
                <td>
                    <form action="{{route('admin.city.destroy',$city->id)}}" method="POST">
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

<div id="edit_modal" class="modal fade">
    <div class="modal-dialog">
        <form id="updateForm" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Update City</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">City Name</label>
                        <input class="form-control" type="text" id="name" name="name" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">City Slug</label>
                        <input class="form-control" type="text" id="slug" name="slug" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">City Code</label>
                        <input class="form-control" type="text" id="code" name="code" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <label>Choose State</label>
                        <select  name="state_id" id="state_id" class="form-control select-search" data-fouc required>
                            <option selected disabled>Select State</option>
                            @foreach(App\Models\State::all() as $state)
                            <option value="{{$state->name}}">{{$state->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('.edit-btn').click(function(){
            let name = this.name;
            let state_id = this.state_id;
            let code = this.code;
            let slug = this.slug;
            let id = $(this).attr('id');
            $('#slug').val(slug);
            $('#code').val(code);
            $('#state_id').val(state_id);
            $('#name').val(name);
            $('#id').val(id);
            $('#updateForm').attr('action','{{route('admin.city.update','')}}' +'/'+id);
        });
    });
</script>
@endsection