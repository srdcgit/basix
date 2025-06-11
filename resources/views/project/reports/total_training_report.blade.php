@extends('project.layout.index')
@section('title')
Total Training Report
@endsection

@section('content')
<div class="card">
    
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Total Training Report</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table datatable-save-state">
            <thead>
                <tr>
                    <th>SL.No</th>
                    <th>Name</th>
                    <th>Objective</th>
                    <th>Type of Participants</th>
                    <th>Total Participants</th>
                    <th>Total Male</th>
                    <th>Total Females</th>
                    <th>Field Staff Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (App\Models\TrainingReport::all()  as $key => $training_report)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$training_report->name}}</td>
                    <td>{{$training_report->objective}}</td>
                    <td>{{$training_report->type_of_participants}}</td>
                    <td>{{$training_report->number_of_participants}}</td>
                    <td>{{$training_report->number_of_male}}</td>
                    <td>{{$training_report->number_of_female}}</td>
                    <td>{{@$training_report->user->name}}</td>
                    <td>
                        <a href="{{ route('project.report.total-training-view',$training_report->id) }}" class="btn btn-primary btn-sm">View</a>
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
