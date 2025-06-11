@extends('field_staff.layout.index')

@section('title')
    Edit {{$respondent_master->name}} Respondent Master
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Edit {{$respondent_master->name}} Respondent Master</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('field_staff.respondent_master.update',$respondent_master->id)}}" method="post" enctype="multipart/form-data" >
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            @if($respondent_master->is_validate)
                            <a href="{{route('field_staff.respondent_master.un_validate',$respondent_master->id)}}" class="btn btn-sm btn-danger float-right">Un-validate</a>
                            @else 
                            <a href="{{route('field_staff.respondent_master.validate',$respondent_master->id)}}" class="btn btn-sm btn-success float-right">Validate</a>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Name</label>
                            <input name="name" type="text" value="{{$respondent_master->name}}" class="form-control" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Image @if($respondent_master->image) <a href="{{asset($respondent_master->image)}}" target="_blank"> ( Show Image )</a>@endif</label>
                            <input name="image" type="file" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Choose District</label>
                            <select  name="district_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select District</option>
                                @foreach(App\Models\District::all() as $district)
                                <option {{$respondent_master->district_id == $district->id?'selected':''}} value="{{$district->id}}">{{$district->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Choose Block</label>
                            <select  name="block_id"  class="form-control select-search" data-fouc required>
                                <option value="">Select Block</option>
                                @foreach(App\Models\Block::where('district_id',$respondent_master->district_id)->get() as $block)
                                <option {{$respondent_master->block_id == $block->id?'selected':''}} value="{{$block->id}}">{{$block->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Choose Gram Panchyat</label>
                            <select  name="gram_panchyat_id" class="form-control select-search" data-fouc required>
                                <option value="">Select Gram Panchyat</option>
                                @foreach(App\Models\GramPanchyat::where('block_id',$respondent_master->block_id)->get() as $gram_panchyat)
                                <option {{$respondent_master->gram_panchyat_id == $gram_panchyat->id?'selected':''}} value="{{$gram_panchyat->id}}">{{$gram_panchyat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Choose Village</label>
                            <select  name="village_id" class="form-control select-search" data-fouc required>
                                <option value="">Select Village</option>
                                @foreach(App\Models\Village::where('gram_panchyat_id',$respondent_master->gram_panchyat_id)->get() as $village)
                                <option {{$respondent_master->village_id == $village->id?'selected':''}} value="{{$village->id}}">{{$village->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Choose Gender</label>
                            <select  name="gender" class="form-control select-search" data-fouc required>
                                <option disabled>Select Gender</option>
                                <option {{$respondent_master->gender == 'Male'?'selected':''}} value="Male">Male</option>
                                <option {{$respondent_master->gender == 'Female'?'selected':''}} value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Age</label>
                            <input name="age" type="number" step="0.01" value="{{$respondent_master->age}}" class="form-control" placeholder="Enter Age" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Choose Education</label>
                            <select  name="education" class="form-control select-search" data-fouc required>
                                <option disabled>Select Education</option>
                                <option {{$respondent_master->education == 'Illiterate'?'selected':''}} value="Illiterate">Illiterate</option>
                                <option {{$respondent_master->education == 'Primary'?'selected':''}} value="Primary">Primary</option>
                                <option {{$respondent_master->education == 'HSLC'?'selected':''}} value="HSLC">HSLC</option>
                                <option {{$respondent_master->education == 'Graduate'?'selected':''}} value="Graduate">Graduate</option>
                                <option {{$respondent_master->education == 'PG'?'selected':''}} value="PG">PG</option>
                                <option {{$respondent_master->education == 'Technical Education'?'selected':''}} value="Technical Education">Technical Education</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Number Family Members</label>
                            <input name="number_family_member" value="{{$respondent_master->number_family_member}}" type="number" step="0.01" class="form-control" placeholder="Enter Number Family Member" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Choose Caste</label>
                            <select  name="caste" class="form-control select-search" data-fouc required>
                                <option disabled>Select Caste</option>
                                <option {{$respondent_master->caste == 'ST'?'selected':''}} value="ST">ST</option>
                                <option {{$respondent_master->caste == 'SC'?'selected':''}} value="SC">SC</option>
                                <option {{$respondent_master->caste == 'OBC'?'selected':''}} value="OBC">OBC</option>
                                <option {{$respondent_master->caste == 'General'?'selected':''}} value="General">General</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Choose Religion</label>
                            <select  name="religion" class="form-control select-search" data-fouc required>
                                <option disabled>Select Religion</option>
                                <option {{$respondent_master->religion == 'Hindu'?'selected':''}} value="Hindu">Hindu</option>
                                <option {{$respondent_master->religion == 'Muslim'?'selected':''}} value="Muslim">Muslim</option>
                                <option {{$respondent_master->religion == 'Christian'?'selected':''}} value="Christian">Christian</option>
                                <option {{$respondent_master->religion == 'Buddhist'?'selected':''}} value="Buddhist">Buddhist</option>
                                <option {{$respondent_master->religion == 'Others'?'selected':''}} value="Others">Others</option>
                            </select>
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

@section('scripts')
<script>
    $(document).ready(function(){
        $('#district_id').change(function(){
            let district_id = $(this).val();
            $.ajax({
                url: "{{route('field_staff.monthly_farming_report.get_blocks')}}",
                method: 'post',
                data: {
                    district_id: district_id,
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(response){
                    blocks = response.blocks;
                    $('#block_id').empty();
                    $('#block_id').append('<option disabled>Select Blocks</option>');
                    for (i=0;i<blocks.length;i++){
                        $('#block_id').append('<option value="'+blocks[i].id+'">'+blocks[i].name+'</option>');
                    }
                }
            });
        });
        $('#block_id').change(function(){
            let block_id = $(this).val();
            $.ajax({
                url: "{{route('field_staff.monthly_farming_report.get_gram_panchyats')}}",
                method: 'post',
                data: {
                    block_id: block_id,
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(response){
                    gram_panchyats = response.gram_panchyats;
                    $('#gram_panchyat_id').empty();
                    $('#gram_panchyat_id').append('<option disabled>Select Gram Panchyat</option>');
                    for (i=0;i<gram_panchyats.length;i++){
                        $('#gram_panchyat_id').append('<option value="'+gram_panchyats[i].id+'">'+gram_panchyats[i].name+'</option>');
                    }
                }
            });
        });
        $('#gram_panchyat_id').change(function(){
            let gram_panchyat_id = $(this).val();
            $.ajax({
                url: "{{route('field_staff.monthly_farming_report.get_villages')}}",
                method: 'post',
                data: {
                    gram_panchyat_id: gram_panchyat_id,
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(response){
                    villages = response.villages;
                    $('#village_id').empty();
                    $('#village_id').append('<option disabled>Select Village</option>');
                    for (i=0;i<villages.length;i++){
                        $('#village_id').append('<option value="'+villages[i].id+'">'+villages[i].name+'</option>');
                    }
                }
            });
        });
    });
</script>
@endsection
@endsection