
<x-header title="Login to User Dashboard" />
    <div class="login-page bg-light">
        <div class="container d-flex align-items-center justify-content-center sender-login py-5 min-vh-100">
            <div class="login-form bg-white shadow-lg rounded-4 p-5" style="min-width: 350px">
                <div class="text-center mb-3">
                    <span class="d-inline-flex justify-content-center align-items-center rounded-circle bg-white" style="width:80px;height:80px">
                        <i class="fa-regular fa-user fs-3 text-muted"></i>
                    </span>
                </div>
                <h1 class="text-center text-white mb-4 fs-3 fw-semibold">
                    User Login
                </h1>
                {{-- Login Errors --}}
                <x-login-error />
                
                <form action="{{url('/user-login')}}" class="" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="username" class="bg-transparent border-0 rounded-pill border-opacity-10 form-control w-100 p-2" required placeholder="Username" style>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="bg-transparent border-0 rounded-pill border-opacity-10 form-control w-100 p-2" required placeholder="Password">
                    </div>
                    <div class="">
                        <input type="submit" value="Login" class="btn bg-white text-muted border-0 rounded-pill w-100 py-2">
                    </div>
                </form>
            </div>
        </div>
    </div>
<x-footer />
