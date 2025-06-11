@extends('project.layout.index')
@section('title')
    Manage Farming Profile
@endsection

@section('content')
    <div class="card">

        <div class="card-header header-elements-inline">
            <h5 class="card-title">Manage Farming Profile</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table datatable-save-state">
                <thead>
                    <tr>
                        <th>Sl.No</th>
                        <th>Farmer Name</th>
                        <th>SHG Member</th>
                        <th>Total Annual Income</th>
                        <th>Annual Income From Fishery</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (App\Models\FarmingProfile::all() as $key => $farming_profile)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ @$farming_profile->respondent_master->name . '(' . @$farming_profile->respondent_master->farmer_id . ')' }}
                            </td>
                            <td>{{ $farming_profile->shg_member ? 'Yes' : 'No' }}</td>
                            <td>{{ $farming_profile->total_annual_income }}</td>
                            <td>{{ $farming_profile->total_annual_income_from_fishery }}</td>
                            <td>
                                <a href="{{ route('project.framing.profileView',$farming_profile->id) }}" class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
@section('scripts')
@endsection
