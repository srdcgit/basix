@extends('admin.layout.index')

@section('title')
Manage Gram Panchyats
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Add New Gram Panchyat</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('admin.gram_panchyat.store')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Gram Panchyat Name</label>
                            <input name="name" type="text" class="form-control" placeholder="Enter Gram Panchyat Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Block</label>
                            <select  name="block_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Block</option>
                                @foreach(App\Models\Block::all() as $block)
                                <option value="{{$block->id}}">{{$block->name}}</option>
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
                <th>Name</th>
                <th>Block Name</th>
                <th>Total Executive</th>
                <th>Total Field Staff</th>
                <th>Total Crp</th>
                <th>Action</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach (App\Models\GramPanchyat::all()  as $key => $gram_panchyat)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$gram_panchyat->name}}</td>
                <td>{{@$gram_panchyat->block->name}}</td>
                <td>{{$gram_panchyat->getUserCount('3')}}</td>
                <td>{{$gram_panchyat->getUserCount('4')}}</td>
                <td>{{$gram_panchyat->getUserCount('5')}}</td>
                <td>
                    <button data-toggle="modal" data-target="#edit_modal" name="{{$gram_panchyat->name}}" 
                        block_id="{{$gram_panchyat->block_id}}" id="{{$gram_panchyat->id}}" class="edit-btn btn btn-primary">Edit</button>
                </td>
                <td>
                    <form action="{{route('admin.gram_panchyat.destroy',$gram_panchyat->id)}}" method="POST">
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
                    <h5 class="modal-title mt-0" id="myModalLabel">Update Gram Panchyat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Gram Panchyat Name</label>
                        <input class="form-control" type="text" id="name" name="name" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <label>Choose Block</label>
                        <select  name="block_id" id="block_id" class="form-control select-search" data-fouc required>
                            <option selected disabled>Select Block</option>
                            @foreach(App\Models\Block::all() as $block)
                            <option value="{{$block->id}}">{{$block->name}}</option>
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
            let name = $(this).attr('name');
            let id = $(this).attr('id');
            let block_id = $(this).attr('block_id');
            $('#block_id').val(block_id);
            $('#name').val(name);
            $('#id').val(id);
            $('#updateForm').attr('action','{{route('admin.gram_panchyat.update','')}}' +'/'+id);
        });
    });
</script>
@endsection