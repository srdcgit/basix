@extends('project.layout.index')
@section('title')
    Manage Respondent Master Form
@endsection

@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Manage Respondent Master Form</h5>           
            <a href="{{ route('project.report.export', request()->query()) }}" class="btn btn-danger">Export</a>           
        </div>      
        <div class="card-body">
            <form id="filterForm">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="district">District</label>
                            <select name="district_id" id="district" class="form-control">
                                <option value="">Select District</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}"
                                        {{ request('district_id') == $district->id ? 'selected' : '' }}>
                                        {{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="block">Block</label>
                            <select name="block_id" id="block" class="form-control">
                                <option value="">Select Block</option>
                                @foreach ($blocks as $block)
                                    <option value="{{ $block->id }}"
                                        {{ request('block_id') == $block->id ? 'selected' : '' }}>
                                        {{ $block->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="gram_panchyat">Gram Panchyat</label>
                            <select name="gram_panchyat_id" id="gram_panchyat" class="form-control">
                                <option value="">Select Gram Panchyat</option>
                                @foreach ($gramPanchyats as $gramPanchyat)
                                    <option value="{{ $gramPanchyat->id }}"
                                        {{ request('gram_panchyat_id') == $gramPanchyat->id ? 'selected' : '' }}>
                                        {{ $gramPanchyat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="village">Village</label>
                            <select name="village_id" id="village" class="form-control">
                                <option value="">Select Village</option>
                                @foreach ($villages as $village)
                                    <option value="{{ $village->id }}"
                                        {{ request('village_id') == $village->id ? 'selected' : '' }}>
                                        {{ $village->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>                   
            <table class="table datatable-save-state mt-3" id="respondentTable">
                <thead>
                    <tr>
                        <th>Farmer ID</th>
                        <th>Name</th>
                        <th>District</th>
                        <th>Block</th>
                        <th>Gram Panchyat</th>
                        <th>Village</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($respondent_masters as $respondent_master)
                        <tr>
                            <td>{{ @$respondent_master->farmer_id }}</td>
                            <td>{{ $respondent_master->name }}</td>
                            <td>{{ @$respondent_master->district->name }}</td>
                            <td>{{ @$respondent_master->block->name }}</td>
                            <td>{{ @$respondent_master->gram_panchyat->name }}</td>
                            <td>{{ @$respondent_master->village->name }}</td>
                            <td>
                                <a href="{{ route('project.report.respondent_master_view', $respondent_master->id) }}"
                                    class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#district').change(function() {
                let district_id = $(this).val();
                if (district_id) {
                    $.ajax({
                        url: "{{ route('project.report.get_blocks', '') }}/" + district_id,
                        method: "GET",
                        success: function(blocks) {
                            $('#block').html('<option value="">Select Block</option>');
                            $.each(blocks, function(key, block) {
                                $('#block').append('<option value="' + block.id + '">' +
                                    block.name + '</option>');
                            });
                        }
                    });
                    $('#gram_panchyat').html('<option value="">Select Gram Panchyat</option>');
                    $('#village').html('<option value="">Select Village</option>');
                } else {
                    $('#block').html('<option value="">Select Block</option>');
                    $('#gram_panchyat').html('<option value="">Select Gram Panchyat</option>');
                    $('#village').html('<option value="">Select Village</option>');
                }
                $('#filterForm').submit();
            });

            $('#block').change(function() {
                let block_id = $(this).val();
                if (block_id) {
                    $.ajax({
                        url: "{{ route('project.report.get_gram_panchyats', '') }}/" + block_id,
                        method: "GET",
                        success: function(gramPanchyats) {
                            $('#gram_panchyat').html('<option value="">Select Gram Panchyat</option>');
                            $.each(gramPanchyats, function(key, gramPanchyat) {
                                $('#gram_panchyat').append('<option value="' + gramPanchyat.id + '">' +
                                    gramPanchyat.name + '</option>');
                            });
                        }
                    });
                    $('#village').html('<option value="">Select Village</option>');
                } else {
                    $('#gram_panchyat').html('<option value="">Select Gram Panchyat</option>');
                    $('#village').html('<option value="">Select Village</option>');
                }
                $('#filterForm').submit();
            });

            $('#gram_panchyat').change(function() {
                let gram_panchyat_id = $(this).val();
                if (gram_panchyat_id) {
                    $.ajax({
                        url: "{{ route('project.report.get_villages', '') }}/" + gram_panchyat_id,
                        method: "GET",
                        success: function(villages) {
                            $('#village').html('<option value="">Select Village</option>');
                            $.each(villages, function(key, village) {
                                $('#village').append('<option value="' + village.id + '">' +
                                    village.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#village').html('<option value="">Select Village</option>');
                }
                $('#filterForm').submit();
            });

            $('#village').change(function() {
                $('#filterForm').submit();
            });
        });
    </script>
@endsection
