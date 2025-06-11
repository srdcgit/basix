@extends('field_staff.layout.index')

@section('title')
    Edit Farming Profile
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Edit Farming Profile</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('field_staff.farming_profile.update',$farming_profile->id)}}" method="post" enctype="multipart/form-data" >
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-12 float-right">
                            @if($farming_profile->is_validate)
                            <a href="{{route('field_staff.farming_profile.un_validate',$farming_profile->id)}}" class="btn btn-sm btn-danger float-right">Un-validate</a>
                            @else 
                            <a href="{{route('field_staff.farming_profile.validate',$farming_profile->id)}}" class="btn btn-sm btn-success float-right">Validated</a>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Choose Farmer</label>
                            <select  name="respondent_master_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Farmer</option>
                                @foreach(App\Models\RespondentMaster::all() as $respondent_master)
                                <option @if($farming_profile->respondent_master_id == $respondent_master->id) selected @endif value="{{$respondent_master->id}}">{{$respondent_master->name}} ({{$respondent_master->farmer_id}})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Choose Project</label>
                            <select  name="project_id"  class="form-control select-search" data-fouc>
                                <option selected disabled>Select Project</option>
                                @foreach(App\Models\Project::all() as $project)
                                <option @if($farming_profile->project_id == $project->id) selected @endif value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>SHG Member</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" @if($farming_profile->shg_member) checked @endif name="shg_member" required value="1" class=""> Yes 
                                <input type="radio" @if(!$farming_profile->shg_member) checked @endif name="shg_member" required value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4" id="shg_member_name_field" @if(!$farming_profile->shg_member) hidden @endif>
                            <label>SHG Member Name</label>
                            <input type="text" name="shg_member_name" value="{{@$farming_profile->shg_member_name}}" class="form-control">
                        </div>
                        <div class="form-group col-md-4" >
                            <label>Fish PG Member</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="fish_pb_member"  @if($farming_profile->fish_pb_member) checked @endif required value="1" class=""> Yes 
                                <input type="radio" name="fish_pb_member"  @if(!$farming_profile->fish_pb_member) checked @endif required value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4" id="fish_pb_member_name_field" @if(!$farming_profile->fish_pb_member) hidden @endif>
                            <label>Fish PG Member Name</label>
                            <input type="text" name="fish_pb_member_name" value="{{$farming_profile->fish_pb_member_name}}" class="form-control">
                        </div>
                        <div class="form-group col-md-4" >
                            <label>Name of Head of HH</label>
                            <input type="text" name="head_of_hh" value="{{$farming_profile->head_of_hh}}" required placeholder="Name of Head of HH" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Does HH has BPL No ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="has_hh_bpl_no"  @if($farming_profile->has_hh_bpl_no) checked @endif required value="1" class=""> Yes 
                                <input type="radio" name="has_hh_bpl_no" @if(!$farming_profile->has_hh_bpl_no) checked @endif required value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Does HH has MGNREGA Card ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="has_hh_mgnrega_card" @if($farming_profile->has_hh_mgnrega_card) checked @endif  required value="1" class=""> Yes 
                                <input type="radio" name="has_hh_mgnrega_card" @if(!$farming_profile->has_hh_mgnrega_card) checked @endif  required value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Does HH has Bank Account ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="has_hh_bank_account" @if($farming_profile->has_hh_bank_account) checked @endif  required value="1" class=""> Yes 
                                <input type="radio" name="has_hh_bank_account" @if(!$farming_profile->has_hh_bank_account) checked @endif  required value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4" >
                            <label>Does HH has KCC Account ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="has_hh_kcc_account" @if($farming_profile->has_hh_kcc_account) checked @endif  required value="1" class=""> Yes 
                                <input type="radio" name="has_hh_kcc_account" @if(!$farming_profile->has_hh_kcc_account) checked @endif  required value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Total Annual Income (In Rs.)</label>
                            <input type="number" step="0.01" name="total_annual_income" value="{{$farming_profile->total_annual_income}}" required placeholder="Total Annual Income" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Total Annual Income from Fishery (In Rs.)</label>
                            <input type="number" step="0.01" name="total_annual_income_from_fishery" value="{{$farming_profile->total_annual_income_from_fishery}}" required placeholder="Total Annual Income from Fishery" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Involvement in Fishery as</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="involvement_in_fishery" @if($farming_profile->involvement_in_fishery == "Nursery Farmer") checked @endif  value="Nursery Farmer" class=""> Nursery Farmer 
                                <input type="radio" name="involvement_in_fishery" @if($farming_profile->involvement_in_fishery == "Grower") checked @endif value="Grower" class=""> Grower 
                                <input type="radio" name="involvement_in_fishery" @if($farming_profile->involvement_in_fishery == "Both") checked @endif value="Both" class=""> Both 
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Own Water Body (In Kani.)</label>
                            <input type="number" step="0.01" name="own_water_body" value="{{$farming_profile->own_water_body}}" id="own_water_body" required placeholder="Own Water Body" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Lease in Body (In Kani.)</label>
                            <input type="number" step="0.01" name="lease_in_water_body" value="{{$farming_profile->lease_in_water_body}}" id="lease_in_water_body" required placeholder="Lease In Water Body" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Lease Out Body (In Kani.)</label>
                            <input type="number" step="0.01" name="lease_out_water_body" value="{{$farming_profile->lease_out_water_body}}" id="lease_out_water_body" required placeholder="Lease Out Water Body" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Total Water Body (In Kani.)</label>
                            <input type="number" step="0.01" name="total_water_body" value="{{$farming_profile->total_water_body}}" id="total_water_body" required placeholder="Total Water Body" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Have Pump Set ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="have_pump_set" @if($farming_profile->have_pump_set) checked @endif  value="1" class=""> Yes 
                                <input type="radio" name="have_pump_set" @if(!$farming_profile->have_pump_set) checked @endif value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Have Boring or tube well ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="have_tube_well" @if($farming_profile->have_tube_well) checked @endif  value="1" class=""> Yes 
                                <input type="radio" name="have_tube_well" @if(!$farming_profile->have_tube_well) checked @endif  value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Fishing Net ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="fishing_net" @if($farming_profile->fishing_net) checked @endif  value="1" class=""> Yes 
                                <input type="radio" name="fishing_net" @if(!$farming_profile->fishing_net) checked @endif  value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Aereator ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="aereator" @if($farming_profile->aereator) checked @endif  value="1" class=""> Yes 
                                <input type="radio" name="aereator" @if(!$farming_profile->aereator) checked @endif  value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Have you clean pond boundary Regularly ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="have_boundary_regularly" @if($farming_profile->have_boundary_regularly) checked @endif  value="1" class=""> Yes 
                                <input type="radio" name="have_boundary_regularly" @if(!$farming_profile->have_boundary_regularly) checked @endif  value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Have you remove black soil or mud during last 3 years ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="have_remove_black_soil" @if($farming_profile->have_remove_black_soil) checked @endif  value="1" class=""> Yes 
                                <input type="radio" name="have_remove_black_soil" @if(!$farming_profile->have_remove_black_soil) checked @endif  value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Have you applied lime during pond preparation in last year ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="have_applied_lime" @if($farming_profile->have_applied_lime) checked @endif  value="1" class=""> Yes 
                                <input type="radio" name="have_applied_lime" @if(!$farming_profile->have_applied_lime) checked @endif  value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Have you apply cow dung during pond preparation in last year ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="have_apply_cow_dung" @if($farming_profile->have_apply_cow_dung) checked @endif  value="1" class=""> Yes 
                                <input type="radio" name="have_apply_cow_dung" @if(!$farming_profile->have_apply_cow_dung) checked @endif  value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Have you regularly applied lime after stocking in last year ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="have_regularly_apply_lime" @if($farming_profile->have_regularly_apply_lime) checked @endif  value="1" class=""> Yes 
                                <input type="radio" name="have_regularly_apply_lime" @if(!$farming_profile->have_regularly_apply_lime) checked @endif  value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Have you regularly applied cow dung or organic fertiliser after stocking in last year ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="have_regularly_apply_cow_dung" @if($farming_profile->have_regularly_apply_cow_dung) checked @endif  value="1" class=""> Yes 
                                <input type="radio" name="have_regularly_apply_cow_dung" @if(!$farming_profile->have_regularly_apply_cow_dung) checked @endif  value="0" class=""> No 
                            </div>
                        </div>
                    </div>
                    <p>How many seed you have stock last year ?</p>
                    <div class="row">
                        <input type="hidden" value="{{$farming_profile->farming_yearling?$farming_profile->farming_yearling->id:''}}" name="farming_yearling_id" class="form-control">                            
                        <div class="form-group col-md-4">
                            <label>Year</label>
                            <input type="number" step="0.01" value="{{$farming_profile->farming_yearling?$farming_profile->farming_yearling->year:''}}" name="year" class="form-control" required>                            
                        </div>
                        <div class="form-group col-md-4">
                            <label>Figerlings</label>
                            <input type="number" step="0.01" name="figerlings" value="{{$farming_profile->farming_yearling?$farming_profile->farming_yearling->figerlings:''}}" class="form-control" required>                            
                        </div>
                        <div class="form-group col-md-4">
                            <label>Yearlings</label>
                            <input type="number" step="0.01" name="yearlings"  value="{{$farming_profile->farming_yearling?$farming_profile->farming_yearling->yearlings:''}}" class="form-control" required>                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>What Type of Feed you used regularly ?</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="type_of_feed_used" @if($farming_profile->type_of_feed_used == "MOC") checked @endif  value="MOC" class=""> MOC 
                                <input type="radio" name="type_of_feed_used" @if($farming_profile->type_of_feed_used == "Sinking") checked @endif  value="Sinking" class=""> Sinking  
                                <input type="radio" name="type_of_feed_used" @if($farming_profile->type_of_feed_used == "Floating") checked @endif  value="Floating" class=""> Floating  
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Have you done feeding regularly ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="done_feeding_regularly" @if($farming_profile->done_feeding_regularly) checked @endif  value="1" class=""> Yes 
                                <input type="radio" name="done_feeding_regularly" @if(!$farming_profile->done_feeding_regularly) checked @endif  value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Have you checked Water PH regularly ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="have_water_ph_regularly" @if($farming_profile->have_water_ph_regularly) checked @endif  value="1" class=""> Yes 
                                <input type="radio" name="have_water_ph_regularly" @if(!$farming_profile->have_water_ph_regularly) checked @endif value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Have you done meeting regularly ? </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="have_meeting_regularly" @if($farming_profile->have_meeting_regularly) checked @endif value="1" class=""> Yes 
                                <input type="radio" name="have_meeting_regularly" @if(!$farming_profile->have_meeting_regularly) checked @endif value="0" class=""> No 
                            </div>
                        </div>
                    </div>
                    <p>Income from Fish sold last year</p>
                    <div class="row">
                        <input type="hidden" value="{{$farming_profile->farming_income?$farming_profile->farming_income->id:''}}" name="farming_income_id" class="form-control">                            
                        <div class="form-group col-md-3">
                            <label>Year</label>
                            <input type="number" step="0.01" name="fish_sold_year" value="{{$farming_profile->farming_income?$farming_profile->farming_income->year:''}}" class="form-control" required>                            
                        </div>
                        <div class="form-group col-md-3">
                            <label>Quantity</label>
                            <input type="number" step="0.01" value="{{$farming_profile->farming_income?$farming_profile->farming_income->quantity:'0'}}"  name="fish_sold_quantity" id="fish_sold_quantity" class="form-control" required>                            
                        </div>
                        <div class="form-group col-md-3">
                            <label>Rate</label>
                            <input type="number" step="0.01" value="{{$farming_profile->farming_income?$farming_profile->farming_income->rate:'0'}}" value="0" name="fish_sold_rate" id="fish_sold_rate" class="form-control" required>                            
                        </div>
                        <div class="form-group col-md-3">
                            <label>Amount</label>
                            <input type="number" step="0.01" value="{{$farming_profile->farming_income?$farming_profile->farming_income->amount:''}}" readonly name="fish_sold_amount" id="fish_sold_amount" class="form-control" required>                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Have you attend any training programme on scientific fish farming ?</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="attend_training_programme" @if($farming_profile->attend_training_programme) checked @endif  value="1" class=""> Yes 
                                <input type="radio" name="attend_training_programme" @if(!$farming_profile->attend_training_programme) checked @endif  value="0" class=""> No  
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Have you ever made exposure to good practices of fish farming ?</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="exposure_good_practics" @if($farming_profile->exposure_good_practics) checked @endif  value="1" class=""> Yes 
                                <input type="radio" name="exposure_good_practics" @if(!$farming_profile->exposure_good_practics) checked @endif  value="0" class=""> No  
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Create <i class="icon-paperplane ml-2"></i></button>
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
        $('input[type=radio][name="fish_pb_member"]').on('change', function(event) {
            var value=$(this).val();
            if (value==1) {
                $('#fish_pb_member_name_field').attr('hidden',false);
            }else{
                $('#fish_pb_member_name_field').attr('hidden',true);
            }
        });
        $('input[type=radio][name="shg_member"]').on('change', function(event) {
            var value=$(this).val()
            if (value==1) {
                $('#shg_member_name_field').attr('hidden',false);
            }else{
                $('#shg_member_name_field').attr('hidden',true);
            }
        });
        $('#own_water_body').change(function(){
            amount = parseFloat(this.value);
            total_water_body =  parseFloat($('#total_water_body').val());
            total_amount = amount + total_water_body;
            $('#total_water_body').val(total_amount.toFixed(2));
        });
        $('#lease_in_water_body').change(function(){
            amount = parseFloat(this.value);
            total_water_body =  parseFloat($('#total_water_body').val());
            total_amount = amount + total_water_body;
            $('#total_water_body').val(total_amount.toFixed(2));
        });
        $('#lease_out_water_body').change(function(){
            amount = parseFloat(this.value);
            total_water_body =  parseFloat($('#total_water_body').val());
            total_amount = total_water_body - amount;
            $('#total_water_body').val(total_amount.toFixed(2));
        });
        $('#fish_sold_quantity').change(function(){
            qty = parseFloat(this.value);
            rate =  parseFloat($('#fish_sold_rate').val());
            total_amount = qty * rate;
            $('#fish_sold_amount').val(total_amount.toFixed(2));
        });
        $('#fish_sold_rate').change(function(){
            rate = parseFloat(this.value);
            qty =  parseFloat($('#fish_sold_quantity').val());
            total_amount = qty * rate;
            $('#fish_sold_amount').val(total_amount.toFixed(2));
        });
    });
</script>
@endsection