@extends('project.layout.index')
@section('title')
   View Respondent Master
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Simple View Layout -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Respondent Profile: <span style="color: red">{{$respondentMasterview->name}}</span></h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <strong>Farmer ID:</strong> {{$respondentMasterview->farmer_id}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Age:</strong> {{$respondentMasterview->age}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Gender:</strong> {{$respondentMasterview->gender}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>District:</strong> {{$respondentMasterview->district->name}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Block:</strong> {{$respondentMasterview->block->name}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Gram Panchyat:</strong> {{$respondentMasterview->gram_panchyat->name}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Village:</strong> {{$respondentMasterview->village->name}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Education:</strong> {{$respondentMasterview->education}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Number of Family Members:</strong> {{$respondentMasterview->number_family_member}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Caste:</strong> {{$respondentMasterview->caste}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Religion:</strong> {{$respondentMasterview->religion}}
                    </div>
                    <div class="col-md-12 mb-3">
                        <strong>Image:</strong> 
                        @if($respondentMasterview->image)
                            <a href="{{asset($respondentMasterview->image)}}" target="_blank">View Image</a>
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
