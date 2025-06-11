@extends('project.layout.index')
@section('title')
    {{ $training_report->name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Simple View Layout -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><span style="color: red">{{ $training_report->name }}</span></h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12 text-center">
                            <img src="{{asset($training_report->image)}}" height="300" width="450" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <strong>Date of Event:</strong> {{ $training_report->date_of_event }}
                        </div>
                        <div class="col-md-4 mb-3">
                            <strong>Geo Location:</strong> {{ $training_report->geo_location }}
                        </div>
                        <div class="col-md-4 mb-3">
                            <strong>Level of Training:</strong> {{ $training_report->level_of_training }}
                        </div>                        
                        @if($training_report->level_of_training == 'Village')
                            <div class="col-md-4 mb-3">
                                <strong>Village Name:</strong> {{ $training_report->village->name ?? 'N/A' }}
                            </div>
                        @endif
                        
                        @if($training_report->level_of_training == 'Block')
                            <div class="col-md-4 mb-3">
                                <strong>Block Name:</strong> {{ $training_report->block->name ?? 'N/A' }}
                            </div>
                        @endif
                        
                        @if($training_report->level_of_training == 'District')
                            <div class="col-md-4 mb-3">
                                <strong>District Name:</strong> {{ $training_report->district->name ?? 'N/A' }}
                            </div>
                        @endif
                        
                        @if($training_report->level_of_training == 'State')
                            <div class="col-md-4 mb-3">
                                <strong>State Name:</strong> {{ $training_report->state->name ?? 'N/A' }}
                            </div>
                        @endif

                        <div class="col-md-4 mb-3">
                            <strong>Type:</strong> {{ $training_report->type }}
                        </div>
                        <div class="col-md-4 mb-3">
                            <strong>Facilitator Name:</strong> {{ $training_report->facilitator_name }}
                        </div>
                        <div class="col-md-4 mb-3">
                            <strong>Co-Facilitator Name:</strong>
                            {{ $training_report->is_co_facilitator_name ? $training_report->co_facilitator_name : 'N/A' }}
                        </div>
                        <div class="col-md-4 mb-3">
                            <strong>Objective:</strong> {{ $training_report->objective }}
                        </div>
                        <div class="col-md-4 mb-3">
                            <strong>Type of Participants:</strong> {{ $training_report->type_of_participants }}
                        </div>
                        <div class="col-md-4 mb-3">
                            <strong>Number of Participants:</strong> {{ $training_report->number_of_participants }}
                        </div>
                        <div class="col-md-4 mb-3">
                            <strong>Number of Male Participants:</strong> {{ $training_report->number_of_male }}
                        </div>
                        <div class="col-md-4 mb-3">
                            <strong>Number of Female Participants:</strong> {{ $training_report->number_of_female }}
                        </div>
                        <div class="col-md-4 mb-3">
                            <strong>User:</strong> {{ $training_report->user->name ?? 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
