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
            <h1 class="text-start">{{ $area->name }}</h1>

            {{-- Success --}}
            <x-success />
            {{-- Failure --}}
            <x-failure />
            <div class="text-end my-2">
                <button class="btn m-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#add-trunk"
                    aria-controls="offcanvasTop">
                    New Trunk
                    <i class="fa fa-plus mx-2" aria-hidden="true"></i>
                </button>
                <button class="btn btn-outline-danger" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#delete-trunk" aria-controls="offcanvasTop">
                    Delete Trunk
                    <i class="fa fa-trash mx-2" aria-hidden="true"></i>
                </button>
            </div>
            {{-- Add Trunk Canvas --}}
            <div class="offcanvas offcanvas-top" tabindex="-1" id="add-trunk" aria-labelledby="offcanvasTopLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title m-color" id="offcanvasTopLabel">Add New Trunk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form action="{{ route('trunks.store') }}" method="POST">
                        @csrf
                        <div class="container mt-4">
                            <div class="row">
                                <input type="hidden" name="area_id" value="{{$area->id}}">
                                <div class="col-md-4 mb-3">
                                    <input type="text" name="name" class="form-control w-100" required
                                        placeholder="Trunk Name">
                                </div>
                                <div class="col-md-4 mb-3 d-flex align-items-center">
                                    <button type="submit" class="btn m-btn w-100">
                                        Add Trunk
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{-- Delete Trunk Canvas --}}
            <div class="offcanvas offcanvas-top" tabindex="-1" id="delete-trunk" aria-labelledby="offcanvasTopLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title m-color" id="offcanvasTopLabel">Deleting A Trunk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form action="{{ route('trunks.destroy', 'id') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <select name="trunk_id" id="trunk-id" class="form-select w-100" required>
                                        <option hidden disabled selected> Delete A Trunk </option>
                                        @foreach ($area->trunks as $trunk)
                                            <option value="{{ $trunk->id }}">{{ $trunk->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="submit" class="btn btn-outline-danger w-100" value="Delete">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{-- Trunks Table --}}
            <div class="table-responsive mt-4 p-2">
                <table class="table table-bordered shadow-sm text-center">
                    <thead>
                        <tr>
                            <th class="bg-m-color bg-gradient text-white">#</th>
                            <th class="bg-m-color bg-gradient text-white">Trunk</th>
                            <th class="bg-m-color bg-gradient text-white">Area</th>
                            <th class="bg-m-color bg-gradient text-white">Wells</th>
                            <th class="bg-m-color bg-gradient text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($trunks as $trunk)
                            <tr>
                                <td class="bg-m-color bg-gradient text-white">{{ $i++ }}</td>
                                <td>{{ $trunk->name }}</td>
                                <td>{{ $trunk->area->name }}</td>
                                <td>{{ $trunk->wells->count() }}</td>
                                <td>
                                    <a href="{{ route('trunks.show', $trunk->id) }}" class="btn btn-primary me-3">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                    <form action="{{ route('trunks.show', $trunk->id) }}" class="d-inline"
                                        method="POST" onsubmit="return confirm('Sure? You want to delete this area?')">
                                        @csrf
                                        <input type="hidden" name="trunk_id" value="{{ $trunk->id }}">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Pagination --}}
            <div>
                {{ $trunks->links() }}
            </div>
        </div>
        {{-- Details Sidbar --}}
        <div class="col-lg-2 d-md-block d-none">
            <x-admin-details-sidebar />
        </div>
    </div>
</div>


<x-footer />
