
<div class="sidebar">
    
    <div class="accordion accordion-flush" id="accordionFlushExample">

        
        
        @can('receiver')
        {{-- Dashboard --}}
        <div class="accordion-item">
            <a class="item-heading d-flex flex-column align-items-center justify-content-center" href="{{url('/receiver/dashboard')}}">
                <i class="fa-regular fa-folder-open mb-3"></i>
                {{-- <span class="extender"></span> --}}
                <span class="item-title text-center">Dashboard</span>
            </a>
        </div>
        {{-- Production Header --}}
        <div class="accordion-item">
            <a class="item-heading d-flex flex-column align-items-center justify-content-center" href="{{url('/receiver/production-header')}}">
                <i class="fa-solid fa-phone mb-3"></i>
                {{-- <span class="extender"></span> --}}
                <span class="item-title text-center">Production Header</span>
            </a>
        </div>
        {{-- Notifications --}}
        <div class="accordion-item">
            <a class="item-heading d-flex flex-column align-items-center justify-content-center" href="{{url('/receiver/notifications')}}">
                <i class="fa-solid fa-upload mb-3"></i>
                {{-- <span class="extender"></span> --}}
                <span class="item-title text-center">Notifications</span>
            </a>
        </div>
        {{-- Wells --}}
        <div class="accordion-item">
            <a class="item-heading d-flex flex-column align-items-center justify-content-center" href="{{url('/receiver/my-area')}}">
                <i class="fa-solid fa-upload mb-3"></i>
                {{-- <span class="extender"></span> --}}
                <span class="item-title text-center">My area</span>
            </a>
        </div>
        {{-- Wells Under Testing --}}
        <div class="accordion-item">
            <a class="item-heading d-flex flex-column align-items-center justify-content-center" href="{{url('/receiver/wells-under-testing')}}">
                <i class="fa-solid fa-gears mb-3"></i>
                {{-- <span class="extender"></span> --}}
                <span class="item-title text-center">Under Testing</span>
            </a>
        </div>
        
        @endcan

        
        @can('sender')
        {{-- Dashboard --}}
        <div class="accordion-item">
            <a class="item-heading dashboard d-flex flex-column align-items-center justify-content-center d" href="{{url('/sender/dashboard')}}">
                <i class="fa-regular fa-folder-open mb-3"></i>
                {{-- <span class="extender"></span> --}}
                <span class="item-title text-center">Dashboard</span>
            </a>
        </div>
        {{-- Well Switch --}}
        <div class="accordion-item">
            <a class="item-heading well-switch d-flex flex-column align-items-center justify-content-center d" href="{{url('/sender/well-switch')}}">
                <i class="fa-regular fa-folder-open mb-3"></i>
                {{-- <span class="extender"></span> --}}
                <span class="item-title text-center">Well Switch</span>
            </a>
        </div>
        {{-- Well Data --}}
        {{-- <div class="accordion-item">
            <a class="item-heading d-flex flex-column align-items-center justify-content-center" href="{{url('/sender/well-data')}}">
                <i class="fa-solid fa-upload mb-3"></i>
                <span class="extender"></span>
                <span class="item-title text-center">Well Data</span>
            </a>
        </div> --}}
        {{-- Action Required --}}
        <div class="accordion-item">
            <a class="item-heading action-required d-flex flex-column align-items-center justify-content-center" href="{{url('/sender/action-required')}}"> {{-- {{url('/sender/action-required')}} --}}
                <i class="fa-solid fa-phone mb-3"></i>
                {{-- <span class="extender"></span> --}}
                <span class="item-title text-center">Action Required</span>
            </a>
        </div>
        @endcan
        {{-- Logging Out --}}
        <div class="accordion-item">
            <a class="item-heading d-flex flex-column align-items-center justify-content-center" href="{{url('/logout')}}">
                <i class="fa-solid fa-arrow-right-from-bracket mb-3"></i>
                {{-- <span class="extender"></span> --}}
                <span class="item-title text-center">Logout</span>
            </a>
        </div>
        
    </div>
</div>