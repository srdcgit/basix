@extends('project.layout.index')

@section('title')
    Dashboard
@endsection
<style>
    .year-selector {
        display: flex;
        justify-content: center;
        margin-bottom: -13px;
        margin-top: -9px;
    }

     #levelOfTraining {
        width: 340px !important;
        height: 350px !important;
    }

    /* #typeOfTraining {
        width: 310px !important;
        height: 310px !important;
    }

    #typeOfParticipants {
        width: 290px !important;
        height: 290px !important;
    }  */
</style>

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <div class="media mb-0">
                    <div class="media-body">
                        <h3 class="font-weight-semibold mb-0 text-center">
                            Monthly Training
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="year-selector">
                <label>
                    <input type="radio" name="year" id="year2023" value="2023" checked> 2023
                </label>
                <label>
                    <input type="radio" name="year" id="year2024" value="2024"> 2024
                </label>
            </div>
            <canvas id="monthlyTraining" style="width: 100%; height: 300px !important;"></canvas>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-4">
            <canvas id="levelOfTraining"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="typeOfTraining"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="typeOfParticipants"></canvas>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        //monthlyTraining
        const monthlyData = @json($monthlyData);
        const monthNames = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        function updateChart(year) {
            const filteredData = monthlyData.filter(data => data.year === year);

            const maleData = new Array(12).fill(0);
            const femaleData = new Array(12).fill(0);
            const totalData = new Array(12).fill(0);

            filteredData.forEach(data => {
                const monthIndex = data.month - 1;
                maleData[monthIndex] = data.total_male;
                femaleData[monthIndex] = data.total_female;
                totalData[monthIndex] = data.total_participants;
            });

            chart.data.labels = monthNames;
            chart.data.datasets[0].data = maleData;
            chart.data.datasets[1].data = femaleData;
            chart.data.datasets[2].data = totalData;
            chart.update();
        }
        const ctx = document.getElementById('monthlyTraining').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: monthNames,
                datasets: [{
                        label: 'Male',
                        data: new Array(12).fill(0),
                        backgroundColor: 'rgba(255, 99, 132)',
                        borderColor: 'rgba(255, 99, 132, 2)',
                        borderWidth: 1
                    },
                    {
                        label: 'Female',
                        data: new Array(12).fill(0),
                        backgroundColor: 'rgba(211, 84, 0, 0.7)',
                        borderColor: 'rgba(211, 84, 0, 2)',
                        borderWidth: 1
                    },
                    {
                        label: 'Total Participants',
                        data: new Array(12).fill(0),
                        backgroundColor: 'rgba(125, 60, 152, 0.7)',
                        borderColor: 'rgba(125, 60, 152, 2)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += context.parsed.y;
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
        document.getElementById('year2023').addEventListener('change', function() {
            updateChart(2023);
        });

        document.getElementById('year2024').addEventListener('change', function() {
            updateChart(2024);
        });
        updateChart(2023);

        //levelOfTraining
        const villageCount = @json($village);
        const districtCount = @json($district);
        const blockCount = @json($block);
        const ctx1 = document.getElementById('levelOfTraining').getContext('2d');
        new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: ['Village', 'District', 'Block'],
                datasets: [{
                    label: 'Levels of Training',
                    data: [villageCount, districtCount, blockCount],
                    backgroundColor: [
                        'rgba(212, 172, 13, 0.6)',
                        'rgba(33, 47, 61, 0.7)',
                        'rgba(176, 58, 46, 0.7)'
                    ],
                    borderColor: [
                        'rgba(212, 172, 13, 2)',
                        'rgba(33, 47, 61, 1)',
                        'rgba(176, 58, 46, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.raw !== null) {
                                    label += context.raw;
                                }
                                return label;
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Level of Training',
                        font: {
                            size: 18,
                            weight: 'bold'
                        },
                        color: '#333'
                    }
                }
            }
        });
        // typeOfTraining
        const workshopCount = @json($workshop);
        const trainingCount = @json($training);
        const othersCount = @json($others);
        const exposureCount = @json($exposure);
        const conceptSeedingCount = @json($conceptSeeding);
        const ctx2 = document.getElementById('typeOfTraining').getContext('2d');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Workshop', 'Training', 'Others', 'Exposure', 'Concept Seeding'],
                datasets: [{
                    label: 'Type of Training',
                    data: [workshopCount, trainingCount, othersCount, exposureCount, conceptSeedingCount],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(33, 47, 61, 0.8)',
                        'rgba(153, 102, 255, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(33, 47, 61, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.raw !== null) {
                                    label += context.raw;
                                }
                                return label;
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Type of Training',
                        font: {
                            size: 16,
                            weight: 'bold'
                        },
                        color: '#333'
                    }
                }
            }
        });
        // Type of Participants 
        const farmerCount = @json($farmer);
        const boDCount = @json($boD);
        const fPOStaffCount = @json($fPOStaff);
        const govtStaffCount = @json($govtStaff);

        const ctx3 = document.getElementById('typeOfParticipants').getContext('2d');
        new Chart(ctx3, {
            type: 'pie',
            data: {
                labels: ['Farmer', 'BoD', 'FPO Staff', 'Govt Staff'],
                datasets: [{
                    label: 'Type of Participants',
                    data: [farmerCount, boDCount, fPOStaffCount, govtStaffCount],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(52, 73, 94, 0.6)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(52, 73, 94, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                const label = tooltipItem.label || '';
                                const value = tooltipItem.raw || '';
                                return `${label}: ${value}`;
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Type of Participants',
                        font: {
                            size: 16,
                            weight: 'bold'
                        },
                        color: '#333'
                    }
                }
            }
        });
    </script>
@endsection
