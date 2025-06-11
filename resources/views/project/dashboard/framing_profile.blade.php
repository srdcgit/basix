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
                            Farmers Profile
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <canvas id="farmingProfileChart1" style="width: 100%; height: 280px !important;"></canvas>
        </div>
        <div class="col-md-3">
            <canvas id="involvementInFisheryChart"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="waterbody" style="width: 100%; height: 270px !important;"></canvas>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-4">
            <canvas id="equipments" style="width: 100%; height: 270px !important;"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="preStockingManagement" style="width: 100%; height: 290px !important;"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="stockingOfFish" style="width: 100%; height: 290px !important;"></canvas>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Farming Profile Chart
        var farmingLabels = ['KCC Account', 'Bank Account', 'MGNREGA Card', 'BPL No', 'PG Member', 'SHG Member'];
        var farmingData = [
            {{ $kcc_account }},
            {{ $bank_account }},
            {{ $mgnrega_card }},
            {{ $bpl_no }},
            {{ $pb_member }},
            {{ $shg_member }}
        ];

        var ctx1 = document.getElementById('farmingProfileChart1').getContext('2d');
        var farmingProfileChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: farmingLabels,
                datasets: [{
                    label: 'Farmers Profile',
                    data: farmingData,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(243, 15, 122 , 0.4)',
                        'rgba(120, 66, 18, 0.5)',
                        'rgba(16, 53, 70, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.6)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 2)',
                        'rgba(243, 15, 122 , 2)',
                        'rgba(120, 66, 18, 2)',
                        'rgba(16, 53, 70, 2)',
                        'rgba(153, 102, 255, 2)',
                        'rgba(255, 159, 64, 2)'
                    ],
                    borderWidth: 1,
                    barThickness: 20
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
                                size: 18
                            },
                            color: '#333'
                        }
                    }
                }
            }
        });

        // Involvement in Fishery Chart
        var ctx2 = document.getElementById('involvementInFisheryChart').getContext('2d');
        var involvementInFisheryChart = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Nursery Farmer', 'Grower', 'Both'],
                datasets: [{
                    label: 'Involvement in Fishery',
                    data: [
                        {{ $nursery_farmer }},
                        {{ $grower }},
                        {{ $both_count }}
                    ],
                    backgroundColor: [
                        'rgba(50, 171, 187, 0.5)',
                        'rgba(249, 71, 249, 0.5)',
                        'rgba(0, 0, 255, 0.6)'
                    ],
                    borderColor: [
                        'rgba(50, 171, 187, 1)',
                        'rgba(249, 71, 249, 1)',
                        'rgba(0, 0, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 14,
                            },
                            color: '#333'
                        }
                    },
                    title: {
                        display: true,
                        text: 'Involvement in Fishery',
                        font: {
                            size: 16,
                        },
                        color: '#333'
                    }
                }
            }
        });

        // Waterbody Chart
        var ctx3 = document.getElementById('waterbody').getContext('2d');
        var waterbodyChart = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: ['Total Water Body', 'Lease Out', 'Lease In', 'Own Water Body'],
                datasets: [{
                    label: 'Water Body',
                    data: [
                        {{ $totalWaterBody }},
                        {{ $lease_out }},
                        {{ $lease_in }},
                        {{ $own_water }}
                    ],
                    backgroundColor: [
                        'rgba(79, 234, 21, 0.4)',
                        'rgba(255, 159, 64, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(207, 30, 17, 0.6)'
                    ],
                    borderColor: [
                        'rgba(79, 234, 21 , 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(207, 30, 17, 1)'
                    ],
                    borderWidth: 1,
                    barThickness: 20
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
                                size: 18
                            },
                            color: '#333'
                        }
                    }
                }
            }
        });

        // Equipments Chart
        var ctx4 = document.getElementById('equipments').getContext('2d');
        var equipmentsChart = new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: ['Aereator', 'Fishing Net', 'Tube Well', 'Pump Set'],
                datasets: [{
                    label: 'Equipments',
                    data: [
                        {{ $aereator }},
                        {{ $fishing_net }},
                        {{ $tube_well }},
                        {{ $pump_set }}
                    ],
                    backgroundColor: [
                        'rgba(145, 16, 240, 0.4)',
                        'rgba(16, 227, 240, 0.5)',
                        'rgba(34, 139, 34, 0.6)',
                        'rgba(245, 176, 65, 0.7)',
                    ],
                    borderColor: [
                        'rgba(145, 16, 240, 1)',
                        'rgba(16, 227, 240, 1)',
                        'rgba(34, 139, 34, 1)',
                        'rgba(245, 176, 65, 1)',
                    ],
                    borderWidth: 1,
                    barThickness: 20
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
                                size: 18
                            },
                            color: '#333'
                        }
                    }
                }
            }
        });

        // Pre-Stocking Management Chart
        var ctx5 = document.getElementById('preStockingManagement').getContext('2d');
        var preStockingManagementChart = new Chart(ctx5, {
            type: 'bar',
            data: {
                labels: ['Applied Cow Dung ', 'Applied Lime', 'Remove Black Soil', 'Pond Cleaning'],
                datasets: [{
                    label: 'Pre-Stocking Management',
                    data: [
                        {{ $cow_dung }},
                        {{ $applied_lime }},
                        {{ $black_soil }},
                        {{ $pond_preparation }}
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(93, 109, 126, 0.6)',
                        'rgba(203, 67, 53, 0.6)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(93, 109, 126, 1)',
                        'rgba(203, 67, 53, 1)'
                    ],
                    borderWidth: 1,
                    barThickness: 20
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
                                size: 18
                            },
                            color: '#333'
                        }
                    }
                }
            }
        });

        //stocking the fish
        document.addEventListener('DOMContentLoaded', function() {
            var percentages = @json($percentages);

            console.log('Percentages Data:', percentages);

            var years = ['2023', '2024']; // Specify the years you want to show
            var fingerlingsData = years.map(year => percentages[year]?.percentage_figerlings || 0);
            var yearlingsData = years.map(year => percentages[year]?.percentage_yearlings || 0);

            var ctx = document.getElementById('stockingOfFish').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: years,
                    datasets: [{
                            label: 'Fingerlings',
                            data: fingerlingsData,
                            backgroundColor: 'rgba(53, 89, 203, 0.6)',
                            borderColor: 'rgba(53, 89, 203, 1)',
                            borderWidth: 1,
                            barThickness: 20
                        },
                        {
                            label: 'Yearlings',
                            data: yearlingsData,
                            backgroundColor: 'rgba(203, 53, 155, 0.6)',
                            borderColor: 'rgba(203, 53, 155, 1)',
                            borderWidth: 1,
                            barThickness: 20
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: {
                                    size: 14
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: 'Stocking of Fish',
                            font: {
                                size: 16
                            },
                            padding: {
                                bottom: 10
                            }
                        }
                    },
                    scales: {
                        x: {
                            stacked: false, // Make sure bars are not stacked
                            title: {
                                display: true,
                                text: 'Year',
                                font: {
                                    size: 14
                                }
                            }
                        },
                        y: {
                            stacked: false, // Make sure bars are not stacked
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Percentage',
                                font: {
                                    size: 14
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
