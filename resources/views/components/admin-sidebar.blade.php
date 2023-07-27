
<div class="sidebar">
    <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <a class="item-heading dashboard d-flex flex-column align-items-center justify-content-center" href="{{url('/admin/dashboard')}}">
                    {{-- <span>
                        <img src="{{asset('icons/001-layout.png')}}" alt="">
                    </span> --}}
                    <i class="fa-solid fa-house mb-3"></i>
                    {{-- <span class="extender"></span> --}}
                    <span class="item-title">Dashboard</span>
                </a>
            </div>
        {{-- Registered Receivers --}}
        <div class="accordion-item">
            <a class="item-heading users d-flex flex-column align-items-center justify-content-center" href="{{route('users.index')}}">
                <i class="fa-solid fa-users mb-3"></i>
                {{-- <span class="extender"></span> --}}
                <span class="item-title">Users</span>
            </a>
        </div>
        {{-- Areas --}}
        <div class="accordion-item">
            <a class="item-heading areas d-flex flex-column align-items-center justify-content-center" href="{{route('areas.index')}}">
                <i class="fa-solid fa-map mb-3"></i>
                {{-- <span class="extender"></span> --}}
                <span class="item-title">Areas</span>
            </a>
        </div>
        {{-- History [{{url('/admin/history')}}] --}} 
        <div class="accordion-item">
            <a class="item-heading trunks d-flex flex-column align-items-center justify-content-center" href="{{url('/admin/trunks')}}""> 
                <i class="fa-solid fa-chalkboard-user mb-3"></i>
                {{-- <span class="extender"></span> --}}
                <span class="item-title">Trunks</span>
            </a>
        </div>
        {{-- Logging Out --}}
        <div class="accordion-item">
            <a class="item-heading d-flex flex-column align-items-center justify-content-center" href="{{url('/logout')}}">
                <i class="fa-solid fa-arrow-right-from-bracket mb-3"></i>
                {{-- <span class="extender"></span> --}}
                <span class="item-title">Logout</span>
            </a>
        </div>
        
    </div>
</div>