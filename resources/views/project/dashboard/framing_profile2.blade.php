@extends('project.layout.index')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <div class="media mb-0">
                    <div class="media-body">
                        <h2 class="font-weight-semibold mb-0 text-center">
                            Farmers Profile2
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <canvas id="stockingManagement"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="trainingExposure"></canvas>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <canvas id="annualProduction"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="annualIncome"></canvas>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var ctx = document.getElementById('stockingManagement').getContext('2d');
        var stockingManagementChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Water pH Regularly', 'Feeding Regularly', 'Cow Dung Regularly', 'Lime Regularly'],
                datasets: [{
                    label: 'Stocking Management',
                    data: [
                        {{ $water_ph_regularly }},
                        {{ $feeding_regularly }},
                        {{ $regularly_cow_dung }},
                        {{ $regularly_apply_lime }}
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(153, 102, 255, 0.6)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1,
                    barThickness: 22
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 16
                            }
                        }
                    }
                },
            }
        });
        var ctx1 = document.getElementById('trainingExposure').getContext('2d');
        var trainingExposureChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['Attend Training', 'Attend Exposure'],
                datasets: [{
                    label: 'Training and Exposure',
                    data: [
                        {{ $training }},
                        {{ $exposure }}
                    ],
                    backgroundColor: [
                        'rgba(185, 50, 41, 0.6)',
                        'rgba(93, 109, 126, 0.6)'
                    ],
                    borderColor: [
                        'rgba(185, 50, 41, 1)',
                        'rgba(93, 109, 126, 1)'
                    ],
                    borderWidth: 1,
                    barThickness: 22
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 16
                            }
                        }
                    }
                },
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            var ctx2 = document.getElementById('annualProduction').getContext('2d');

            var labels2 = @json($averageFishQuantities->pluck('year'));
            var data2 = @json($averageFishQuantities->pluck('avg_quantity'));

            var annualProductionChart = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: labels2,
                    datasets: [{
                        label: 'Average Annual Production',
                        data: data2,
                        backgroundColor: [
                            'rgba(186, 74, 0 , 0.6)',
                            'rgba(222, 49, 99, 0.6)'
                        ],
                        borderColor: [
                            'rgba(186, 74, 0 , 1)',
                            'rgba(222, 49, 99, 1)'
                        ],
                        borderWidth: 1,
                        barThickness: 25
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                font: {
                                    size: 16
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    var formattedValue = tooltipItem.raw.toFixed(2);
                                    return `Avg Annual Production: ${formattedValue}`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Year'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true
                            }
                        }
                    }
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var ctx3 = document.getElementById('annualIncome').getContext('2d');

            var labels3 = @json($averageFishAmounts->pluck('year'));
            var data3 = @json($averageFishAmounts->pluck('avg_amount'));

            var annualIncomeChart = new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: labels3,
                    datasets: [{
                        label: 'Average Annual Income',
                        data: data3,
                        backgroundColor: [
                            'rgba(52, 185, 41, 0.6)',
                            'rgba(161, 41, 185, 0.6)'
                        ],
                        borderColor: [
                            'rgba(52, 185, 41, 1)',
                            'rgba(161, 41, 185, 1)'
                        ],
                        borderWidth: 1,
                        barThickness: 25
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                font: {
                                    size: 16
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    var formattedValue = tooltipItem.raw.toFixed(2);
                                    return `Avg Annual Income: ${formattedValue}`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Year'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
