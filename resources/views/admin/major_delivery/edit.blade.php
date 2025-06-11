@extends('admin.layout.index')

@section('title')
    Edit Major Delivery
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Edit Major Delivery</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('admin.major_delivery.update',$major_delivery->id)}}" method="post" enctype="multipart/form-data" >
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Choose Project</label>
                            <select  name="project_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Project</option>
                                @foreach(App\Models\Project::all() as $project)
                                <option @if($major_delivery->project_id == $project->id) selected @endif value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Deliverable</label>
                            <input type="text" value="{{$major_delivery->deliverable}}" name="deliverable" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Due Date</label>
                            <input type="date" name="date" value="{{$major_delivery->date?$major_delivery->date->format('Y-m-d'):''}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Edit <i class="icon-paperplane ml-2"></i></button>
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