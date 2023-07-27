<x-header title="Sender Dashboard" />

{{-- Toggle Sidebar icon --}}
<div class="toggle-sidebar">
    <i class="fa-solid fa-bars fa-lg"></i>
</div>
<div class="sender-dashboard container-fluid " style="min-height: 100vh">
    <div class="row">
        <div class="col-lg-1 col-md-12 sidebar-container">
            <x-user-sidebar />
        </div>
        <div class="col-lg-9 col-md-12 container pt-5">
            <h1 class="text-start m-color">Action Required</h1>
            @foreach ($actions as $action)
                <div class="row shadow-sm py-3">
                    <div class="col-md-6 mb3">
                        <div class="rounded-5 p-3 shadow position-relative mb-4">
                            <span
                                class="shadow-sm position-absolute start-50 translate-middle top-0 bg-m-color rounded-5 p-3 text-white text-center"
                                style="width: 100px;height: 50px">
                                {{ $action->well->well }}
                            </span>
                            @if ($action->status == 'action-required')
                                <div class="text-center my-2">
                                    <span class="d-block my-3 text-muted fw-bold">
                                        {{ $action->undertesting_remarks }}
                                    </span>
                                    {{-- @if ($action->data_sent == false) --}}
                                    <a href="{{ url('/sender/well-data/' . $action->well->well . '/' . $action->id) }}"
                                        class="rounded-pill btn btn-primary me-2">Add Well Data</a>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="rounded-pill btn btn-outline-danger ms-2"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $action->id }}">
                                        Not Required
                                    </button>
                                </div>
                            @else
                                <span class="d-block my-3 text-muted fw-bold">
                                    On {{ $action->status }} due to {{ $action->remarks }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal-{{ $action->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel-{{ $action->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ url('/sender/action-not-required') }}" method="post">
                                @csrf
                                <input type="hidden" name="action_id" value="{{ $action->id }}">
                                <input type="hidden" name="well_id" value="{{ $action->well_id }}">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel-{{ $action->id }}">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @csrf
                                    <div>
                                        <input type="number" name="vehicle" id="vehicle" class="form-control mb-3"
                                            required placeholder="Vehicle No">
                                    </div>
                                    <div>
                                        <input type="number" name="badge" id="badge" class="form-control mb-3"
                                            required placeholder="Badge No">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary rounded-pill"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary rounded-pill">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- Pagination --}}
            <div>
                {{ $actions->links() }}
            </div>
        </div>
        {{-- Details Sidbar --}}
        <div class="col-lg-2 border-start d-md-block d-none">
            <x-sender-details-sidebar />
        </div>
    </div>
</div>

{{-- Modal --}}


<x-footer />
