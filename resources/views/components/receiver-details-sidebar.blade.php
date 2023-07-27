{{-- Aramco --}}
{{-- <h2 class="my-3 fw-bold">Aramco</h2> --}}
<div class="my-3">
    {{-- <img src="{{asset('storage/imgs/aramco.png')}}" alt="" class="w-100"> --}}
    <img src="{{asset('imgs/aramco.png')}}" alt="" class="w-100">
</div>
{{--  --}}
<div class="p-3 shadow border border-success-subtle rounded-4 my-3" style="background-color: #e8f3ed">
    <div class="text-start text-muted fw-bold">
        {{date('l')}}
    </div>
    <div class="position-relative fw-bold m-color">
        <span class="d-block text-center" style="font-size: 70px" id="current-time">
            @php
                echo date('h:i')
            @endphp
        </span>
        <span class="position-absolute bottom-0 end-0" id="amOrPm">
            @php
                echo date('A')
            @endphp
        </span>
    </div>
    <div class="text-end text-muted fw-bold">
        {{date('Y-m-d')}}
    </div>
</div>
{{-- Latest Switched Wells --}}
<div class="p-3 shadow border border-primary-subtle rounded-4 my-3 overflow-y-scroll" style="height: 300px">
    <h6 class="fw-bold text-muted">Latest Switched Wells</h6>
    @php
        // $latestSwitchedWells = DB::table('well_data')
        //             ->join('wells', 'well_data.well_id', 'wells.id')
        //             ->where('status', '!=', 'off')
        //             ->select('well_data.status', 'wells.well')
        //             ->orderBy('well_data.id', 'desc')
        //             ->take(3)
        //             ->get();
                    $side_notifications     = DB::table('switch_notifications')->where('area_id', Auth::user()->area->id)->orderBy('id', 'desc')->take(10)->get();
    @endphp
    @if ($side_notifications->isNotEmpty())

        @foreach ($side_notifications as $latestSwitchedWell)
            <div class="p-2 bg-primary-subtle shadow-sm text-primary rounded-4 my-2 position-relative">
                {{$latestSwitchedWell->well}} Switched To {{$latestSwitchedWell->status}}
                @if ($latestSwitchedWell->seen == 0)
                    <a href="{{ url('/receiver/notification-seen/' . $latestSwitchedWell->id) }}"
                        class="text-primary position-absolute end-0 bottom-0 mb-1 me-2"><i class="fa fa-eye " aria-hidden="true"></i></a>
                @endif
            </div>
        @endforeach
    @else
        <div class="p-3 text-danger">
            No Switched Wells Yet.
        </div>
    @endif
</div>
{{-- Wells Under Testing --}}
<div class="p-3 shadow border border-primary-subtle rounded-4 my-3">
    <h6 class="fw-bold text-muted">Wells Under Testing</h6>
    @php
        $latestSwitchedWells = DB::table('well_data')
                    ->join('wells', 'well_data.well_id', 'wells.id')
                    ->where('status', '=', 'under-testing')
                    ->select('well_data.status', 'wells.well')
                    ->orderBy('well_data.id', 'desc')
                    ->take(3)
                    ->get();
    @endphp
    @if ($latestSwitchedWells->isNotEmpty())

        @foreach ($latestSwitchedWells as $latestSwitchedWell)
        <div class="p-2 bg-warning-subtle shadow-sm text-warning rounded-4 my-2">
            {{$latestSwitchedWell->well}} is now Under Testing
        </div>
        @endforeach
    @else
        <div class="p-0 text-danger">
            No Under Testing Wells Now.
        </div>
    @endif
</div>
{{-- Wells Needs Action --}}
<div class="p-3 shadow border border-primary-subtle rounded-4 my-3">
    <h6 class="fw-bold text-muted">Wells Require Action</h6>
    @php
        $latestSwitchedWells = DB::table('well_data')
                    ->join('wells', 'well_data.well_id', 'wells.id')
                    ->where('status', '=', 'under-testing')
                    ->select('well_data.status', 'wells.well')
                    ->orderBy('well_data.id', 'desc')
                    ->take(3)
                    ->get();
    @endphp
    @if ($latestSwitchedWells->isNotEmpty())

        @foreach ($latestSwitchedWells as $latestSwitchedWell)
        <div class="p-2 bg-warning-subtle shadow-sm text-warning rounded-4 my-2">
            {{$latestSwitchedWell->well}} action required.
        </div>
        @endforeach
    @else
        <div class="p-0 text-danger">
            No Actions Required Now.
        </div>
    @endif
</div>