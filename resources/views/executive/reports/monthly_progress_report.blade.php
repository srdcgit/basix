@extends('executive.layout.index')
@section('title')
    Monthly Progress Report
@endsection

@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card">
            
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Summary of Block Monthly Progress Report (Year {{App\Helpers\Helpers::yearRange()}}) </h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table ">
                    <thead>
                        <tr>
                            <th class="text-center">Month</th>
                            <th class="text-center">Number of registered under Fishery Project</th>
                            <th class="text-center">Numbers of famers monthly report submitted</th>
                            <th class="text-center">Percentage of farmers cleaning pound in the month</th>
                            <th class="text-center">Percentage of farmer applying lime in the month</th>
                            <th class="text-center">Percentage of farmer testing water quality in the month</th>
                            <th class="text-center">Percentage of farmers applying feed in the month</th>
                            <th class="text-center">Average total expenditure by the farmer on fishery activity in the month</th>
                            <th class="text-center">Average income of fishery farmer from Fishery activity in the Month</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (App\Helpers\Helpers::getCurrentYear()  as $key => $month)
                        
                        @php 
                        $monthylReports = Auth::user()->getFarmingDetailByMonth($month,$crpUserIds);
                        @endphp
                        <tr>
                            <td class="text-center">{{$month}}</td>
                            <td class="text-center">0</td>
                            <td class="text-center">0</td>
                            <td class="text-center">0</td>
                            <td class="text-center">0</td>
                            <td class="text-center">0</td>
                            <td class="text-center">0</td>
                            <td class="text-center">0</td>
                            <td class="text-center">0</td>
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
