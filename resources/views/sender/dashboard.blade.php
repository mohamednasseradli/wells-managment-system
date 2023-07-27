<x-header title="Sender Dashboard" />

    {{-- Toggle Sidebar icon --}}
    <div class="toggle-sidebar">
        <i class="fa-solid fa-bars fa-lg"></i>
    </div>
    <div class="sender-dashboard container-fluid "  style="min-height: 100vh">
        <div class="row">
            <div class="col-lg-1 col-md-12 sidebar-container">
                <x-user-sidebar />
            </div>
            <div class="col-lg-9 col-md-12 content-container pt-5">
                {{-- <h1 class="text-center"> Areas </h1> --}}
                <div class="container">
                    <div class="row">
                        @foreach ($areas as $area)
                            <div class="col-md-3 mb-3 area-widget">
                                <a href="{{url('/sender/areas/'.$area->id)}}" class="fs-2 m-color border border-success-subtle rounded-4 text-center fw-bold d-block shadow p-3 py-5">{{$area->name}}</a>
                            </div>
                        @endforeach
                    </div>
                    {{-- Pagination --}}
                    <div>
                        {{ $areas->links() }}
                    </div>
                </div>
            </div>
            {{-- Details Sidbar --}}
            <div class="border-start col-lg-2 d-md-block d-none">
                <x-sender-details-sidebar />
            </div>
        </div>
    </div>
    
    
<x-footer />