@extends('project.layout.index')
@section('title')
    View Farming Profile
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Simple View Layout -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Farmer Name: <span style="color: red">{{ $farming_profile->respondent_master->name }}</span></h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <strong>Farmer ID:</strong> {{ $farming_profile->respondent_master->farmer_id }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>SHG Member:</strong>
                        @if ($farming_profile->shg_member)
                            Yes
                            <div>{{ $farming_profile->shg_member_name }}</div>
                        @else
                            No
                        @endif
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Fish PB Member:</strong>
                        @if ($farming_profile->fish_pb_member)
                            Yes
                            <div>{{ $farming_profile->fish_pb_member_name }}</div>
                        @else
                            No
                        @endif
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Head of HH:</strong> {{ $farming_profile->head_of_hh }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>HH BPL No:</strong> {{ $farming_profile->has_hh_bpl_no ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>HH MGNREGA Card:</strong> {{ $farming_profile->has_hh_mgnrega_card ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>HH Bank Account:</strong> {{ $farming_profile->has_hh_bank_account ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>HH KCC Account:</strong> {{ $farming_profile->has_hh_kcc_account ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Total Annual Income:</strong> {{ $farming_profile->total_annual_income }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Total Annual Income from Fishery:</strong> {{ $farming_profile->total_annual_income_from_fishery }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Involvement in Fishery:</strong> {{ $farming_profile->involvement_in_fishery }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Own Water Body:</strong> {{ $farming_profile->own_water_body }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Lease In Water Body:</strong> {{ $farming_profile->lease_in_water_body }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Lease Out Water Body:</strong> {{ $farming_profile->lease_out_water_body }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Total Water Body:</strong> {{ $farming_profile->total_water_body }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Have Pump Set:</strong> {{ $farming_profile->have_pump_set ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Have Tube Well:</strong> {{ $farming_profile->have_tube_well ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Fishing Net:</strong> {{ $farming_profile->fishing_net ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Aereator:</strong> {{ $farming_profile->aereator ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Have Boundary Regularly:</strong> {{ $farming_profile->have_boundary_regularly ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Have Remove Black Soil:</strong> {{ $farming_profile->have_remove_black_soil ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Have Applied Lime:</strong> {{ $farming_profile->have_applied_lime ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Have Applied Cow Dung:</strong> {{ $farming_profile->have_apply_cow_dung ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Have Regularly Applied Lime:</strong> {{ $farming_profile->have_regularly_apply_lime ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Have Regularly Applied Cow Dung:</strong> {{ $farming_profile->have_regularly_apply_cow_dung ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Type of Feed Used:</strong> {{ $farming_profile->type_of_feed_used }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Done Feeding Regularly:</strong> {{ $farming_profile->done_feeding_regularly ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Have Water PH Regularly:</strong> {{ $farming_profile->have_water_ph_regularly ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Have Meeting Regularly:</strong> {{ $farming_profile->have_meeting_regularly ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Attend Training Programme:</strong> {{ $farming_profile->attend_training_programme ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <strong>Exposure to Good Practices:</strong> {{ $farming_profile->exposure_good_practics ? 'Yes' : 'No' }}
                    </div>
                    <div class="col-md-12 mb-3">
                        <strong>Image:</strong>
                        @if ($farming_profile->image)
                            <a href="{{ asset($farming_profile->image) }}" target="_blank">View Image</a>
                        @else
                            No image available
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
