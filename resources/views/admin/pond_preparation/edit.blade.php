@extends('admin.layout.index')

@section('title')
    Edit Pond Preparation
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Edit Pond Preparation</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('admin.pond_preparation.update',$pond_preparation->id)}}" method="post" enctype="multipart/form-data" >
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Choose Farmer</label>
                            <select  name="respondent_master_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Farmer</option>
                                @foreach(App\Models\RespondentMaster::all() as $respondent_master)
                                @if($respondent_master->farming_profile->count() > 0)
                                    <option @if($pond_preparation->respondent_master_id == $respondent_master->id) selected @endif value="{{$respondent_master->id}}">{{$respondent_master->name}} ({{$respondent_master->farmer_id}})</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>GeoLocation</label>
                            <input type="text" class="form-control" value="{{$pond_preparation->location}}" name="location" id="location" readonly>
                            <input type="hidden" class="form-control" value="{{$pond_preparation->lat}}" name="lat" id="lat" readonly>
                            <input type="hidden" class="form-control" value="{{$pond_preparation->long}}" name="long" id="long" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Date And Time Of Update</label>
                            <input type="datetime-local" class="form-control" name="date_of_update" value="{{$pond_preparation->date_of_update}}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Have you clean and repair pond boundary?</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="repair_pond_boundary" @if($pond_preparation->repair_pond_boundary) checked @endif required value="1" class=""> Yes 
                                <input type="radio" name="repair_pond_boundary" @if(!$pond_preparation->repair_pond_boundary) checked @endif required value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4 repair_pond_boundary_field"  @if(!$pond_preparation->repair_pond_boundary)  hidden @endif>
                            <label>Date of Cleaning and Repairing pond Boundary</label>
                            <input type="date" name="date_of_pond_boundary"  value="{{$pond_preparation->date_of_pond_boundary?Carbon\Carbon::parse($pond_preparation->date_of_pond_boundary)->format('Y-m-d'):''}}" class="form-control">
                        </div>
                        <div class="form-group col-md-4 repair_pond_boundary_field"   @if(!$pond_preparation->repair_pond_boundary)  hidden @endif>
                            <label>Expenditure of Cleaning and Repairing pond Boundary</label>
                            <input type="text" name="expenditure_of_pond_boundary" value="{{$pond_preparation->expenditure_of_pond_boundary}}" class="form-control">
                        </div>
                        <div class="form-group col-md-4 repair_pond_boundary_field"   @if(!$pond_preparation->repair_pond_boundary)  hidden @endif>
                            <label>Remarks for Observation of Cleaning and Repairing pond Boundary</label>
                            <select  name="observation_of_pond_boundary"  class="form-control select-search" data-fouc>
                                <option value="">Select Observation</option>
                                <option @if($pond_preparation->observation_of_pond_boundary == 'Excellent') selected @endif value="Excellent">Excellent</option>
                                <option @if($pond_preparation->observation_of_pond_boundary == 'Good') selected @endif value="Good">Good</option>
                                <option @if($pond_preparation->observation_of_pond_boundary == 'Average') selected @endif value="Average">Average</option>
                                <option @if($pond_preparation->observation_of_pond_boundary == 'Need to Clean') selected @endif value="Need to Clean">Need to Clean</option>
                                <option @if($pond_preparation->observation_of_pond_boundary == 'Repair it again') selected @endif value="Repair it again">Repair it again</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Have you remove black soil or mud??</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="remove_black_soil" @if($pond_preparation->remove_black_soil) checked @endif  required value="1" class=""> Yes 
                                <input type="radio" name="remove_black_soil" @if(!$pond_preparation->remove_black_soil) checked @endif required value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4 remove_black_soil_field" @if(!$pond_preparation->remove_black_soil) hidden @endif>
                            <label>Date of removal of black soil or mud</label>
                            <input type="date" name="date_black_soil" class="form-control" value="{{$pond_preparation->date_black_soil?Carbon\Carbon::parse($pond_preparation->date_black_soil)->format('Y-m-d'):''}}">
                        </div>
                        <div class="form-group col-md-4 remove_black_soil_field"  @if(!$pond_preparation->remove_black_soil) hidden @endif>
                            <label>Expenditure of removal of black soil or mud</label>
                            <input type="text" name="expenditure_black_soil" value="{{$pond_preparation->expenditure_black_soil}}" class="form-control">
                        </div>
                        <div class="form-group col-md-4 remove_black_soil_field"  @if(!$pond_preparation->remove_black_soil) hidden @endif>
                            <label>Remarks For Observation of removal of black soil or mud</label>
                            <select  name="observation_of_black_soil"  class="form-control select-search" data-fouc>
                                <option value="">Select Observation</option>
                                <option @if($pond_preparation->observation_of_black_soil == 'Excellent') selected @endif value="Excellent">Excellent</option>
                                <option @if($pond_preparation->observation_of_black_soil == 'Good') selected @endif value="Good">Good</option>
                                <option @if($pond_preparation->observation_of_black_soil == 'Average') selected @endif value="Average">Average</option>
                                <option @if($pond_preparation->observation_of_black_soil == 'Need to Clean') selected @endif value="Need to Clean">Need to Clean</option>
                                <option @if($pond_preparation->observation_of_black_soil == 'Repair it again') selected @endif value="Repair it again">Repair it again</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4" >
                            <label>Have you done sun drying ?</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="is_sun_drying" @if($pond_preparation->is_sun_drying) checked @endif required value="1" class=""> Yes 
                                <input type="radio" name="is_sun_drying" @if(!$pond_preparation->is_sun_drying) checked @endif required value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4 is_sun_drying_field" @if(!$pond_preparation->is_sun_drying) hidden @endif>
                            <label>From</label>
                            <input type="date" name="from_sun_drying"  value="{{$pond_preparation->from_sun_drying?Carbon\Carbon::parse($pond_preparation->from_sun_drying)->format('Y-m-d'):''}}" class="form-control">
                        </div>
                        <div class="form-group col-md-4 is_sun_drying_field"  @if(!$pond_preparation->is_sun_drying) hidden @endif>
                            <label>To</label>
                            <input type="date" name="to_sun_drying" class="form-control"  value="{{$pond_preparation->to_sun_drying?Carbon\Carbon::parse($pond_preparation->to_sun_drying)->format('Y-m-d'):''}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Have you done liming ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="is_done_liming" @if($pond_preparation->is_done_liming) checked @endif required value="1" class=""> Yes 
                                <input type="radio" name="is_done_liming" @if(!$pond_preparation->is_done_liming) checked @endif required value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-3 is_done_liming_field"  @if(!$pond_preparation->is_done_liming) hidden @endif>
                            <label>Quantity (in Kg) For Liming </label>
                            <input type="text" name="done_liming_quantity" value="{{$pond_preparation->done_liming_quantity}}" id="done_liming_quantity" class="form-control">
                        </div>
                        <div class="form-group col-md-3 is_done_liming_field"  @if(!$pond_preparation->is_done_liming) hidden @endif>
                            <label>Rate (Rs/Kg) For Liming </label>
                            <input type="text" name="done_liming_rate" value="{{$pond_preparation->done_liming_rate}}" id="done_liming_rate" class="form-control">
                        </div>
                        <div class="form-group col-md-3 is_done_liming_field"  @if(!$pond_preparation->is_done_liming) hidden @endif>
                            <label>Expenditure (in Rs) </label>
                            <input type="text" readonly name="done_liming_expenditure" value="{{$pond_preparation->done_liming_expenditure}}" id="done_liming_expenditure" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Have you apply cow dung  ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="is_cow_dung" @if($pond_preparation->is_cow_dung) checked @endif required value="1" class=""> Yes 
                                <input type="radio" name="is_cow_dung" @if(!$pond_preparation->is_cow_dung) checked @endif required value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-3 is_cow_dung_field" @if(!$pond_preparation->is_cow_dung) hidden @endif >
                            <label>Quantity (in Kg) For Cow Dung </label>
                            <input type="text" name="cow_dung_quantity" value="{{$pond_preparation->cow_dung_quantity}}" id="cow_dung_quantity" class="form-control">
                        </div>
                        <div class="form-group col-md-3 is_cow_dung_field" @if(!$pond_preparation->is_cow_dung) hidden @endif >
                            <label>Rate (Rs/Kg) For Cow Dung </label>
                            <input type="text" name="cow_dung_rate" value="{{$pond_preparation->cow_dung_rate}}" id="cow_dung_rate" class="form-control">
                        </div>
                        <div class="form-group col-md-3 is_cow_dung_field" @if(!$pond_preparation->is_cow_dung) hidden @endif >
                            <label>Expenditure (in Rs) For Cow Dung </label>
                            <input type="text" name="cow_dung_expenditure"  value="{{$pond_preparation->cow_dung_rate}}" id="cow_dung_expenditure" readonly class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Have you apply NPK ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="is_apply_npk"  @if($pond_preparation->is_apply_npk) checked @endif required value="1" class=""> Yes 
                                <input type="radio" name="is_apply_npk"  @if(!$pond_preparation->is_apply_npk) checked @endif required value="0" class=""> No 
                            </div>
                        </div>
                    </div>
                    <div class="row" id="is_apply_npk_fields"   @if(!$pond_preparation->is_apply_npk) hidden @endif>
                        <div class="form-group col-md-4 ">
                            <label>Quantity (in Kg) For Urea  </label>
                            <input type="text" name="urea_quantity" id="urea_quantity" value="{{$pond_preparation->urea_quantity}}" class="form-control">
                        </div>
                        <div class="form-group col-md-4 ">
                            <label>Rate (Rs/Kg) For Urea  </label>
                            <input type="text" name="urea_rate" id="urea_rate" value="{{$pond_preparation->urea_rate}}" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Expenditure (in Rs) For Urea  </label>
                            <input type="text" readonly name="urea_expenditure" value="{{$pond_preparation->urea_expenditure}}" id="urea_expenditure" class="form-control">
                        </div>
                        <div class="form-group col-md-4 ">
                            <label>Quantity (in Kg) For SSP  </label>
                            <input type="text" name="ssp_quantity" id="ssp_quantity" value="{{$pond_preparation->ssp_quantity}}" class="form-control">
                        </div>
                        <div class="form-group col-md-4 ">
                            <label>Rate (Rs/Kg) For SSP  </label>
                            <input type="text" name="ssp_rate" id="ssp_rate" value="{{$pond_preparation->ssp_rate}}" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Expenditure (in Rs) For SSP  </label>
                            <input type="text" readonly name="ssp_expenditure" value="{{$pond_preparation->ssp_expenditure}}" id="ssp_expenditure" class="form-control">
                        </div>
                        <div class="form-group col-md-4 ">
                            <label>Quantity (in Kg) For Potas  </label>
                            <input type="text" name="potas_quantity" value="{{$pond_preparation->potas_quantity}}" id="potas_quantity" class="form-control">
                        </div>
                        <div class="form-group col-md-4 ">
                            <label>Rate (Rs/Kg) For Potas  </label>
                            <input type="text" name="potas_rate"  value="{{$pond_preparation->potas_rate}}"id="potas_rate" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Expenditure (in Rs) For Potas  </label>
                            <input type="text" name="potas_expenditure" value="{{$pond_preparation->potas_expenditure}}" readonly id="potas_expenditure" class="form-control">
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
        $('input[type=radio][name="repair_pond_boundary"]').on('change', function(event) {
            var value=$(this).val();
            if (value==1) {
                $('.repair_pond_boundary_field').attr('hidden',false);
            }else{
                $('.repair_pond_boundary_field').attr('hidden',true);
            }
        });
        $('input[type=radio][name="remove_black_soil"]').on('change', function(event) {
            var value=$(this).val();
            if (value==1) {
                $('.remove_black_soil_field').attr('hidden',false);
            }else{
                $('.remove_black_soil_field').attr('hidden',true);
            }
        });
        $('input[type=radio][name="is_sun_drying"]').on('change', function(event) {
            var value=$(this).val()
            if (value==1) {
                $('.is_sun_drying_field').attr('hidden',false);
            }else{
                $('.is_sun_drying_field').attr('hidden',true);
            }
        });
        $('input[type=radio][name="is_done_liming"]').on('change', function(event) {
            var value=$(this).val()
            if (value==1) {
                $('.is_done_liming_field').attr('hidden',false);
            }else{
                $('.is_done_liming_field').attr('hidden',true);
            }
        });
        $('input[type=radio][name="is_cow_dung"]').on('change', function(event) {
            var value=$(this).val()
            if (value==1) {
                $('.is_cow_dung_field').attr('hidden',false);
            }else{
                $('.is_cow_dung_field').attr('hidden',true);
            }
        });
        $('input[type=radio][name="is_apply_npk"]').on('change', function(event) {
            var value=$(this).val()
            if (value==1) {
                $('#is_apply_npk_fields').attr('hidden',false);
            }else{
                $('#is_apply_npk_fields').attr('hidden',true);
            }
        });
        $('#done_liming_quantity').change(function(){
            qty = parseFloat(this.value);
            rate =  parseFloat($('#done_liming_rate').val());
            total_amount = qty * rate;
            $('#done_liming_expenditure').val(total_amount.toFixed(2));
        });
        $('#done_liming_rate').change(function(){
            rate = parseFloat(this.value);
            qty =  parseFloat($('#done_liming_quantity').val());
            total_amount = qty * rate;
            $('#done_liming_expenditure').val(total_amount.toFixed(2));
        });
        $('#cow_dung_quantity').change(function(){
            qty = parseFloat(this.value);
            rate =  parseFloat($('#cow_dung_rate').val());
            total_amount = qty * rate;
            $('#cow_dung_expenditure').val(total_amount.toFixed(2));
        });
        $('#cow_dung_rate').change(function(){
            rate = parseFloat(this.value);
            qty =  parseFloat($('#cow_dung_quantity').val());
            total_amount = qty * rate;
            $('#cow_dung_expenditure').val(total_amount.toFixed(2));
        });
        $('#urea_quantity').change(function(){
            qty = parseFloat(this.value);
            rate =  parseFloat($('#urea_rate').val());
            total_amount = qty * rate;
            $('#urea_expenditure').val(total_amount.toFixed(2));
        });
        $('#urea_rate').change(function(){
            rate = parseFloat(this.value);
            qty =  parseFloat($('#urea_quantity').val());
            total_amount = qty * rate;
            $('#urea_expenditure').val(total_amount.toFixed(2));
        });
        $('#ssp_quantity').change(function(){
            qty = parseFloat(this.value);
            rate =  parseFloat($('#ssp_rate').val());
            total_amount = qty * rate;
            $('#ssp_expenditure').val(total_amount.toFixed(2));
        });
        $('#ssp_rate').change(function(){
            rate = parseFloat(this.value);
            qty =  parseFloat($('#ssp_quantity').val());
            total_amount = qty * rate;
            $('#ssp_expenditure').val(total_amount.toFixed(2));
        });
        $('#potas_quantity').change(function(){
            qty = parseFloat(this.value);
            rate =  parseFloat($('#potas_rate').val());
            total_amount = qty * rate;
            $('#potas_expenditure').val(total_amount.toFixed(2));
        });
        $('#potas_rate').change(function(){
            rate = parseFloat(this.value);
            qty =  parseFloat($('#potas_quantity').val());
            total_amount = qty * rate;
            $('#potas_expenditure').val(total_amount.toFixed(2));
        });
    });
</script>
@endsection