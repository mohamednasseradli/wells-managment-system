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
        <div class="col-lg-9 col-md-12 pt-5">
            <h1 class="text-start">Users</h1>
            <div class="container p-0">
                <div class="row mb-3">
                    {{-- Success --}}
                    <x-success />
                    {{-- Failure --}}
                    <x-failure />
                    
                    <div class="text-end">
                        <button class="btn m-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop"
                            aria-controls="offcanvasTop">
                            Add New User
                            <i class="fa-solid fa-plus ms-2"></i>
                        </button>
                    </div>
                </div>
                {{-- Users --}}
                @php $i = 1  @endphp
                @foreach ($users as $user)
                    <div class="d-flex flex-row align-items-center position-relative border shadow-sm rounded-3 p-2 mb-3">
                        <div class="me-3">
                            <span class="d-inline-block h-100 rounded-circle border p-2">
                                <img src="@if ($user->role == 'receiver') {{asset('imgs/receiver.png')}} @else {{asset('imgs/sender.png')}} @endif"  width="50" height="50" class="img-fluid">
                            </span>
                        </div>
                        <div class="me-3">
                            <h3>{{$user->username}}</h3>
                            <span class="d-block m-color text-capitalize">Role: {{$user->role}}</span>
                            <span class="d-block m-color text-capitalize">
                                Area: 
                                @if ($user->role == 'sender')
                                    All Areas
                                @else
                                    {{$user->area->name}}
                                @endif
                            </span>
                        </div>
                        <div class="position-absolute top-middle end-0 me-3">
                            <form action="{{ route('users.destroy', $user->id) }}" class="form-inline" method="POST"
                                onsubmit="return confirm('Sure? You want to delete this user?')">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- Pagination --}}
            {{ $users->links() }}
        </div>
        {{-- Details Sidbar --}}
        <div class="col-lg-2 d-md-block d-none">
            <x-admin-details-sidebar />
        </div>

        <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasTopLabel" class="m-color">New User</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" name="username" class="rounded-0 form-control w-100" required
                                    placeholder="Username">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="password" name="password" class="rounded-0 form-control w-100" required
                                    placeholder="Password">
                            </div>
                            {{-- <div class="col-md-6 mb-3">
                                    <input type="number" name="badge" class="rounded-0 form-control w-100" required placeholder="#Badge">
                                </div> --}}
                            <div class="col-md-6 mb-3">
                                <select name="role" id="choose-role" class="rounded-0 form-control" required
                                    onchange="toggleArea()">
                                    <option selected hidden disabled>Choose User Role</option>
                                    <option value="receiver">Receiver</option>
                                    <option value="sender">Sender</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <select name="area" id="choose-area" class="rounded-0 form-control" required>
                                    <option selected hidden disabled>Choose Area</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}">{{$area->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12 d-flex justify-content-center">
                                <button type="submit" class="btn m-btn w-25">
                                    Save
                                    <i class="fa-solid fa-floppy-disk ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<x-footer />
