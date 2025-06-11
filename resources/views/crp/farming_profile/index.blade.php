@extends('crp.layout.index')

@section('title')
    Manage Farming Profile
@endsection

@section('content')

<div class="card">
    
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Manage Farming Profile</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a href="{{route('crp.farming_profile.create')}}" class="btn btn-primary text-right">Add New Farming Profile</a>
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table datatable-save-state">
            <thead>
                <tr>
                        <th>SL No</th>
                        <th>Farmer ID</th>
                        <th>Farmer Name</th>
                        <th>Date & Time of Update</th>
                    <th>Is Validate</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (Auth::user()->farmingProfiles  as $key => $farming_profile)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{@$farming_profile->respondent_master->farmer_id}}</td>
                    <td>{{@$farming_profile->respondent_master->name .'('.@$farming_profile->respondent_master->farmer_id.')'}}</td>
                    <td>{{@$farming_profile->updated_at}}</td>
                    <td>
                        @if($farming_profile->is_validate)
                        <span class="badge badge-success">Yes</span>
                        @else 
                        <span class="badge badge-danger">No</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('crp.farming_profile.edit',$farming_profile->id)}}" class="btn btn-primary btn-sm">{{$farming_profile->is_validate ? 'View' : 'Edit'}}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection

@section('scripts')
@endsection