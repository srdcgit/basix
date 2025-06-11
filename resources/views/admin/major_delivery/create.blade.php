@extends('admin.layout.index')

@section('title')
    Add New Major Delivery
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Add New Major Delivery</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('admin.major_delivery.store')}}" method="post" enctype="multipart/form-data" >
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
                        <div class="form-group col-md-6 text-right">
                            <button type="button" class="btn btn-primary" id="add-more-delivery">Add More Delivery</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Deliverable</label>
                            <input type="text" name="deliverable[]" class="form-control" >
                        </div>
                        <div class="form-group col-md-6">
                            <label>Due Date</label>
                            <input type="date" name="date[]" class="form-control" >
                        </div>
                    </div>
                    <div id="delivery_fields">
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
<div id="new_fields" style="display:none;">
    <div class="row">
        <div class="form-group col-md-6">
            <label>Deliverable</label>
            <input type="text" name="deliverable[]" class="form-control" >
        </div>
        <div class="form-group col-md-6">
            <label>Date</label>
            <input type="date" name="date[]" class="form-control" >
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('#add-more-delivery').click(function(){
            html = $('#new_fields').html();
            $('#delivery_fields').append(html);
        });
    });
</script>
@endsection