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
        /* Removes the scroll */
    }

    .table thead th,
    .table tbody td {
        width: 20%;
        /* Adjusted width to evenly distribute columns */
        box-sizing: border-box;
    }

    .table tbody tr {
        width: 100%;
        /* Ensures rows span full width */
        display: table-row;
        /* Resets display to table-row */
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

    /* #gender {
        width: 300px !important;
        height: 300px !important;
    }*/

    /* #education {
        width: 375px !important;
        height: 370px !important;
    } */

    /* #caste {
        width: 300px !important;
        height: 300px !important;
    }  */
</style>
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <div class="media mb-0">
                    <div class="media-body">
                        <h3 class="font-weight-semibold mb-0 text-center">
                            Respondent Dashboard
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h4><b style="color: red;">Geographics Coverage</b></h4>
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
            </tbody>
        </table>
    </div>
    <div class="row mt-3">
        <div class="col-md-4">
            <canvas id="gender"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="education"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="caste"></canvas>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.querySelector('#gender').getContext('2d');

            const genderData = {
                labels: ['Male', 'Female'],
                datasets: [{
                    label: 'Gender Distribution',
                    data: [{{ $male }},
                        {{ $female }}
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 99, 132, 0.7)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            };

            const config = {
                type: 'pie',
                data: genderData,
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Gender',
                            font: {
                                size: 18,
                                weight: 'bold'
                            },
                            padding: {
                                top: 10,
                                bottom: 20
                            }
                        },
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return `${tooltipItem.label}: ${tooltipItem.raw}`;
                                }
                            }
                        }
                    }
                }
            };

            const genderChart = new Chart(ctx, config);
        });
        document.addEventListener("DOMContentLoaded", function() {
            const ctx1 = document.getElementById('education').getContext('2d');

            const educationData = {
                labels: ['Primary', 'Illiterate', 'HSLC', 'Graduate', 'PG', 'Technical Education'],
                datasets: [{
                    label: 'Education Distribution',
                    data: [
                        {{ $education_Primary }},
                        {{ $education_Illiterate }},
                        {{ $education_HSLC }},
                        {{ $education_Graduate }},
                        {{ $education_PG }},
                        {{ $education_Technical }}
                    ],
                    backgroundColor: [
                        'rgba(155, 89, 182, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 205, 86, 0.7)',
                        'rgba(33, 47, 60, 0.7)',
                        'rgba(231, 76, 60, 0.7)',
                        'rgba(54, 162, 235, 0.7)'
                    ],
                    borderColor: [
                        'rgba(155, 89, 182, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(33, 47, 60, 1)',
                        'rgba(231, 76, 60, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            };

            const config = {
                type: 'pie',
                data: educationData,
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Education',
                            font: {
                                size: 18,
                                weight: 'bold'
                            },
                            padding: {
                                top: 10,
                                bottom: 20
                            }
                        },
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return `${tooltipItem.label}: ${tooltipItem.raw}`;
                                }
                            }
                        }
                    }
                }
            };
            const educationChart = new Chart(ctx1, config);
        });
        document.addEventListener("DOMContentLoaded", function() {
            const ctx2 = document.getElementById('caste').getContext('2d');

            const casteData = {
                labels: ['General', 'ST', 'OBC', 'SC'],
                datasets: [{
                    label: 'Caste Distribution',
                    data: [
                        {{ $caste_general }},
                        {{ $caste_st }},
                        {{ $caste_obc }},
                        {{ $caste_sc }}
                    ],
                    backgroundColor: [
                        'rgba(203, 67, 53, 0.7)',
                        'rgba(41, 128, 185, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)'
                    ],
                    borderColor: [
                        'rgba(203, 67, 53, 1)',
                        'rgba(41, 128, 185, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            };

            const config = {
                type: 'pie',
                data: casteData,
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Caste',
                            font: {
                                size: 18,
                                weight: 'bold'
                            },
                            padding: {
                                top: 10,
                                bottom: 20
                            }
                        },
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return `${tooltipItem.label}: ${tooltipItem.raw}`;
                                }
                            }
                        }
                    }
                }
            };

            const casteChart = new Chart(ctx2, config);
        });
    </script>
@endsection
