<x-header title="Admin Dashboard | users" />

{{-- Toggle Sidebar icon --}}
<div class="toggle-sidebar">
    <i class="fa-solid fa-bars fa-lg"></i>
</div>
<div class="admin-users container-fluid " style="min-height: 100vh">
    <div class="row">
        <div class="col-lg-1 col-md-12 sidebar-container">
            <x-admin-sidebar />
        </div>
        <div class="col-lg-9 col-md-12 container pt-5">
            <h1 class="text-start">Areas</h1>
            {{-- Success --}}
            <x-success />
            {{-- Failure --}}
            <x-failure />
            <!-- Button trigger modal -->
            <div class="text-end mb-3">
                <button type="button" class="btn m-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add Area 
                    <i class="fa-solid fa-plus ms-2"></i>
                </button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('areas.store') }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Adding New Area</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="">
                                                <input type="text" name="name" class="rounded-0 form-control w-100" placeholder="Area Name" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn m-btn">
                                        Save
                                        <i class="fa-solid fa-floppy-disk"></i>
                                    </button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
            
            {{-- Users --}}
            @php $i = 1  @endphp
            @foreach ($areas as $area)
                <div class="d-flex flex-row align-items-center position-relative border shadow-sm rounded-3 p-2 mb-3">
                    <div class="me-3">
                        <span class="d-block rounded-circle border p-3 " style="min-height: 40px">
                            <i class="fa fa-map fs-1 m-color" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="me-3">
                        <h3>{{$area->name}}</h3>
                        <span class="d-block m-color">Trunks: {{$area->trunks->count()}}</span>
                        {{-- <span class="d-block m-color">Wells: {{$area->}}</span> --}}
                    </div>
                    <div class="d-flex flex-row align-items-center position-absolute top-middle end-0 me-3">
                        <a href="{{ url('/admin/areas/' . $area->id) }}" class="btn btn-primary me-3">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>
                        <form action="{{ url('/admin/delete-area') }}" class="form-inline" method="POST"
                            onsubmit="return confirm('Sure? You want to delete this area?')">
                            @csrf
                            <input type="hidden" name="area_id" value="{{ $area->id }}">
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- Pagination --}}
        {{ $areas->links() }}
        {{-- Details Sidbar --}}
        <div class="col-lg-2 d-md-block d-none">
            <x-admin-details-sidebar />
        </div>
    </div>
</div>


<x-footer />
