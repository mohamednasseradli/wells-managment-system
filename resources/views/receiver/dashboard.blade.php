<x-header title="Receiver Dashboard" />

    {{-- Toggle Sidebar icon --}}
    <div class="toggle-sidebar">
        <i class="fa-solid fa-bars fa-lg"></i>
    </div>
    <div class="receiver-dashboard container-fluid ">
        <div class="row">
            <div class="col-lg-1 col-md-12 sidebar-container">
                <x-user-sidebar />
            </div>
            <div class="col-lg-9 col-md-12 content-container pt-5">
                {{-- <h1 class="text-center">Dashboard</h1> --}}
                
            </div>
            {{-- Details Sidbar --}}
            <div class="col-lg-2 border-start d-md-block d-none">
                <x-receiver-details-sidebar />
            </div>
        </div>
    </div>
    
    
<x-footer />