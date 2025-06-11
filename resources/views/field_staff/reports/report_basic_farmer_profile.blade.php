@extends('field_staff.layout.index')
@section('title')
   Basic Farmer Profile Report
@endsection

@section('content')


<div class="row">
    <div class="col-md-12"> 
        <div class="card">
            
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Report on Basic Farmer Profile - District</h5>
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
                            <th rowspan="2" class="text-center">Name of Block</th>
                            <th rowspan="2" class="text-center">Name of Panchayat</th>
                            <th colspan="3" class="text-center">Numbers of Fishery Farmers</th>
                            <th rowspan="2" class="text-center">Total Water Bodies (in Kani)</th>
                            <th rowspan="2" class="text-center">Average Annual income (INR)</th>
                            <th rowspan="2" class="text-center">Average  Annual  Income from Fishery (INR)</th>
                        </tr>
                        <tr>
                            <th class="text-center">Grow-out</th>
                            <th class="text-center">Nursery</th>
                            <th class="text-center">Both</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gramPanchyats  as $key => $gramPanchyat)
                        @php 
                        $reportDetail = Auth::user()->getFisheringFarmer($gramPanchyat->id,$crpUserIds);
                        @endphp
                        <tr>
                            <td class="text-center">{{$gramPanchyat->block ? $gramPanchyat->block->name : ''}}</td>
                            <td class="text-center">{{$gramPanchyat->name}}</td>
                            <td class="text-center">{{$reportDetail['growerFarmers']}}</td>
                            <td class="text-center">{{$reportDetail['nurseryFarmers']}}</td>
                            <td class="text-center">{{$reportDetail['bothFarmers']}}</td>
                            <td class="text-center">{{$reportDetail['totalWaterBody']}}</td>
                            <td class="text-center">{{$reportDetail['total_annual_income']}}</td>
                            <td class="text-center">{{$reportDetail['total_annual_income_from_fishery']}}</td>
        
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