@extends('field_staff.layout.index')

@section('title')
    Manage Training Report
@endsection

@section('content')

<div class="card">
    
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Manage Training Report</h5>
        <div class="header-elements">
            <div class="list-icons">
                {{-- <a href="{{route('field_staff.training_report.create')}}" class="btn btn-primary text-right">Add New Training Report</a> --}}
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
                        <th>Name</th>
                        <th>Objective</th>
                        <th>Type of Participants</th>
                        <th>Total Participants</th>
                        <th>Total Mens</th>
                        <th>Total Females</th>
                        <th>Is Validate</th>
                        <th>Action</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trainingReports  as $key => $training_report)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$training_report->name}}</td>
                        <td>{{$training_report->objective}}</td>
                        <td>{{$training_report->type_of_participants}}</td>
                        <td>{{$training_report->number_of_participants}}</td>
                        <td>{{$training_report->number_of_male}}</td>
                        <td>{{$training_report->number_of_female}}</td>
                        <td>
                            @if($training_report->is_validate)
                            <span class="badge badge-success">Yes</span>
                            @else 
                            <span class="badge badge-danger">No</span>
                            @endif
                        </td>
                        <td>
                            @if($training_report->is_validate)
                            <a href="{{route('field_staff.training_report.un_validate',$training_report->id)}}" class="btn btn-sm btn-danger">Un-validate</a>
                            @else 
                            <a href="{{route('field_staff.training_report.validate',$training_report->id)}}" class="btn btn-sm btn-success">Validate</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('field_staff.training_report.edit',$training_report->id)}}" class="btn btn-primary btn-sm">View</a>
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