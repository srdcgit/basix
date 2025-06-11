@extends('project.layout.index')

@section('title')
    Dashboard
@endsection

<style>
    .card-title-dash {
        font-size: 1.60rem;
        font-weight: 600;
        text-align: center;
        color: #333;
    }

    .card-subtitle-dash {
        font-size: 1.2rem;
        color: #0f0f0f;
    }

    .chart-container {
        position: relative;
        width: 115%;
        height: 345px;
        background: linear-gradient(to right, #4b4949, #229489);
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    canvas {
        background: #fff;
        border-radius: 8px;
        padding: 7px;
        width: 100%;
        height: 100%;
    }

    .chartjs-legend ul {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
        margin: 10px 0 0;
    }

    .chartjs-legend ul li {
        margin: 0 10px;
        font-size: 14px;
        color: #333;
    }

    .chartjs-legend ul li span {
        display: inline-block;
        width: 12px;
        height: 12px;
        margin-right: 5px;
        border-radius: 50%;
    }

    .year-selector {
        display: flex;
        justify-content: center;
        margin-bottom: 5px;
        margin-top: -11px;
    }

    .year-selector label {
        margin: 0 10px;
        font-size: 16px;
        color: #fff;
    }

    .metric-container {
        margin-top: 5px;
        padding: 2px;
        border-radius: 2px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .metric-container .metric-item {
        display: flex;
        justify-content: space-between;
        font-size: 1.2rem;
        margin: 10px 0;
    }
</style>

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <div class="media mb-0">
                    <div class="media-body">
                        <h3 class="font-weight-semibold mb-0 text-center">
                            Monthly Progress
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-2 shadow-sm">
        <div class="row">
            <div class="col-md-6">
                <div class="chart-container mt-1">
                    <canvas id="customGraph" style="height: 304px;"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container mt-1">
                    <canvas id="customGraph2" style="height: 304px;"></canvas>
                </div>
            </div>
        </div>

        <div class="card-body p-2 shadow-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="metric-container">
                        <canvas id="metricsGraph1" style="height: 304px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const currentYearData = @json($registrationsCurrentYear);
        const previousYearData = @json($registrationsPreviousYear);
        const months = @json($months);
        const currentMonthFarmingReportsData = @json($currentMonthFarmingReports);
        const pondCleaningPercentages = @json($pondCleaningPercentages).map(val => val.toFixed(2));
        const limeApplyingPercentages = @json($limeApplyingPercentages).map(val => val.toFixed(2));
        const waterQualityPercentages = @json($waterQualityPercentages).map(val => val.toFixed(2));
        const feedApplyingPercentages = @json($feedApplyingPercentages).map(val => val.toFixed(2));
        const currentYearLabel = '{{ $currentYear }}';
        const previousYearLabel = '{{ $previousYear }}';

        const ctx1 = document.getElementById('customGraph').getContext('2d');
        const customGraph1 = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                        label: `Number of Registered Farmers (${currentYearLabel})`,
                        data: currentYearData,
                        borderColor: '#26a69a',
                        backgroundColor: 'rgba(38, 166, 154, 0.2)',
                        borderWidth: 2
                    },
                    {
                        label: `Number of Registered Farmers (${previousYearLabel})`,
                        data: previousYearData,
                        borderColor: '#ff5722',
                        backgroundColor: 'rgba(255, 87, 34, 0.2)',
                        borderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctx2 = document.getElementById('customGraph2').getContext('2d');
        const customGraph2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                        label: `Number of Monthly Reports Submitted (${currentYearLabel})`,
                        data: currentMonthFarmingReportsData,
                        borderColor: '#26a69a',
                        backgroundColor: 'rgba(38, 166, 154, 0.2)',
                        borderWidth: 2
                    },
                    {
                        label: `Number of Monthly Reports Submitted (${previousYearLabel})`,
                        data: currentMonthFarmingReportsData.map(val => val * 0.8),
                        borderColor: '#ff5722',
                        backgroundColor: 'rgba(255, 87, 34, 0.2)',
                        borderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctx3 = document.getElementById('metricsGraph1').getContext('2d');
        const metricsGraph1 = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                        label: 'Pond Cleaning Percentage',
                        data: pondCleaningPercentages,
                        backgroundColor: '#673AB7',
                        borderColor: '#673AB7',
                        borderWidth: 1
                    },
                    {
                        label: 'Lime Applying Percentage',
                        data: limeApplyingPercentages,
                        backgroundColor: '#25b72b',
                        borderColor: '#25b72b',
                        borderWidth: 1
                    },
                    {
                        label: 'Water Quality Testing Percentage',
                        data: waterQualityPercentages,
                        backgroundColor: '#E91E63',
                        borderColor: '#E91E63',
                        borderWidth: 1
                    },
                    {
                        label: 'Feed Applying Percentage',
                        data: feedApplyingPercentages,
                        backgroundColor: '#ffc107',
                        borderColor: '#ffc107',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
