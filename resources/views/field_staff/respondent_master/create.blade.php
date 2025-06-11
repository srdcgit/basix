@extends('field_staff.layout.index')

@section('title')
    Add New Respondent Master
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Add New Respondent Master</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('field_staff.respondent_master.store')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Image</label>
                            <input name="image" type="file" class="form-control" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Choose District</label>
                            <select name="district_id" id="district_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select District</option>
                                @foreach(App\Models\District::all() as $district)
                                <option value="{{$district->id}}">{{$district->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Choose Block</label>
                            <select name="block_id" id="block_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Block</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Choose Gram Panchyat</label>
                            <select name="gram_panchyat_id" id="gram_panchyat_id" class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Gram Panchyat</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Choose Village</label>
                            <select name="village_id" id="village_id" class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Village</option>
                                
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Choose Gender</label>
                            <select  name="gender" class="form-control select-search" data-fouc required>
                                <option disabled>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Age</label>
                            <input name="age" type="number" step="0.01" class="form-control" placeholder="Enter Age" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Choose Education</label>
                            <select  name="education" class="form-control select-search" data-fouc required>
                                <option disabled>Select Education</option>
                                <option value="Illiterate">Illiterate</option>
                                <option value="Primary">Primary</option>
                                <option value="HSLC">HSLC</option>
                                <option value="Graduate">Graduate</option>
                                <option value="PG">PG</option>
                                <option value="Technical Education">Technical Education</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Number Family Members</label>
                            <input name="number_family_member" type="number" step="0.01" class="form-control" placeholder="Enter Number Family Member" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Choose Caste</label>
                            <select  name="caste" class="form-control select-search" data-fouc required>
                                <option disabled>Select Caste</option>
                                <option value="ST">ST</option>
                                <option value="SC">SC</option>
                                <option value="OBC">OBC</option>
                                <option value="General">General</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Choose Religion</label>
                            <select  name="religion" class="form-control select-search" data-fouc required>
                                <option disabled>Select Religion</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Muslim">Muslim</option>
                                <option value="Christian">Christian</option>
                                <option value="Buddhist">Buddhist</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>
                    {{-- <div class="text-right">
                        <button type="submit" class="btn btn-primary">Create <i class="icon-paperplane ml-2"></i></button>
                    </div> --}}
                    
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