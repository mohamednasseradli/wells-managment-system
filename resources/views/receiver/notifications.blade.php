<x-header title="Receiver Dashboard" />

{{-- Toggle Sidebar icon --}}
<div class="toggle-sidebar">
    <i class="fa-solid fa-bars fa-lg"></i>
</div>
<div class="receiver-notifications container-fluid ">
    <div class="row">
        <div class="col-lg-1 col-md-12 sidebar-container">
            <x-user-sidebar />
        </div>
        <div class="col-lg-9 col-md-9 container pt-5">
            <h1 class="text-start m-color mb-4">Notifications</h1>
            {{-- Failure --}}
            <x-failure />
            {{-- Success --}}
            <x-success />
            <div class="container">
                @foreach ($trunks as $trunk)
                    @foreach ($trunk->wells as $well)
                        @foreach ($well->data->whereIn('status', ['testing', 'testing-ready']) as $wellData)
                            <div class="row rounded-5 border shadow py-4">
                                <div class="col-12">
                                    <form action="{{ url('/receiver/submit-notification') }}" method="POST"
                                        class="container">
                                        @csrf
                                        {{-- WellDataID --}}
                                        <input type="hidden" name="wellDataId" value="{{ $wellData->id }}">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                {{-- <label for="">Well Switched to Test Header</label> --}}
                                                <input type="text" value="{{ $wellData->well->well }}" readonly
                                                    class="form-control">
                                                {{-- <input type="hidden" value="{{$wellData->id}}" name="wellData_id" class="form-control"> --}}
                                            </div>
                                            {{-- @if ($wellData->status == 'trunk' || $wellData->status == 'standby')
                                            <div class="col-md-6 mb-3 d-flex align-items-end">
                                                <a href="{{url('/receiver/wellData-seen/'. $wellData->well_switch_id)}}" class="btn btn-warning" >Mark As Seen</a>
                                            </div> --}}
                                            {{-- @elseif ($wellData->status == 'testing') --}}
                                            @if ($wellData->status !== 'testing-ready')
                                                <div class="col-md-6 mb-3">
                                                    {{-- Well Flowing On: --}}
                                                    <div class="slider-radio-container">
                                                        <label class="d-flex align-items-center"> Test
                                                            <input type="radio" name="status" value="testing"
                                                                class="slider-radio-input" required>
                                                            <div class="slider-radio">
                                                                <div class="slider-radio-thumb"></div>
                                                            </div>
                                                        </label>
                                                        <label class="d-flex align-items-center"> Production
                                                            <input type="radio" name="status" value="production"
                                                                class="slider-radio-input" required>
                                                            <div class="slider-radio">
                                                                <div class="slider-radio-thumb"></div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            @else
                                                <input type="hidden" name="status" value="production">
                                            @endif
                                            <div class="col-md-4 mb-3">
                                                {{-- <label for="">Remarks</label> --}}
                                                <input type="text" name="remarks" class="form-control"
                                                    placeholder="Remarks">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                {{-- <label for="">#Badge</label> --}}
                                                <input type="text" name="badge" class="form-control"
                                                    placeholder="Badge#">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                {{-- <label for="">Date</label> --}}
                                                <input type="date" value="<?= date('Y-m-d') ?>" name="date"
                                                    class="form-control" required>
                                            </div>
                                            @if ($wellData->status == 'testing-ready')
                                                <div class="text-center">
                                                    <input type="submit" name="testing-ready" value="Ready For Testing"
                                                        class="btn btn-primary rounded-pill px-5 me-2">
                                                    <input type="submit" name="cancel" value="Cancel"
                                                        class="btn btn-outline-danger rounded-pill px-5 ms-2">
                                                </div>
                                            @else
                                                <div class="text-center">
                                                    <input type="submit" name="submit" value="Submit"
                                                        class="btn m-btn rounded-pill px-5">
                                                </div>
                                            @endif
                                            {{-- @endif --}}
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @endforeach
            </div>

            {{-- Pagination --}}
            <div>
                {{-- {{$notifications->links()}} --}}
            </div>
        </div>
        {{-- Details Sidbar --}}
        <div class="col-lg-2 border-start d-md-block d-none">
            <x-receiver-details-sidebar/>
        </div>
        {{-- <div class="col-md-3 mb-3 pt-5 border-bottom text-center bg-light">
            @foreach ($side_notifications as $side_notification)
                <div class="mb-3">
                    <label for="">Well</label>
                    <span>{{ $side_notification->well }}</span>
                </div>
                <div class="mb-3">
                    <label for="">Status</label>
                    <span>{{ $side_notification->status }}</span>
                </div>
                @if ($side_notification->seen == 0)
                    <a href="{{ url('/receiver/notification-seen/' . $side_notification->id) }}"
                        class="text-primary">Acknowledge</a>
                @endif
            @endforeach --}}
    </div>
</div>
</div>


<x-footer />
