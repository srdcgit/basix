@extends('crp.layout.index')

@section('title')
    Add New Training Profile
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Add New Training Profile</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('crp.training_report.store')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Date of Event</label>
                            <input type="date" name="date_of_event" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Geo Location</label>
                            <input type="text" readonly name="geo_location" id="geo_location" placeholder="Geo Location" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Level of Training</label>
                            <select  name="level_of_training" id="level_of_training" class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Level Of Training</option>
                                <option value="State">State</option>
                                <option value="District">District</option>
                                <option value="Block">Block</option>
                                <option value="Village">Village</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4" id="block-field" hidden>
                            <label>Choose Block</label>
                            <select id="block_id" name="block_id" class="form-control select-search" data-fouc >
                                <option selected disabled>Select Block</option>
                                @foreach(App\Models\Block::all() as $block)
                                <option value="{{$block->id}}">{{$block->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4" id="village-field" hidden>
                            <label>Choose Village</label>
                            <select id="village_id" name="village_id" class="form-control select-search" data-fouc>
                                <option selected disabled>Select Village</option>
                                @foreach(App\Models\Village::all() as $village)
                                <option value="{{$village->id}}">{{$village->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4" id="district-field" hidden>
                            <label>Choose District</label>
                            <select id="district_id"  name="district_id" class="form-control select-search" data-fouc>
                                <option selected disabled>Select District</option>
                                @foreach(App\Models\District::all() as $district)
                                <option value="{{$district->id}}">{{$district->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4" id="state-field" hidden>
                            <label>Choose State</label>
                            <select id="state_id" name="state_id" class="form-control select-search" data-fouc>
                                <option selected disabled>Select State</option>
                                @foreach(App\Models\State::all() as $state)
                                <option value="{{$state->id}}">{{$state->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Type of Event</label>
                            <select  name="type"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Type of Event</option>
                                <option value="Workshop">Workshop</option>
                                <option value="Training">Training</option>
                                <option value="Concept Seeding">Concept Seeding</option>
                                <option value="Exposure">Exposure</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Facilitator Name</label>
                            <input type="text" name="facilitator_name" placeholder="Facilitator Name" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Any Co-facilitator Name?</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="radio" name="is_co_facilitator_name" id="show_co_facilitator_name" required value="1" class=""> Yes 
                                <input type="radio" name="is_co_facilitator_name" id="hide_co_facilitator_name" required value="0" class=""> No 
                            </div>
                        </div>
                        <div class="form-group col-md-4" id="co_facilitator_name_field" hidden>
                            <label>Co-Facilitator Name</label>
                            <input type="text" name="co_facilitator_name" id="co_facilitator_name" placeholder="Co-facilitator Name" class="form-control" >
                        </div>
                        <div class="form-group col-md-4" >
                            <label>Name of the Training</label>
                            <input type="text" name="name"  placeholder="Name of the Training" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4" >
                            <label>Objective of Training</label>
                            <input type="text" name="objective"  placeholder="Objective of training" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Type of Participants</label>
                            <select  name="type_of_participants"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Type Of Participants</option>
                                <option value="Farmer">Farmer</option>
                                <option value="BoD">BoD</option>
                                <option value="FPO Staff">FPO Staff</option>
                                <option value="Govt Staff">Govt Staff</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Total Number of Participants</label>
                            <input type="number" step="0.01" name="number_of_participants"  placeholder="Number of Participants" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Number of Male</label>
                            <input type="number" step="0.01" name="number_of_male"  placeholder="Number of Male" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Number of Female</label>
                            <input type="number" step="0.01" name="number_of_female"  placeholder="Number of Female" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Photograph</label>
                            <input type="file" name="image"  class="form-control" required>
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
        navigator.geolocation.getCurrentPosition(showPosition);
        
        function showPosition(position) {
            $('#geo_location').val(position.coords.latitude+','+position.coords.longitude);
        }
        $('input[type=radio][name="is_co_facilitator_name"]').on('change', function(event) {
            var value=$(this).val();
            if (value==1) {
                $('#co_facilitator_name_field').attr('hidden',false);
                $('#co_facilitator_name').attr('required',true);
            }else{
                $('#co_facilitator_name_field').attr('hidden',true);
                $('#co_facilitator_name').attr('required',false);
            }
        });
        $('#level_of_training').change(function(){
            level_of_training = this.value;
            if(level_of_training == 'State')
            {
                $('#block-field').attr('hidden',true);
                $('#village-field').attr('hidden',true);
                $('#district-field').attr('hidden',true);
                $('#state-field').attr('hidden',false);
                $('#block_id').attr('required',false);
                $('#village_id').attr('required',false);
                $('#district_id').attr('required',false);
                $('#state_id').attr('required',true);
            }else if(level_of_training == 'Block')
            {
                $('#block-field').attr('hidden',false);
                $('#village-field').attr('hidden',true);
                $('#district-field').attr('hidden',true);
                $('#state-field').attr('hidden',true);
                $('#block_id').attr('required',true);
                $('#village_id').attr('required',false);
                $('#district_id').attr('required',false);
                $('#state_id').attr('required',false);
            }else if(level_of_training == 'Village')
            {
                $('#block-field').attr('hidden',true);
                $('#village-field').attr('hidden',false);
                $('#district-field').attr('hidden',true);
                $('#state-field').attr('hidden',true);
                $('#block_id').attr('required',false);
                $('#village_id').attr('required',true);
                $('#district_id').attr('required',false);
                $('#state_id').attr('required',false);
            }else if(level_of_training == 'District')
            {
                $('#block-field').attr('hidden',true);
                $('#village-field').attr('hidden',true);
                $('#district-field').attr('hidden',false);
                $('#state-field').attr('hidden',true);
                $('#block_id').attr('required',false);
                $('#village_id').attr('required',false);
                $('#district_id').attr('required',true);
                $('#state_id').attr('required',false);
            }
        });
    });
</script>
@endsection