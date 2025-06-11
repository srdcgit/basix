@extends('project.layout.index')

@section('title')
    Dashboard
@endsection

<style>
    body {
        background-color: #bdc3c7;
    }

    .container {
        margin-top: -17px;
    }

    .table {
        width: 100%;
        background-color: #f3f3f3;
        border-collapse: collapse;
    }

    .table thead {
        background-color: #f39c12;
        border-color: #e67e22;
    }

    .table thead th {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        background-color: #f39c12;
        color: white;
        z-index: 1;
    }

    .table tbody {
        overflow-y: visible;
    }

    .table thead th,
    .table tbody td {
        width: 20%;
        box-sizing: border-box;
    }

    .table tbody tr {
        width: 100%;
        display: table-row;
    }

    .table tbody td {
        background-color: #f3f3f3;
        border-bottom: 1px solid #ddd;
    }

    .table thead th {
        background-color: #f39c12;
        color: #fff;
        border: 1px solid #e67e22;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table tbody tr:hover {
        background-color: #e1e1e1;
    }
</style>

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <div class="media mb-0">
                    <div class="media-body">
                        <h3 class="font-weight-semibold mb-0 text-center">
                            Project Overview ({{ $project_name }})
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <table class="table table-fixed">
            <thead>
                <tr>
                    <th class="col-xs-3">Name Of District</th>
                    <th class="col-xs-3">No Of Block</th>
                    <th class="col-xs-3">No Of GP</th>
                    <th class="col-xs-3">No Of Village</th>
                    <th class="col-xs-3">No Of Respondents</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($districts as $districtId => $districtName)
                    <tr class="length">
                        <td class="col-xs-3">
                            <span>{{ $districtName }}</span>
                        </td>
                        <td class="col-xs-3">
                            <span>{{ $blocksCount[$districtName] ?? 0 }}</span>
                        </td>
                        <td class="col-xs-3">
                            @php
                                $gpCount = 0;
                                if (isset($gramPanchayatsCount[$districtName])) {
                                    foreach ($gramPanchayatsCount[$districtName] as $blockGpCount) {
                                        $gpCount += $blockGpCount;
                                    }
                                }
                            @endphp
                            <span>{{ $gpCount }}</span>
                        </td>
                        <td class="col-xs-3">
                            @php
                                $villageCount = 0;
                                if (isset($villagesCount[$districtName])) {
                                    foreach ($villagesCount[$districtName] as $blockVillages) {
                                        foreach ($blockVillages as $village) {
                                            $villageCount += $village;
                                        }
                                    }
                                }
                            @endphp
                            <span>{{ $villageCount }}</span>
                        </td>
                        <td class="col-xs-3">
                            <span>{{ $respondentsCount[$districtName] ?? 0 }}</span>
                        </td>
                    </tr>
                @endforeach
                <tr class="font-weight-bold">
                    <td class="col-xs-3">
                        <span>Total</span>
                    </td>
                    <td class="col-xs-3">
                        <span>{{ $totalBlocks }}</span>
                    </td>
                    <td class="col-xs-3">
                        <span>{{ $totalGramPanchayats }}</span>
                    </td>
                    <td class="col-xs-3">
                        <span>{{ $totalVillages }}</span>
                    </td>
                    <td class="col-xs-3">
                        <span>{{ $totalRespondents }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
@endsection
