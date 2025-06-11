@extends('project.layout.index')

@section('title')
    Dashboard
@endsection
<style>
    body {
        background-color: #bdc3c7;
    }

    .table {
        width: 100%;
        background-color: #f3f3f3;
        border-collapse: collapse;
    }

    .table thead {
        background-color: #ebb867;
        border-color: #ebb867;
    }

    .table thead th {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        background-color: #ebb867;
        color: rgb(15, 15, 15);
        z-index: 1;
    }

    .table tbody {
        display: block;
        height: 200px;
        overflow-y: auto;
    }

    .table thead,
    .table tbody tr {
        display: table;
        width: 100%;
        table-layout: fixed;
    }

    .table tbody td {
        background-color: #f3f3f3;
        border-bottom: 1px solid #ddd;
        box-sizing: border-box;
        width: 25%;
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
                        <h2 class="font-weight-semibold mb-0 text-center">
                            Project HR Dashboard
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div
            style="width: 100%; max-width: 350px; margin: 0 auto; border: 1px solid #797676; border-radius: 8px; box-shadow: 0 4px 8px rgba(114, 112, 112, 0.1);">
            <div
                style="display: flex; justify-content: space-between; padding: 15px; border-bottom: 1px solid #797676; font-size: 15px; font-weight: bold; color: #2a2727;background-color: #f3d6a8;">
                <span>No of SMS Enrolled</span>
                <span>{{ $executives }}</span>
            </div>
            <div
                style="display: flex; justify-content: space-between; padding: 15px; border-bottom: 1px solid #797676; font-size: 15px; font-weight: bold; color: #2a2727;background-color: #f3d6a8;">
                <span>No of CC Enrolled</span>
                <span>{{ $field_staff }}</span>
            </div>
            <div
                style="display: flex; justify-content: space-between; padding: 15px; font-size: 15px; font-weight: bold; color: #2a2727;background-color: #f3d6a8;">
                <span>No of CRP Enrolled</span>
                <span>{{ $crp }}</span>
            </div>
        </div>
    </div>

    <div class="container mt-2">
        <table class="table table-fixed">
            <thead>
                <tr>
                    <th class="col-xs-3">Project Manager</th>
                    <th class="col-xs-3">SMS</th>
                    <th class="col-xs-3">CC</th>
                    <th class="col-xs-3">CRP</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $maxRows = max(count($executives_names), count($field_staff_names), count($crp_names));
                @endphp

                @for ($i = 0; $i < $maxRows; $i++)
                    <tr>
                        <td class="col-xs-3">
                            @if ($i === 0)
                                {{ Auth::user()->name }}
                            @endif
                        </td>
                        <td class="col-xs-3">{{ $executives_names[$i] ?? '' }}</td>
                        <td class="col-xs-3">{{ $field_staff_names[$i] ?? '' }}</td>
                        <td class="col-xs-3">{{ $crp_names[$i] ?? '' }}</td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
@endsection
