@extends('project.layout.index')
@section('title')
    Monthly Training Report
@endsection

@section('content')


<div class="row">
    <div class="col-md-12">       
       <div class="card">
                    
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Summary Whole Project Training Report (Year {{App\Helpers\Helpers::yearRange()}}) </h5>
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
                            <th  class="text-center">Month</th>
                            <th  class="text-center">Number of training done in the Month</th>
                            <th  class="text-center">Number of farmer attended the training programme</th>     
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (App\Helpers\Helpers::getCurrentYear()  as $key => $month)
                        
                        @php 
                        $trainingReport = Auth::user()->getTrainingDetailByMonth($month,$crpUserIds);
                        @endphp
                        <tr>
                            <td class="text-center">{{$month}}</td>
                            <td class="text-center">{{$trainingReport['currentMonthTraingReport']}}</td>
                            <td class="text-center">{{$trainingReport['number_of_participants']}}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection