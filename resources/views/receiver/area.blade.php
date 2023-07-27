<x-header title="Receiver Dashboard | Area" />

    {{-- Toggle Sidebar icon --}}
    <div class="toggle-sidebar">
        <i class="fa-solid fa-bars fa-lg"></i>
    </div>
    <div class="receiver-area container-fluid "  style="min-height: 100vh">
        <div class="row">
            <div class="col-lg-1 col-md-12 sidebar-container">
                <x-user-sidebar />
            </div>
            <div class="col-lg-9 col-md-12 container pt-5">
                <h1 class="text-start m-color">{{$area->name}}</h1>
                {{-- Success --}}
                <x-success />
                {{-- Failure --}}
                <x-failure />
                <div class="table-responsive mt-4 p-2">
                    <table class="table table-bordered shadow-sm text-center">
                        <thead>
                            <tr>
                                <th class="bg-m-color bg-gradient text-white">#</th>
                                <th class="bg-m-color bg-gradient text-white">Trunk</th>
                                {{-- <th class="bg-m-color bg-gradient text-white">Area</th> --}}
                                <th class="bg-m-color bg-gradient text-white">Wells</th>
                                <th class="bg-m-color bg-gradient text-white">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($area->trunks as $trunk)
                                <tr>
                                    <td class="bg-m-color bg-gradient text-white">{{ $i++ }}</td>
                                    <td>{{ $trunk->name }}</td>
                                    {{-- <td>{{ $trunk->area->name }}</td> --}}
                                    <td>{{ $trunk->wells->count() }}</td>
                                    <td>
                                        <a href="{{ route('receiver-trunk-wells', $trunk->id) }}" class="btn btn-primary me-3">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- Details Sidbar --}}
            <div class="col-lg-2 border-start d-md-block d-none">
                <x-receiver-details-sidebar />
            </div>
        </div>
    </div>
    
    
<x-footer />