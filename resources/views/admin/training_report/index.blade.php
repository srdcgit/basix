@extends('admin.layout.index')

@section('title')
    Training Report
@endsection

@section('content')

<div class="card">
    
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Training Report</h5>
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
                    <th>#</th>
                    <th>Name</th>
                    <th>Objective</th>
                    <th>Type of Participants</th>
                    <th>Total Participants</th>
                    <th>Total Mens</th>
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
                        <a href="{{route('admin.training_report.show',$training_report->id)}}" class="btn btn-primary btn-sm">Show</a>
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