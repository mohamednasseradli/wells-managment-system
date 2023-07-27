<x-header title="Admin Dashboard | users" />

{{-- Toggle Sidebar icon --}}
<div class="toggle-sidebar">
    <i class="fa-solid fa-bars fa-lg"></i>
</div>
<div class="admin-dashboard container-fluid " style="min-height: 100vh">
    <div class="row">
        <div class="col-lg-1 col-md-12 sidebar-container">
            <x-admin-sidebar />
        </div>
        <div class="col-lg-9 col-md-12 container p-4 pt-5">
            {{-- <h1 class="text-start mb-3">Dashboard</h1> --}}
            {{-- Success --}}
            <x-success />
            {{-- Failure --}}
            <x-failure />
            <div class="row border-bottom py-3 my-3 text-center">
                <div class="col-md-3 mb-3">
                    <div class="widget shadow  text-white fs-3 fw-bold rounded-3 p-2">
                        <span class="d-block">
                            Areas
                        </span>
                        <span class="d-block">
                            {{ $areas->count() }}
                        </span>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="widget shadow text-white fs-3 fw-bold rounded-3 p-2">
                        <span class="d-block">
                            Trunks
                        </span>
                        <span class="d-block">
                            {{ $trunks }}
                        </span>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="widget shadow text-white fs-3 fw-bold rounded-3 p-2">
                        <span class="d-block">
                            Wells
                        </span>
                        <span class="d-block">
                            {{ $wells }}
                        </span>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="widget shadow text-white fs-3 fw-bold rounded-3 p-2">
                        <span class="d-block">
                            Receivers
                        </span>
                        <span class="d-block">
                            {{ $wells }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- Trunks Graph --}}
                @php
                    // $latestTrunks = DB::table('trunks')->latest('id')->take(5)->get();
                    // $latestTrunks = Trunk::latest('id')->take(5)->get();

                @endphp
                <div class="col-md-8 my-3">
                    <h4 class="fw-bold text-muted mb-3">Latest Added Trunks</h4>
                    @foreach ($latestTrunks as $trunk)
                    <div class="d-flex flex-row align-items-center justify-content-between rounded-4 shadow py-4 px-3 bg-white text-muted mb-4">
                        <span class="bg-m-color p-2 rounded-pill">
                            {{$trunk->name}}
                        </span>
                        <span class="bg-m-color p-2 rounded-pill">
                            {{$trunk->area->name}}
                        </span>
                        {{-- {{$trunk->name}} - {{$trunk->area->name}} --}}
                    </div>
                        @endforeach
                </div>
                <div class="col-md-4 my-3">
                    <h4 class="fw-bold text-muted">Trunks Number In All Areas</h4>
                    <canvas id="trunks-num" style="height:100%!important;"></canvas>
                </div>
                {{-- Wells Graph --}}
                {{-- <div class="col-md-8 my-3">
                    <h4 class="fw-bold text-muted">Latest Added Trunks</h4>
                    
                </div> --}}
                <div class="col-md-4 my-3">
                    <h4 class="fw-bold text-muted">Wells Number In All Areas</h4>
                    <canvas id="wells-num" style="height:100%!important;"></canvas>
                </div>
                {{-- Wells Graph --}}
                {{-- <div class="col-md-8 my-3">
                    <h4 class="fw-bold text-muted">Latest Added Wells</h4>
                    
                </div> --}}
                <div class="col-md-4 my-3">
                    <h4 class="fw-bold text-muted">Wells status</h4>
                    <canvas id="wells-status" style="height:100%!important;"></canvas>
                </div>
            </div>

        </div>
        {{-- Details Sidbar --}}
        <div class="col-lg-2 border-start d-md-block d-none">
            <x-admin-details-sidebar />
        </div>
    </div>
</div>

@php
    
    $names = DB::table('areas')
        ->pluck('name')
        ->toArray();
    $trunksNum = [];
    foreach ($areas as $area) {
        $trunksNum[] = $area->trunks->count();
    }
    
    $wellsNum = [];
    foreach ($areas as $area) {
        foreach ($area->trunks as $trunk) {
            $wellsNum[] = $trunk->wells->count();
        }
    }
@endphp
{{-- Scripts --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.js" integrity="sha512-L6yov5P1r9QnZX2ZRiq+XBLsm1GQ38zfSDJ6gy3pKmPCqkWvK2nz8Ojlju9q36+zOsMmMB+hYgGrJtJWo4Gy/w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.umd.js" integrity="sha512-CMF3tQtjOoOJoOKlsS7/2loJlkyctwzSoDK/S40iAB+MqWSaf50uObGQSk5Ny/gfRhRCjNLvoxuCvdnERU4WGg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
    const ctx = document.getElementById('trunks-num');
    const myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: {{ Js::from($names) }},
            datasets: [{
                label: 'Trunks',
                data: {{ Js::from($trunksNum) }},
                // backgroundColor: [
                // 'rgba(255, 99, 132, 0.2)',
                // 'rgba(255, 159, 64, 0.2)',
                // 'rgba(255, 205, 86, 0.2)',
                // 'rgba(75, 192, 192, 0.2)',
                // 'rgba(54, 162, 235, 0.2)',
                // 'rgba(153, 102, 255, 0.2)',
                // 'rgba(201, 203, 207, 0.2)'
                // ],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },

        }
    });
</script>
<script>
    const ctx2 = document.getElementById('wells-num');
    const myChart2 = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: {{ Js::from($names) }},
            datasets: [{
                label: 'Wells',
                data: {{ Js::from($wellsNum) }},
                // backgroundColor: [
                // 'rgba(255, 99, 132, 0.2)',
                // 'rgba(255, 159, 64, 0.2)',
                // 'rgba(255, 205, 86, 0.2)',
                // 'rgba(75, 192, 192, 0.2)',
                // 'rgba(54, 162, 235, 0.2)',
                // 'rgba(153, 102, 255, 0.2)',
                // 'rgba(201, 203, 207, 0.2)'
                // ],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },

        }
    });
</script>

@php
    $wellsOnTrunk       = DB::table('wells')->where('sender_status', 'trunk')->count();
    $wellsOnTesting     = DB::table('wells')->where('sender_status', 'testing')->count();
    $wellsOnStandBy     = DB::table('wells')->where('sender_status', 'standby')->count();
    $wellsOnDefective   = DB::table('wells')->where('sender_status', 'defective')->count();
    $wellsOnOther       = DB::table('wells')->where('sender_status', 'other')->count();
    $wellsStatusNum     = 
    [
        $wellsOnTrunk,
        $wellsOnTesting,
        $wellsOnStandBy,
        $wellsOnDefective,
        $wellsOnOther,
    ];
@endphp
<script>
    const ctx3 = document.getElementById('wells-status');
    const myChart3 = new Chart(ctx3, {
        type: 'doughnut',
        data: {
            labels: ['Trunk', 'Testing', 'StandBy', 'Defective', 'Other'],
            datasets: [{
                label: 'Wells',
                data: {{ Js::from($wellsStatusNum) }},
                backgroundColor: [
                'rgba(255, 99, 132)',
                'rgba(255, 159, 64)',
                'rgba(255, 205, 86)',
                'rgba(75, 192, 192)',
                'rgba(54, 162, 235)',
                'rgba(153, 102, 255)',
                'rgba(201, 203, 207)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },

        }
    });
</script>

<x-footer />
