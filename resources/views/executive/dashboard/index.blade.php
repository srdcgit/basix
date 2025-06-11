@extends('executive.layout.index')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="row">
   <div class="col-sm-4 col-xl-4">
        <a href="#">
            <div class="card card-body bg-blue-400 has-bg-image">
                <div class="media">
                    <div class="mr-3 align-self-center">
                        <i class="icon-stack-picture icon-3x opacity-75"></i>
                    </div>
                    <div class="media-body text-right">
                    <h3 class="mb-0">{{Auth::user()->projects->count()}}</h3>
                        <span class="text-uppercase font-size-xs">Total Projects Assigned</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-4 col-xl-4">
        <a href="#">
            <div class="card card-body bg-green-400 has-bg-image">
                <div class="media">
                    <div class="mr-3 align-self-center">
                        <i class="icon-user icon-3x opacity-75"></i>
                    </div>
                    <div class="media-body text-right">
                    <h3 class="mb-0">{{App\Models\User::where('executive_id',Auth::user()->id)->count()}}</h3>
                        <span class="text-uppercase font-size-xs">Total Field Staff Users</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-4 col-xl-4">
        {{-- <a href="{{route('field_staff.farming_profile.index')}}"> --}}
            <div class="card card-body bg-blue-400 has-bg-image">
                <div class="media">

                    <div class="mr-3 align-self-center">
                        <i class="icon-unlink2 icon-3x opacity-75"></i>
                    </div>
                    <div class="media-body text-right">
                    <h3 class="mb-0">{{@$farmingProfiles}}</h3>
                        <span class="text-uppercase font-size-xs">Total Farming Profile</span>
                    </div>
                </div>
            </div>
        {{-- </a> --}}
    </div>
    <div class="col-sm-4 col-xl-4">
        {{-- <a href="{{route('field_staff.monthly_farming_report.index')}}"> --}}
            <div class="card card-body bg-danger-400 has-bg-image">
                <div class="media">
                    <div class="mr-3 align-self-center">
                        <i class="icon-stack-picture icon-3x opacity-75"></i>
                    </div>
                    <div class="media-body text-right">
                        <h3 class="mb-0">{{@$monthlyFarmingReports}}</h3>
                        <span class="text-uppercase font-size-xs">Total Monthly Farming Report</span>
                    </div>
                </div>
            </div>
        {{-- </a> --}}
    </div>
    <div class="col-sm-4 col-xl-4">
        {{-- <a href="{{route('field_staff.respondent_master.index')}}"> --}}
            <div class="card card-body bg-orange-400 has-bg-image">
                <div class="media">
                    <div class="media-body">
                        <h3 class="mb-0">{{@$total_respondent_masters}}</h3>
                        <span class="text-uppercase font-size-xs">Total Respondent Master</span>
                    </div>

                    <div class="ml-3 align-self-center">
                        <i class="icon-blog icon-3x opacity-75"></i>
                    </div>
                </div>
            </div>
        {{-- </a> --}}
    </div>
    <div class="col-sm-4 col-xl-4">
        {{-- <a href="{{route('field_staff.training_report.index')}}"> --}}
            <div class="card card-body bg-teal-400 has-bg-image">
                <div class="media">
                    <div class="mr-3 align-self-center">
                        <i class="icon-question4 icon-3x opacity-75"></i>
                    </div>
                    <div class="media-body text-right"> 
                        <h3 class="mb-0">{{@$trainingReports}}</h3>
                        <span class="text-uppercase font-size-xs">Total Training Report</span>
                    </div>

                </div>
            </div>
        {{-- </a> --}}
    </div>
</div>
@endsection
@section('scripts')
@endsection
