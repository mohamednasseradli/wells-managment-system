<x-header title="Admin Dashboard | Senders" />

    {{-- Toggle Sidebar icon --}}
    <div class="toggle-sidebar">
        <i class="fa-solid fa-bars fa-lg"></i>
    </div>
    <div class="admin-receivers container-fluid ">
        <div class="row">
            <div class="col-lg-1 col-md-12 sidebar-container">
                <x-admin-sidebar />
            </div>
            <div class="col-lg-11 col-md-12 container pt-5">
                <h1 class="text-center">Senders</h1>
                {{-- Success --}}
                <x-success />
                {{-- Failure --}}
                <x-failure />
                <form action="{{url('/admin/add-sender')}}" method="POST">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label for="" class="mb-3">Username: </label>
                                <input type="text" name="username" class="form-control w-100">
                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="" class="mb-3">Password: </label>
                                <input type="password" name="password" class="form-control w-100">
                            </div>
    
                            <div class="col-md-2 d-flex align-items-center">
                                <button type="submit" class="btn btn-success col-">
                                    إضافة
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                {{-- Receivers table --}}
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>username</th>
                                <th>password</th>
                            </tr>
                        </thead>
                        <tbody>
                                @php $i = 1  @endphp
                                @foreach ($senders as $sender)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$sender->username}}</td>
                                        <td>{{$sender->password_decrypted}}</td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                {{$senders->links()}}
            </div>
        </div>
    </div>
    
    
<x-footer />