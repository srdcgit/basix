@extends('project.layout.index')

@section('title')
    Add Users
@endsection

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Add New Users</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
            
                <form action="{{route('project.user.store')}}" id="userCreateForm" method="post" enctype="multipart/form-data" >
                @csrf
                    <div class="row">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <div class="col-md-4">
                            <label>Name</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="text" id="name" class="form-control" value="{{old('name')}}" placeholder="username" name="name" required>
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Employee Code</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="text" id="employee_code" class="form-control"  value="{{old('employee_code')}}" placeholder="Enter Employee Code" name="employee_code" required>
                                <div class="form-control-feedback">
                                    <i class="icon-code text-muted"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Email Address</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="text" id="email" class="form-control"  value="{{old('email')}}" placeholder="Enter your email" name="email" required>
                                <div class="form-control-feedback">
                                    <i class="icon-mail5 text-muted"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Contact</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="text" id="phone" class="form-control"  value="{{old('phone')}}" placeholder="Enter your phone" name="phone" required>
                                <div class="form-control-feedback">
                                    <i class="icon-phone text-muted"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Profile Image</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input class="form-control" type="file" name="image" placeholder="Enter password">
                                <div class="form-control-feedback">
                                    <i class="icon-file-picture text-muted"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Password</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input id="pwd" minlength="4" class="form-control" value="{{old('password')}}" onkeyup="validatePassword(this.value);" type="password" name="password" placeholder="Enter password" required>
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                                <span id="msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Confirm Password</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input id="confirmpwd" minlength="4" class="form-control" value="{{old('confirm_password')}}" onkeyup="confirmPassword(this.value);" type="password" name="confirm_password" placeholder="Enter confirm password" required>
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                                <span id="confirmmsg"></span>
                            </div>
                        </div>
                        {{-- <input type="hidden" name="role_id" value="3"> --}}
                        <div class="col-md-4">
                            <label>Role</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <select name="role_id" class="form-control select-search" id="role_id" required>
                                    <option>Select</option>
                                    @foreach(App\Models\Role::whereIn('name',['Executive','Field Staff','Crp'])->get() as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 project_select" style="display:none;">
                            <label>Project Manager</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <select name="project_manager_id" class="form-control select-search" id="project_manager_id">
                                    <option value="">Select</option>
                                    @foreach(App\Models\User::where('role_id',2)->where('is_verified',1)->where('is_active',1)->get() as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 executive_select" style="display:none;">
                            <label>Executive</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <select name="executive_id" class="form-control select-search" id="executive_id">
                                    <option value="">Select</option>
                                    @foreach(App\Models\User::where('role_id',3)->where('is_verified',1)->where('is_active',1)->get() as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 fieldstaff_select" style="display:none;">
                            <label>Field Staff</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <select name="field_staff_id" class="form-control select-search" id="field_staff_id">
                                    <option value="">Select</option>
                                    @foreach(App\Models\User::where('role_id',4)->where('is_verified',1)->where('is_active',1)->get() as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4 district_fields" style="display:none;">
                            <label>Choose State</label>
                            <select  name="state_id" id="state_id"  class="form-control select-search" >
                                <option selected disabled>Select State</option>
                                @foreach(App\Models\State::all() as $state)
                                <option value="{{$state->id}}">{{$state->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4 district_fields" style="display:none;">
                            <label>Choose District</label>
                            <select  name="district_id" id="district_id"  class="form-control select-search" >
                                <option selected disabled>Select District</option>                    
                            </select>
                        </div>
                        <div class="form-group col-md-4 district_fields" style="display:none;">
                            <label>Choose Blocks</label>
                            <select  name="block_ids[]" id="block_id" multiple class="form-control select-search" >
                                <option disabled>Select Block</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 staff_fields" style="display:none;">
                            <label>Choose Gram Panchyat</label>
                            <select  name="gram_panchyat_ids[]" id="gram_panchyat_id" multiple class="form-control select-search" >
                                <option disabled>Select Gram Panchyat</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 staff_fields" style="display:none;">
                            <label>Choose Village</label>
                            <select  name="village_ids[]" id="village_id" multiple class="form-control select-search" >
                                <option disabled>Select Village</option>
                            </select>
                        </div>

                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Create <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

<script>
    function validatePassword(password) {
        
        // Do not show anything when the length of password is zero.
        if (password.length === 0) {
            document.getElementById("msg").innerHTML = "";
            return;
        }
        // Create an array and push all possible values that you want in password
        var matchedCase = new Array();
        matchedCase.push("[$@$!%*#?&]"); // Special Charector
        matchedCase.push("[A-Z]");      // Uppercase Alpabates
        matchedCase.push("[0-9]");      // Numbers
        matchedCase.push("[a-z]");     // Lowercase Alphabates

        // Check the conditions
        var ctr = 0;
        for (var i = 0; i < matchedCase.length; i++) {
            if (new RegExp(matchedCase[i]).test(password)) {
                ctr++;
            }
        }
        // Display it
        var color = "";
        var strength = "";
        switch (ctr) {
            case 0:
            case 1:
            case 2:
                strength = "Very Weak";
                color = "red";
                break;
            case 3:
                strength = "Medium";
                color = "orange";
                break;
            case 4:
                strength = "Strong";
                color = "green";
                break;
        }
        document.getElementById("msg").innerHTML = strength;
        document.getElementById("msg").style.color = color;
    }
    function confirmPassword(password) {
        
        // Do not show anything when the length of password is zero.
        if (password.length === 0) {
            document.getElementById("confirmmsg").innerHTML = "";
            return;
        }
        // new_password = document.getElementById("pwd").val();
        new_password =  $('#pwd').val();
        if(new_password == password)
        {
            var strength = "Password Matched";
            var color = "green";
        }else{
            var strength = "Password dont Matched";
            var color = "red";
        }

        document.getElementById("confirmmsg").innerHTML = strength;
        document.getElementById("confirmmsg").style.color = color;
    }
    
</script>
<script>
    
    $(document).ready(function(){
        $('#state_id').change(function(){
            let state_id = $(this).val();
            $.ajax({
                url: "{{route('project.user.get_districts')}}",
                method: 'post',
                data: {
                    state_id: state_id,
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(response){
                    districts = response.districts;
                    $('#district_id').empty();
                    $('#block_id').empty();
                    $('#village_id').empty();
                    $('#gram_panchyat_id').empty();
                    $('#district_id').append('<option disabled>Select District</option>');
                    for (i=0;i<districts.length;i++){
                        $('#district_id').append('<option value="'+districts[i].id+'">'+districts[i].name+'</option>');
                    }
                }
            });
        });
        $('#district_id').change(function(){
            let district_id = $(this).val();
            $.ajax({
                url: "{{route('project.user.get_blocks')}}",
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
                    $('#village_id').empty();
                    $('#gram_panchyat_id').empty();
                    $('#block_id').append('<option disabled>Select Blocks</option>');
                    for (i=0;i<blocks.length;i++){
                        $('#block_id').append('<option value="'+blocks[i].id+'">'+blocks[i].name+'</option>');
                    }
                }
            });
        });
        $('#block_id').change(function(){
            let data = $('#userCreateForm').serialize();
            $.ajax({
                url: "{{route('project.user.get_gram_panchyats')}}",
                method: 'post',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(response){
                    gram_panchyats = response.gram_panchyats;
                    $('#gram_panchyat_id').empty();
                    $('#village_id').empty();
                    $('#gram_panchyat_id').append('<option disabled>Select Gram Panchyat</option>');
                    for (i=0;i<gram_panchyats.length;i++){
                        $('#gram_panchyat_id').append('<option value="'+gram_panchyats[i].id+'">'+gram_panchyats[i].name+'</option>');
                    }
                }
            });
        });
        $('#gram_panchyat_id').change(function(){
            $.ajax({
                url: "{{route('project.user.get_villages')}}",
                method: 'post',
                data: $('#userCreateForm').serialize(),
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
<script>
    $(document).ready(function(){
        $('#role_id').change(function(){
            role_id = this.value;
            if(role_id == 3)
            {
                $('.district_fields').show();
                $('.project_select').show();
                $('.staff_fields').hide();
                $('.executive_select').hide();
                $('.fieldstaff_select').hide();
                $('#project_manager_id').attr('required',true);
                $('#field_staff_id').attr('required',false);
                $('#executive_id').attr('required',false);
            }else if(role_id == 4)
            {
                $('.district_fields').show();
                $('.executive_select').show();
                $('#executive_id').attr('required',true);
                $('#field_staff_id').attr('required',false);
                $('#project_manager_id').attr('required',false);
                $('.project_select').hide();
                $('.fieldstaff_select').hide();
                $('.staff_fields').show();
            }else if(role_id == 5)
            {
                $('.district_fields').show();
                $('.staff_fields').show();
                $('.executive_select').hide();
                $('#executive_id').attr('required',false);
                $('#project_manager_id').attr('required',false);
                $('.project_select').hide();
                $('.fieldstaff_select').show();
                $('#field_staff_id').attr('required',true);
            }
        });
    });
</script>
@endsection
