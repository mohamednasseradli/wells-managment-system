<x-header title="Admin Dashboard" />

{{-- Toggle Sidebar icon --}}
<div class="toggle-sidebar">
    <i class="fa-solid fa-bars fa-lg"></i>
</div>
<div class="admin-trunks container-fluid " style="min-height: 100vh">
    <div class="row">
        <div class="col-lg-1 col-md-12 sidebar-container">
            <x-user-sidebar />
        </div>
        <div class="col-lg-9 col-md-12 content-container pt-5">
            {{-- Success --}}
            <x-success />
            {{-- Failure --}}
            <x-failure />
            <h1 class="text-start m-color">{{ $trunk->name }}</h1>
            {{-- Trunk Wells Table --}}
            <div class="table-responsive mt-4 p-2">
                <table class="table table-bordered shadow-sm text-center">
                    <thead>
                        <tr>
                            <th class="bg-m-color bg-gradient text-white">#</th>
                            <th class="bg-m-color bg-gradient text-white">Well</th>
                            <th class="bg-m-color bg-gradient text-white">Status </th>
                            {{-- <th class="bg-m-color bg-gradient text-white">Receiver Status </th> --}}
                            <th class="bg-m-color bg-gradient text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($trunk->wells as $well)
                            <tr>
                                <td class="bg-m-color bg-gradient text-white">{{ $i++ }}</td>
                                <td>{{ $well->well }}</td>
                                <td>{{ $well->sender_status }}</td>
                                {{-- <td>{{$well->receiver_status}}</td> --}}
                                <td><a href="{{ url('/sender/well-switch-single/' . $well->id) }}"
                                        class="btn btn-primary"><i class="fa-solid fa-eye"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            {{-- Pagination --}}
            <div>
                {{-- {{$trunks->links()}} --}}
            </div>
        </div>
        {{-- Details Sidbar --}}
        <div class="col-lg-2 d-md-block d-none">
            <x-admin-details-sidebar />
        </div>
    </div>
</div>


<x-footer />
