@extends('project.layout.index')
@section('title')
   View Monthly Farming Report
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Simple View Layout -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Monthly Farming Report: <span style="color: red">{{ $monthly_farming_report->respondent_master->name }}</span></h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <strong>Date of Update:</strong> {{ $monthly_farming_report->date_of_update }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Month:</strong> {{ $monthly_farming_report->month }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Location:</strong> {{ $monthly_farming_report->location }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Latitude:</strong> {{ $monthly_farming_report->lat }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Longitude:</strong> {{ $monthly_farming_report->long }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Stocking:</strong> {{ $monthly_farming_report->is_stocking ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Catia Fry:</strong> {{ $monthly_farming_report->catia_fry }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Rahu Fry:</strong> {{ $monthly_farming_report->rahu_fry }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Mirgal Fry:</strong> {{ $monthly_farming_report->mirgal_fry }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Common Carp Fry:</strong> {{ $monthly_farming_report->common_carp_fry }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Other Fry:</strong> {{ $monthly_farming_report->other_fry }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>HR Fry:</strong> {{ $monthly_farming_report->hr_fry }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Fry Quantity:</strong> {{ $monthly_farming_report->fry_quantity }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Fry Rate:</strong> {{ $monthly_farming_report->fry_rate }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Fry Amount:</strong> {{ $monthly_farming_report->fry_amount }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Hydrological Data:</strong> {{ $monthly_farming_report->is_hydrological ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Temperature:</strong> {{ $monthly_farming_report->temp }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>pH Level:</strong> {{ $monthly_farming_report->ph }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>DO Level:</strong> {{ $monthly_farming_report->do }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Transparency:</strong> {{ $monthly_farming_report->transperency }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Water Depth:</strong> {{ $monthly_farming_report->water_depth }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Providing Feed:</strong> {{ $monthly_farming_report->is_providing_feed ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Number of Feeds:</strong> {{ $monthly_farming_report->number_of_feed }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Mash Feed Quantity:</strong> {{ $monthly_farming_report->mash_feed_quantity }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Mash Feed Rate:</strong> {{ $monthly_farming_report->mash_feed_rate }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Mash Feed Amount:</strong> {{ $monthly_farming_report->mash_feed_amount }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Commercial Feed Quantity:</strong> {{ $monthly_farming_report->commerical_feed_quantity }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Commercial Feed Rate:</strong> {{ $monthly_farming_report->commerical_feed_rate }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Commercial Feed Amount:</strong> {{ $monthly_farming_report->commerical_feed_amount }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Mineral Quantity:</strong> {{ $monthly_farming_report->mineral_quantity }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Mineral Rate:</strong> {{ $monthly_farming_report->mineral_rate }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Mineral Amount:</strong> {{ $monthly_farming_report->mineral_amount }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Lime Applied:</strong> {{ $monthly_farming_report->is_lime_applied ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Lime Quantity:</strong> {{ $monthly_farming_report->lime_quantity }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Lime Rate:</strong> {{ $monthly_farming_report->lime_rate }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Lime Amount:</strong> {{ $monthly_farming_report->lime_amount }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Netting:</strong> {{ $monthly_farming_report->is_netting ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>C:</strong> {{ $monthly_farming_report->c }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>R:</strong> {{ $monthly_farming_report->r }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>M:</strong> {{ $monthly_farming_report->m }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>CC:</strong> {{ $monthly_farming_report->cc }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>O:</strong> {{ $monthly_farming_report->o }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Bath:</strong> {{ $monthly_farming_report->is_bath ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Disease:</strong> {{ $monthly_farming_report->disease }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Action for Disease:</strong> {{ $monthly_farming_report->action_for_disease }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Netting Expenditure:</strong> {{ $monthly_farming_report->netting_expenditure }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Fish Quantity:</strong> {{ $monthly_farming_report->fish_quantity }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Fish Rate:</strong> {{ $monthly_farming_report->fish_rate }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Fish Amount:</strong> {{ $monthly_farming_report->fish_amount }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
