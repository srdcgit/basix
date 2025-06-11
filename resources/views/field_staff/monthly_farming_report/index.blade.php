@extends('field_staff.layout.index')

@section('title')
    Manage Monthly Farming Report
@endsection

@section('content')

<div class="card">
    
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Manage Monthly Farming Report</h5>
        <div class="header-elements">
            <div class="list-icons">
                {{-- <a href="{{route('field_staff.monthly_farming_report.create')}}" class="btn btn-primary text-right">Add New Monthly Farming Report</a> --}}
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table datatable-save-state">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Month</th>
                        <th>Farmer Name</th>
                        <th>Date & Time Of Update</th>
                        <th>Location</th>
                        <th>Is Validate</th>
                        <th>Action</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($monthlyFarmingReports  as $key => $monthly_farming_report)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$monthly_farming_report->month}}</td>
                        <td>{{@$monthly_farming_report->respondent_master->name .'('.@$monthly_farming_report->respondent_master->farmer_id.')'}}</td>
                        <td>{{@$monthly_farming_report->date_of_update}}</td>
                        <td>{{@$monthly_farming_report->location}}</td>
                        <td>
                            @if($monthly_farming_report->is_validate)
                            <span class="badge badge-success">Yes</span>
                            @else 
                            <span class="badge badge-danger">No</span>
                            @endif
                        </td>
                        <td>
                            @if($monthly_farming_report->is_validate)
                            <a href="{{route('field_staff.monthly_farming_report.un_validate',$monthly_farming_report->id)}}" class="btn btn-sm btn-danger float-right">Un-validate</a>
                            @else 
                            <a href="{{route('field_staff.monthly_farming_report.validate',$monthly_farming_report->id)}}" class="btn btn-sm btn-success float-right">Validate</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('field_staff.monthly_farming_report.edit',$monthly_farming_report->id)}}" class="btn btn-primary btn-sm">View</a>
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