@extends('field_staff.layout.index')

@section('title')
    Respondent Master
@endsection
@section('content')
    <div class="card">

        <div class="card-header header-elements-inline">
            <h5 class="card-title">Respondent Master List</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a href="{{ route('field_staff.respondent_master.create') }}" class="btn btn-primary text-right">Add New
                        Respondent Master Form</a>
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table datatable-save-state">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Block Name</th>
                            <th>District Name</th>
                            <th>Gram Panchyat Name</th>
                            <th>Village Name</th>
                            <th>Is Validate</th>
                            <th>Action</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($respondentMasters as $key => $respondent_master)
                            <tr>
                                <td>{{ @$respondent_master->farmer_id }}</td>
                                <td>{{ $respondent_master->name }}</td>
                                <td>{{ App\Helpers\Helpers::getBlockName(@$respondent_master->block_id) }}</td>
                                <td>{{ @$respondent_master->district->name }}</td>
                                <td>{{ App\Helpers\Helpers::getGPName(@$respondent_master->gram_panchyat_id) }}</td>
                                <td>{{ App\Helpers\Helpers::getVillageName(@$respondent_master->village_id) }}</td>
                                <td>
                                    @if ($respondent_master->is_validate)
                                        <span class="badge badge-success">Yes</span>
                                    @else
                                        <span class="badge badge-danger">No</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($respondent_master->is_validate)
                                        <a href="{{ route('field_staff.respondent_master.un_validate', $respondent_master->id) }}"
                                            class="btn btn-xs btn-danger">Un-validate</a>
                                    @else
                                        <a href="{{ route('field_staff.respondent_master.validate', $respondent_master->id) }}"
                                            class="btn btn-xs btn-success">Validate</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('field_staff.respondent_master.edit', $respondent_master->id) }}"
                                        class="btn btn-primary btn-sm">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection