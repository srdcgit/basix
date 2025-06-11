@extends('project.layout.index')

@section('title')
    All Users
@endsection

@section('content')

<div class="card">
    
    <div class="card-header header-elements-inline">
        <h5 class="card-title">All Users</h5>
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
                <a href="{{route('project.user.create')}}" class="btn btn-primary float-right mb-2">Add New User</a>
            </div>
        </div>
        <ul class="nav nav-tabs nav-tabs-top">
            <li class="nav-item"><a href="#top-tab1"  class="nav-link active" data-toggle="tab">Executives</a></li>
            <li class="nav-item"><a href="#top-tab2"  class="nav-link" data-toggle="tab">Field Staffs</a></li>
            <li class="nav-item"><a href="#top-tab3"  class="nav-link" data-toggle="tab">CRP(s)</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="top-tab1">
                @include('project.user.partials.executive')
            </div>
            <div class="tab-pane fade" id="top-tab2">
                @include('project.user.partials.field_staff')
            </div>
            <div class="tab-pane fade" id="top-tab3">
                @include('project.user.partials.crp')
            </div>
        </div> 

    </div>
</div>
@endsection
@section('scripts')
@endsection
