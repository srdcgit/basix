@extends('field_staff.layout.index')

@section('title')
    Edit Monthly Farming Report
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Edit Monthly Farming Report</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('field_staff.monthly_farming_report.update',$monthly_farming_report->id)}}" method="post" enctype="multipart/form-data" >
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            @if($monthly_farming_report->is_validate)
                            <a href="{{route('field_staff.monthly_farming_report.un_validate',$monthly_farming_report->id)}}" class="btn btn-sm btn-danger float-right">Un-validate</a>
                            @else 
                            <a href="{{route('field_staff.monthly_farming_report.validate',$monthly_farming_report->id)}}" class="btn btn-sm btn-success float-right">Validate</a>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Choose Farmer</label>
                            <select  name="respondent_master_id" id="respondent_master_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Farmer</option>
                                @foreach(App\Models\RespondentMaster::all() as $respondent_master)
                                @if($respondent_master->farming_profile->count() > 0)
                                <option @if($monthly_farming_report->respondent_master_id == $respondent_master->id) selected @endif value="{{$respondent_master->id}}">{{$respondent_master->name}} ({{$respondent_master->farmer_id}})</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Choose Month</label>
                            <select  name="month" id="month"  class="form-control select-search" data-fouc required>
                                <option selected value="{{$monthly_farming_report->month}}">{{$monthly_farming_report->month}}</option>
                                <option>Select Month</option>
                                @foreach($available_months as $month)
                                <option value="{{$month}}">{{$month}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>GeoLocation</label>
                            <input type="text" class="form-control" value="{{$monthly_farming_report->location}}" name="location" id="location" readonly>
                            <input type="hidden" class="form-control" value="{{$monthly_farming_report->lat}}" name="lat" id="lat" readonly>
                            <input type="hidden" class="form-control" value="{{$monthly_farming_report->long}}" name="long" id="long" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Date And Time Of Update</label>
                            <input type="datetime-local" class="form-control" name="date_of_update" value="{{$monthly_farming_report->date_of_update}}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Is FYK Applied ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="is_fyk_applied" @if($monthly_farming_report->is_fyk_applied) checked @endif  required value="1" class=""> Yes 
                                <input type="radio" name="is_fyk_applied" @if(!$monthly_farming_report->is_fyk_applied) checked @endif  required value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4 is_fyk_field" @if(!$monthly_farming_report->is_fyk_applied) hidden @endif>
                            <label>FYK expenditure</label>
                            <input type="number" step="0.01" name="fyk_expenditure" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Is Pond Preparation ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" @if($monthly_farming_report->is_pond_preparation) checked @endif name="is_pond_preparation" required value="1" class=""> Yes 
                                <input type="radio" @if(!$monthly_farming_report->is_pond_preparation) checked @endif name="is_pond_preparation" required value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4 is_pond_preparation_field" @if(!$monthly_farming_report->is_pond_preparation) hidden @endif >
                            <label>Boundary cleaning and repairing expenditure</label>
                            <input type="number" step="0.01" name="boundary_cleaning_expenditure" value="{{@$monthly_farming_report->boundary_cleaning_expenditure}}" class="form-control">
                        </div>
                        <div class="form-group col-md-4 is_pond_preparation_field" @if(!$monthly_farming_report->is_pond_preparation) hidden @endif >
                            <label>Fym application expenditure </label>
                            <input type="number" step="0.01" name="fym_application_expenditure" value="{{@$monthly_farming_report->fym_application_expenditure}}" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Stocking?</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="is_stocking" @if($monthly_farming_report->is_stocking) checked @endif required value="1" class=""> Yes 
                                <input type="radio" name="is_stocking" @if(!$monthly_farming_report->is_stocking) checked @endif required value="0" class=""> No 
                            </div>
                        </div>
                    </div>
                    <div class="row is_stocking_field"  @if(!$monthly_farming_report->is_stocking) hidden @endif>
                        <p><strong>Numbers Of Stock Fry</strong></p>
                    </div>
                    <div class="row is_stocking_field" @if(!$monthly_farming_report->is_stocking) hidden @endif>
                        <div class="form-group col-md-4">
                            <label>Catla</label>
                            <input type="number" step="0.01" value="{{$monthly_farming_report->catia_fry}}" name="catia_fry" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Rahu</label>
                            <input type="number" step="0.01" value="{{$monthly_farming_report->rahu_fry}}" name="rahu_fry" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Mirgal</label>
                            <input type="number" step="0.01" value="{{$monthly_farming_report->mirgal_fry}}" name="mirgal_fry" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Common Carp</label>
                            <input type="number" step="0.01" value="{{$monthly_farming_report->common_carp_fry}}" name="common_carp_fry" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Other</label>
                            <input type="number" step="0.01" name="other_fry" value="{{$monthly_farming_report->other_fry}}"  class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Acclimatisation (HR)</label>
                            <input type="text" name="hr_fry" value="{{$monthly_farming_report->hr_fry}}" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row is_stocking_field"  @if(!$monthly_farming_report->is_stocking) hidden @endif>
                        <p><strong>Expenditure on Fry/Figerling</strong></p>
                    </div>
                    <div class="row is_stocking_field"  @if(!$monthly_farming_report->is_stocking) hidden @endif>
                        <div class="form-group col-md-4">
                            <label>Quantity (in Kg)</label>
                            <input type="number" step="0.01" name="fry_quantity" value="{{$monthly_farming_report->fry_quantity}}" id="fry_quantity" class="form-control">
                        </div>
                        <div class="form-group col-md-4"  >
                            <label>Rate (Rs/Kg)</label>
                            <input type="number" step="0.01" name="fry_rate" id="fry_rate"  value="{{$monthly_farming_report->fry_rate}}"  class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Amount (in Rs) </label>
                            <input type="text" readonly name="fry_amount" id="fry_amount"  value="{{$monthly_farming_report->fry_amount}}"  class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Hydrological parameter Tested ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="is_hydrological" @if($monthly_farming_report->is_hydrological) checked @endif required value="1" class=""> Yes 
                                <input type="radio" name="is_hydrological" @if(!$monthly_farming_report->is_hydrological) checked @endif required value="0" class=""> No 
                            </div>
                        </div>
                    </div>
                    <div class="row is_hydrological_field"  @if(!$monthly_farming_report->is_hydrological) hidden @endif>
                        <div class="form-group col-md-4">
                            <label>Temp</label>
                            <input type="number" step="0.01" name="temp" value="{{$monthly_farming_report->temp}}" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>PH</label>
                            <input type="number" step="0.01" name="ph"  value="{{$monthly_farming_report->ph}}" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>DO</label>
                            <input type="number" step="0.01" name="do" value="{{$monthly_farming_report->do}}" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Transperency (S. Disc)</label>
                            <input type="number" step="0.01" name="transperency" value="{{$monthly_farming_report->transperency}}" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Water Depth (In Ft)</label>
                            <input type="number" step="0.01" name="water_depth" value="{{$monthly_farming_report->water_depth}}" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Providing Feed in Last Month ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" @if($monthly_farming_report->is_providing_feed) checked @endif name="is_providing_feed" required value="1" class=""> Yes 
                                <input type="radio" @if(!$monthly_farming_report->is_providing_feed) checked @endif name="is_providing_feed" required value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-6 is_providing_feed_field" @if(!$monthly_farming_report->is_providing_feed) hidden @endif>
                            <label>Providing Feed in Last Month ? </label>
                            <select  name="number_of_feed" class="form-control select-search "  data-fouc required>
                                <option disabled>Select Farmer</option>
                                <option @if($monthly_farming_report->number_of_feed == 1) selected @endif value="1">1</option>
                                <option @if($monthly_farming_report->number_of_feed == 2) selected @endif value="2">2</option>
                                <option @if($monthly_farming_report->number_of_feed == 3) selected @endif value="3">3</option>
                                <option @if($monthly_farming_report->number_of_feed == 4) selected @endif value="4">4</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row is_providing_feed_field" @if(!$monthly_farming_report->is_providing_feed) hidden @endif>
                        <p><strong>MOC/ Mash Feed</strong></p>
                    </div>
                    <div class="row is_providing_feed_field" @if(!$monthly_farming_report->is_providing_feed) hidden @endif>
                        <div class="form-group col-md-4 ">
                            <label>Quantity (in Kg) </label>
                            <input type="number" step="0.01" name="mash_feed_quantity" value="{{$monthly_farming_report->mash_feed_quantity}}" id="mash_feed_quantity" class="form-control">
                        </div>
                        <div class="form-group col-md-4 ">
                            <label>Rate (Rs/Kg) </label>
                            <input type="number" step="0.01" name="mash_feed_rate" value="{{$monthly_farming_report->mash_feed_rate}}" id="mash_feed_rate" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Amount (in Rs) </label>
                            <input type="text" readonly name="mash_feed_amount" value="{{$monthly_farming_report->mash_feed_amount}}" id="mash_feed_amount" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row is_providing_feed_field" @if(!$monthly_farming_report->is_providing_feed) hidden @endif>
                        <p><strong>Commercial Feed (Sinking/Floating)</strong></p>
                    </div>
                    <div class="row is_providing_feed_field" @if(!$monthly_farming_report->is_providing_feed) hidden @endif>
                        <div class="form-group col-md-4 ">
                            <label>Quantity (in Kg) </label>
                            <input type="number" step="0.01" name="commerical_feed_quantity" value="{{$monthly_farming_report->commerical_feed_quantity}}"  id="commerical_feed_quantity" class="form-control">
                        </div>
                        <div class="form-group col-md-4 ">
                            <label>Rate (Rs/Kg) </label>
                            <input type="number" step="0.01" name="commerical_feed_rate" value="{{$monthly_farming_report->commerical_feed_rate}}"  id="commerical_feed_rate" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Amount (in Rs) </label>
                            <input type="text" readonly name="commerical_feed_amount" value="{{$monthly_farming_report->commerical_feed_amount}}" id="commerical_feed_amount" class="form-control">
                        </div>
                    </div>
                    <div class="row is_providing_feed_field" @if(!$monthly_farming_report->is_providing_feed) hidden @endif>
                        <p><strong>Mineral / Vitamin</strong> </p>
                    </div>
                    <div class="row is_providing_feed_field" @if(!$monthly_farming_report->is_providing_feed) hidden @endif>
                        <div class="form-group col-md-4 ">
                            <label>Quantity (in Kg) </label>
                            <input type="number" step="0.01" name="mineral_quantity" value="{{$monthly_farming_report->mineral_quantity}}"  id="mineral_quantity" class="form-control">
                        </div>
                        <div class="form-group col-md-4 ">
                            <label>Rate (Rs/Kg) </label>
                            <input type="number" step="0.01" name="mineral_rate" value="{{$monthly_farming_report->mineral_rate}}"  id="mineral_rate" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Amount (in Rs) </label>
                            <input type="text" readonly name="mineral_amount" value="{{$monthly_farming_report->mineral_amount}}" id="mineral_amount" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Have you applied lime in last month ?</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="is_lime_applied" @if($monthly_farming_report->is_lime_applied) checked @endif required value="1" class=""> Yes 
                                <input type="radio" name="is_lime_applied" @if(!$monthly_farming_report->is_lime_applied) checked @endif required value="0" class=""> No 
                            </div>
                        </div>
                    </div>
                    <div class="row is_lime_applied_field"  @if(!$monthly_farming_report->is_lime_applied) hidden @endif>
                        <div class="form-group col-md-4 ">
                            <label>Quantity (in Kg) </label>
                            <input type="number" step="0.01" name="lime_quantity" value="{{$monthly_farming_report->lime_quantity}}" id="lime_quantity" class="form-control">
                        </div>
                        <div class="form-group col-md-4 ">
                            <label>Rate (Rs/Kg) </label>
                            <input type="number" step="0.01" name="lime_rate" value="{{$monthly_farming_report->lime_rate}}" id="lime_rate" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Amount (in Rs) </label>
                            <input type="text" readonly name="lime_amount" value="{{$monthly_farming_report->lime_amount}}" id="lime_amount" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Have you done Netting in last Month ?</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="is_netting" @if($monthly_farming_report->is_netting) checked @endif required value="1" class=""> Yes 
                                <input type="radio" name="is_netting" @if(!$monthly_farming_report->is_netting) checked @endif required value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4 is_netting_field" @if(!$monthly_farming_report->is_netting) hidden @endif>
                            <label>C </label>
                            <input type="number" step="0.01" name="c" value="{{$monthly_farming_report->c}}" class="form-control">
                        </div>
                        <div class="form-group col-md-4 is_netting_field"  @if(!$monthly_farming_report->is_netting) hidden @endif>
                            <label>R </label>
                            <input type="number" step="0.01" name="r" value="{{$monthly_farming_report->r}}"  class="form-control">
                        </div>
                        <div class="form-group col-md-4 is_netting_field"  @if(!$monthly_farming_report->is_netting) hidden @endif>
                            <label>M </label>
                            <input type="number" step="0.01" name="m" value="{{$monthly_farming_report->m}}"  class="form-control">
                        </div>
                        <div class="form-group col-md-4 is_netting_field"  @if(!$monthly_farming_report->is_netting) hidden @endif>
                            <label>CC </label>
                            <input type="number" step="0.01" name="cc" value="{{$monthly_farming_report->cc}}"  class="form-control">
                        </div>
                        <div class="form-group col-md-4 is_netting_field"  @if(!$monthly_farming_report->is_netting) hidden @endif>
                            <label>O </label>
                            <input type="number" step="0.01" name="o" value="{{$monthly_farming_report->o}}"  class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Have you done KMNO4 Bath ?</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="is_bath"  @if($monthly_farming_report->is_bath) checked @endif required value="1" class=""> Yes 
                                <input type="radio" name="is_bath"  @if(!$monthly_farming_report->is_bath) checked @endif required value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Disease Indentified ?</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="is_disease_indentified" @if($monthly_farming_report->is_disease_indentified) checked @endif  required value="1" class=""> Yes 
                                <input type="radio" name="is_disease_indentified" @if(!$monthly_farming_report->is_disease_indentified) checked @endif  required value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4 is_disease_indentified_field" @if(!$monthly_farming_report->is_disease_indentified) hidden @endif>
                            <label>Specify Disease</label>
                            <select  name="disease" class="form-control select-search "  data-fouc required>
                                <option disabled>Select Farmer</option>
                                <option @if($monthly_farming_report->disease == 'FN') checked @endif value="FN">FN</option>
                                <option @if($monthly_farming_report->disease == 'TR') checked @endif value="TR">TR</option>
                                <option @if($monthly_farming_report->disease == 'DR') checked @endif value="DR">DR</option>
                                <option @if($monthly_farming_report->disease == 'WP') checked @endif value="WP">WP</option>
                                <option @if($monthly_farming_report->disease == 'FL') checked @endif value="FL">FL</option>
                                <option @if($monthly_farming_report->disease == 'GF') checked @endif value="GF">GF</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 is_disease_indentified_field" @if(!$monthly_farming_report->is_disease_indentified) hidden @endif>
                            <label>Action for Disease </label>
                            <input type="text" name="action_for_disease" value="{{$monthly_farming_report->action_for_disease}}" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Netting Expenditure </label>
                            <input type="number" step="0.01" name="netting_expenditure" value="{{$monthly_farming_report->netting_expenditure}}" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4 ">
                            <label>Fish Solde Quantity (in Kg) </label>
                            <input type="number" step="0.01" name="fish_quantity" value="{{$monthly_farming_report->fish_quantity}}" id="fish_quantity" class="form-control">
                        </div>
                        <div class="form-group col-md-4 ">
                            <label>Fish Solde Rate (Rs/Kg) </label>
                            <input type="number" step="0.01" name="fish_rate" id="fish_rate" value="{{$monthly_farming_report->fish_rate}}" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Fish Solde Amount (in Rs) </label>
                            <input type="text" readonly name="fish_amount" id="fish_amount" value="{{$monthly_farming_report->fish_amount}}" class="form-control">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Update <i class="icon-paperplane ml-2"></i></button>
                    </div>
                    
                </form>
            </div>
        </div>
        <!-- /basic layout -->

    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        // navigator.geolocation.getCurrentPosition(showPosition);
        
        // function showPosition(position) {
        //     $('#lat').val(position.coords.latitude);
        //     $('#long').val(position.coords.longitude);
        //     $('#location').val(position.coords.latitude+','+position.coords.longitude);
        // }
        $('input[type=radio][name="is_stocking"]').on('change', function(event) {
            var value=$(this).val()
            if (value==1) {
                $('.is_stocking_field').attr('hidden',false);
            }else{
                $('.is_stocking_field').attr('hidden',true);
            }
        });
        $('input[type=radio][name="is_hydrological"]').on('change', function(event) {
            var value=$(this).val()
            if (value==1) {
                $('.is_hydrological_field').attr('hidden',false);
            }else{
                $('.is_hydrological_field').attr('hidden',true);
            }
        });
        $('input[type=radio][name="is_providing_feed"]').on('change', function(event) {
            var value=$(this).val()
            if (value==1) {
                $('.is_providing_feed_field').attr('hidden',false);
            }else{
                $('.is_providing_feed_field').attr('hidden',true);
            }
        });
        $('input[type=radio][name="is_lime_applied"]').on('change', function(event) {
            var value=$(this).val()
            if (value==1) {
                $('.is_lime_applied_field').attr('hidden',false);
            }else{
                $('.is_lime_applied_field').attr('hidden',true);
            }
        });
        $('input[type=radio][name="is_netting"]').on('change', function(event) {
            var value=$(this).val()
            if (value==1) {
                $('.is_netting_field').attr('hidden',false);
            }else{
                $('.is_netting_field').attr('hidden',true);
            }
        });
        $('input[type=radio][name="is_pond_preparation"]').on('change', function(event) {
            var value=$(this).val()
            if (value==1) {
                $('.is_pond_preparation_field').attr('hidden',false);
            }else{
                $('.is_pond_preparation_field').attr('hidden',true);
            }
        });
        $('input[type=radio][name="is_fyk_applied"]').on('change', function(event) {
            var value=$(this).val()
            if (value==1) {
                $('.is_fyk_field').attr('hidden',false);
            }else{
                $('.is_fyk_field').attr('hidden',true);
            }
        });
        $('input[type=radio][name="is_disease_indentified"]').on('change', function(event) {
            var value=$(this).val()
            if (value==1) {
                $('.is_disease_indentified_field').attr('hidden',false);
            }else{
                $('.is_disease_indentified_field').attr('hidden',true);
            }
        });
        $('#fry_quantity').change(function(){
            qty = parseFloat(this.value);
            rate =  parseFloat($('#fry_rate').val());
            total_amount = qty * rate;
            $('#fry_amount').val(total_amount.toFixed(2));
        });
        $('#fry_rate').change(function(){
            rate = parseFloat(this.value);
            qty =  parseFloat($('#fry_quantity').val());
            total_amount = qty * rate;
            $('#fry_amount').val(total_amount.toFixed(2));
        });
        $('#mash_feed_quantity').change(function(){
            qty = parseFloat(this.value);
            rate =  parseFloat($('#mash_feed_rate').val());
            total_amount = qty * rate;
            $('#mash_feed_amount').val(total_amount.toFixed(2));
        });
        $('#mash_feed_rate').change(function(){
            rate = parseFloat(this.value);
            qty =  parseFloat($('#mash_feed_quantity').val());
            total_amount = qty * rate;
            $('#mash_feed_amount').val(total_amount.toFixed(2));
        });
        $('#commerical_feed_quantity').change(function(){
            qty = parseFloat(this.value);
            rate =  parseFloat($('#commerical_feed_rate').val());
            total_amount = qty * rate;
            $('#commerical_feed_amount').val(total_amount.toFixed(2));
        });
        $('#commerical_feed_rate').change(function(){
            rate = parseFloat(this.value);
            qty =  parseFloat($('#commerical_feed_quantity').val());
            total_amount = qty * rate;
            $('#commerical_feed_amount').val(total_amount.toFixed(2));
        });
        $('#mineral_quantity').change(function(){
            qty = parseFloat(this.value);
            rate =  parseFloat($('#mineral_rate').val());
            total_amount = qty * rate;
            $('#mineral_amount').val(total_amount.toFixed(2));
        });
        $('#mineral_rate').change(function(){
            rate = parseFloat(this.value);
            qty =  parseFloat($('#mineral_quantity').val());
            total_amount = qty * rate;
            $('#mineral_amount').val(total_amount.toFixed(2));
        });
        $('#fish_quantity').change(function(){
            qty = parseFloat(this.value);
            rate =  parseFloat($('#fish_rate').val());
            total_amount = qty * rate;
            $('#fish_amount').val(total_amount.toFixed(2));
        });
        $('#fish_rate').change(function(){
            rate = parseFloat(this.value);
            qty =  parseFloat($('#fish_quantity').val());
            total_amount = qty * rate;
            $('#fish_amount').val(total_amount.toFixed(2));
        });
        $('#lime_quantity').change(function(){
            qty = parseFloat(this.value);
            rate =  parseFloat($('#lime_rate').val());
            total_amount = qty * rate;
            $('#lime_amount').val(total_amount.toFixed(2));
        });
        $('#lime_rate').change(function(){
            rate = parseFloat(this.value);
            qty =  parseFloat($('#lime_quantity').val());
            total_amount = qty * rate;
            $('#lime_amount').val(total_amount.toFixed(2));
        });
        $('#respondent_master_id').change(function(){
            let master_id = $(this).val();
            $.ajax({
                url: "{{route('field_staff.monthly_farming_report.getMonths')}}",
                method: 'post',
                data: {
                    master_id: master_id,
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(response){
                    available_months = response.available_months;
                    $('#month').empty();
                    $('#month').append('<option disabled>Select Months</option>');
                    for (i=0;i<available_months.length;i++){
                        $('#month').append('<option value="'+available_months[i]+'">'+available_months[i]+'</option>');
                    }
                }
            });
        });
    });
</script>
@endsection