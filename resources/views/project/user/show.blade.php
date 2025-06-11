@extends('project.layout.index')

@section('title')
    {{$user->name}} Project User
@endsection

@section('content')


				<!-- Inner container -->
				<div class="d-md-flex align-items-md-start">

					<!-- Left sidebar component -->
					<div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-left wmin-300 border-0 shadow-0 sidebar-expand-md">

						<!-- Sidebar content -->
						<div class="sidebar-content">

							<!-- Navigation -->
							<div class="card">
								<div class="card-body bg-indigo-400 text-center card-img-top" style="background-image: url({{asset('user_asset/global_assets/images/backgrounds/panel_bg.png')}}); background-size: contain;">
									<div class="card-img-actions d-inline-block mb-3">
										@if($user->image)
										<img class="img-fluid rounded-circle" src="{{asset($user->image)}}" width="170" height="170" alt="">
										@else 
										<img class="img-fluid rounded-circle" src="{{asset('user_asset/global_assets/images/placeholders/placeholder.jpg')}}" width="170" height="170" alt="">
										@endif
										<div class="card-img-actions-overlay rounded-circle">
											<a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round">
												<i class="icon-plus3"></i>
											</a>
											<a href="user_pages_profile.html" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2">
												<i class="icon-link"></i>
											</a>
										</div>
									</div>

						    		<h6 class="font-weight-semibold mb-0">{{$user->name}}</h6>
						    		<span class="d-block opacity-75">{{$user->email}}</span>
									
									@if($user->is_verified)
										<span class="badge badge-success">Verified</span>
									@else
										<span class="badge badge-danger">Not Verified</span>
									@endif
									
									@if($user->is_active)
										<span class="badge badge-success">Active</span>
									@else
										<span class="badge badge-danger">Pending</span>
									@endif
									<br>
					    			<div class="list-icons list-icons-extended mt-3">
										
										@if($user->is_verified)
											<a href="{{route('project.user.revert_verification',$user->id)}}" class="btn btn-danger btn-sm">Revert Verification</a>
										@else 
											<a href="{{route('project.user.verified',$user->id)}}" class="btn btn-info btn-sm">Verify</a>
										@endif
										@if($user->is_active)
											<a href="{{route('project.user.in_active',$user->id)}}" class="btn btn-warning btn-sm">In Active</a>
										@else 
											<a href="{{route('project.user.active',$user->id)}}" class="btn btn-success btn-sm">Active</a>
										@endif
									</div>
						    	</div>

								<div class="card-body p-0">
									<ul class="nav nav-sidebar mb-2">
										<li class="nav-item-header">Navigation</li>
										<li class="nav-item">
											<a href="#profile" class="nav-link active" data-toggle="tab">
												<i class="icon-user"></i>
												 Basic profile
											</a>
										</li>
										<li class="nav-item-divider"></li>
										<li class="nav-item">
											<a href="{{route('project.user.index')}}" class="nav-link" data-toggle="tab">
												<i class="icon-switch2"></i>
												Go Back To User Project Page
											</a>
										</li>
									</ul>
								</div>
							</div>
							<!-- /navigation -->
						</div>
						<!-- /sidebar content -->

					</div>
					<!-- /left sidebar component -->


					<!-- Right content -->
					<div class="tab-content w-100 overflow-auto">
						<div class="tab-pane fade active show" id="profile">


							<!-- Profile info -->
							<div class="card">
								<div class="card-header header-elements-inline">
									<h5 class="card-title">Profile information</h5>
									<div class="header-elements">
										<div class="list-icons">
					                		<a class="list-icons-item" data-action="collapse"></a>
					                		<a class="list-icons-item" data-action="reload"></a>
					                		<a class="list-icons-item" data-action="remove"></a>
					                	</div>
				                	</div>
								</div>

								<div class="card-body">
									<form action="{{route('project.user.update',$user->id)}}" id="userUpdateForm" method="post" enctype="multipart/form-data" >
										@method('PUT')
										@csrf
										<div class="form-group">
											<div class="row">
												<div class="col-md-6">
													<label>Username</label>
													<input type="text" name="name" value="{{$user->name}}" class="form-control">
												</div>
												<div class="col-md-6">
													<label>Email</label>
													<input type="email" value="{{$user->email}}" name="email" readonly class="form-control">
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-6">
													<label>Employee Code</label>
													<input type="text" name="employee_code" value="{{$user->employee_code}}" class="form-control">
												</div>
												<div class="col-md-6">
													<label>Contact</label>
													<input type="text" value="{{$user->phone}}" name="phone" class="form-control">
												</div>
											</div>
										</div>

											<div class="row">
												<div class="form-group col-md-6">
													<label>Password <small style="color:red;">(Leave It Blank if you don't want to change)</small></label>
													<input type="password" name="password" placeholder="Password" class="form-control">
												</div>
												<div class="form-group col-md-6">
													<label>Upload profile image</label>
				                                    <input type="file" class="form-input-styled" name="image" data-fouc>
												</div>
												<div class="col-md-4">
													<label>Role</label>
													<div class="form-group form-group-feedback form-group-feedback-left">
														<select name="role_id" class="form-control select-search" id="role_id" required>
															<option>Select</option>
															@foreach(App\Models\Role::whereIn('name',['Executive','Field Staff','Crp'])->get() as $role)
															<option @if($user->role_id == $role->id) selected @endif value="{{$role->id}}">{{$role->name}}</option>
															@endforeach
														</select>
													</div>
												</div>
												<div class="col-md-4 project_select" @if($user->role_id != 3) style="display:none;" @endif>
													<label>Project Manager</label>
													<div class="form-group form-group-feedback form-group-feedback-left">
														<select name="project_manager_id" class="form-control select-search" id="project_manager_id">
															<option value="">Select</option>
															@foreach(App\Models\User::where('role_id',2)->where('is_verified',1)->where('is_active',1)->get() as $project_manager)
															<option {{$user->project_manager_id == $project_manager->id ? 'selected' : ''}} value="{{$project_manager->id}}">{{$project_manager->name}}</option>
															@endforeach
														</select>
													</div>
												</div>
												<div class="col-md-4 executive_select" @if($user->role_id != 4)  style="display:none;" @endif>
													<label>Executive</label>
													<div class="form-group form-group-feedback form-group-feedback-left">
														<select name="executive_id" class="form-control select-search" id="executive_id">
															<option value="">Select</option>
															@foreach(App\Models\User::where('role_id',3)->where('is_verified',1)->where('is_active',1)->get() as $executive)
															<option {{$user->executive_id == $executive->id ? 'selected' : ''}} value="{{$executive->id}}">{{$executive->name}}</option>
															@endforeach
														</select>
													</div>
												</div>
												<div class="col-md-4 fieldstaff_select" @if($user->role_id != 5) style="display:none;" @endif>
													<label>Field Staff</label>
													<div class="form-group form-group-feedback form-group-feedback-left">
														<select name="field_staff_id" class="form-control select-search" id="field_staff_id">
															<option value="">Select</option>
															@foreach(App\Models\User::where('role_id',4)->where('is_verified',1)->where('is_active',1)->get() as $field_staff)
															<option  {{$user->field_staff_id == $field_staff->id ? 'selected' : ''}}  value="{{$field_staff->id}}">{{$field_staff->name}}</option>
															@endforeach
														</select>
													</div>
												</div>
												<div class="form-group col-md-4 district_fields">
													<label>Choose State</label>
													<select  name="state_id" id="state_id" class="form-control select-search" >
														<option selected disabled>Select State</option>
														@foreach(App\Models\State::all() as $state)
														<option  @if($user->state_id == $state->id) selected @endif value="{{$state->id}}">{{$state->name}}</option>
														@endforeach
													</select>
												</div>
												<div class="form-group col-md-4 district_fields" >
													<label>Choose District</label>
													<select  name="district_id" id="district_id"  class="form-control select-search" >
														<option selected disabled>Select District</option>
														@foreach(App\Models\District::where('state_id',$user->state_id)->get() as $district)
														<option @if($user->district_id == $district->id) selected @endif value="{{$district->id}}">{{$district->name}}</option>
														@endforeach
													</select>
												</div>
												<div class="form-group col-md-4 district_fields" >
													<label>Choose Block</label>
													<select  name="block_ids[]" id="block_id" multiple class="form-control select-search" >
														<option disabled>Select Block</option>
														@foreach(App\Models\Block::where('district_id',$user->district_id)->get() as $block)
														<option @if(in_array($block->id,$user_blocks)) selected @endif  value="{{$block->id}}">{{$block->name}}</option>
														@endforeach
													</select>
												</div>
												<div class="form-group col-md-4 staff_fields" @if($user->role_id == 3 ) style="display:none;" @endif>
													<label>Choose Gram Panchyat</label>
													<select  name="gram_panchyat_ids[]" id="gram_panchyat_id" multiple class="form-control select-search" >
														<option disabled>Select Gram Panchyat</option>
														@foreach(App\Models\GramPanchyat::whereIn('block_id',$user_blocks)->get() as $gram_panchyat)
														<option @if(in_array($gram_panchyat->id,$user_gram_panchyats)) selected @endif value="{{$gram_panchyat->id}}">{{$gram_panchyat->name}}</option>
														@endforeach
													</select>
												</div>
												<div class="form-group col-md-4 staff_fields" @if($user->role_id == 3 ) style="display:none;" @endif>
													<label>Choose Village</label>
													<select  name="village_ids[]" id="village_id" multiple class="form-control select-search" >
														<option disabled>Select Village</option>
														@foreach(App\Models\Village::whereIn('gram_panchyat_id',$user_gram_panchyats)->get() as $village)
														<option @if(in_array($village->id,$user_villages)) selected @endif value="{{$village->id}}">{{$village->name}}</option>
														@endforeach
													</select>
												</div>
											</div>

				                        <div class="text-right">
				                        	<button type="submit" class="btn btn-primary">Save changes</button>
				                        </div>
									</form>
								</div>
							</div>
							<!-- /profile info -->

					    </div>
					</div>
					<!-- /right content -->

				</div>
				<!-- /inner container -->
@endsection
@section('scripts')
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
            $.ajax({
                url: "{{route('project.user.get_gram_panchyats')}}",
                method: 'post',
                data: {
					block_ids : $('#block_id').val()
				},
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
                data: {
					gram_panchyat_ids : $('#gram_panchyat_id').val()
				},,
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
