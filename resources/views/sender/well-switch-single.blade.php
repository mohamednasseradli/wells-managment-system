<x-header title="Sender Dashboard" />

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
                <h1 class="text-start m-color">Well Switching</h1>
                {{-- Failure --}}
                <x-failure />
                {{-- Success --}}
                <x-success /> 
                @if (session('wait'))
                    <meta http-equiv="refresh" content="{{ session('wait') }};url={{url('/sender/well-data/'.session('well'))}}">
                    <p>Please wait, you will be redirected to add well data</p>
                @endif
                {{-- Well Exists --}}
                @if (session('link') !== null)
                    <div class="alert alert-danger">
                        {!! (session('link')) !!}
                    </div>
                @endif
                <form action="{{url('/sender/share-well-switch')}}" method="POST" class="border shadow rounded-5 py-3">
                    @csrf                    
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 mb-6">
                                {{-- <label for="">Well</label> --}}
                                <input type="number" class="form-control border border-0 border-bottom" name="well" id="selected-well" required value="{{$well->well}}" data-sender-status="{{$well->sender_status}}">
                                <input type="hidden" class="form-control" name="well_id" required value="{{$well->id}}">
                                <input type="hidden" class="form-control" name="trunk" required value="{{$well->trunk_id}}">
                            </div>
                            <div class="col-md-12 mb-3 pt-3 container">
                                <div class="slider-radio-container row text-muted">
                                    <label class="col d-flex align-items-center"> On Test
                                        <input type="radio" name="status" id="testing-radio" data-status="{{$well->sender_status}}" value="testing" class="slider-radio-input" @if($acceptTesting == false) disabled @endif required>
                                        <div class="slider-radio">
                                            <div class="slider-radio-thumb"></div>
                                        </div>
                                    </label>
                                    <label class="col d-flex align-items-center"> On Trunk
                                        <input type="radio" name="status" value="trunk" class="slider-radio-input" required>
                                        <div class="slider-radio">
                                            <div class="slider-radio-thumb"></div>
                                        </div>
                                    </label>
                                    <label class="col d-flex align-items-center"> Stand By
                                        <input type="radio" name="status" value="standby" class="slider-radio-input" required>
                                        <div class="slider-radio">
                                            <div class="slider-radio-thumb"></div>
                                        </div>
                                    </label>
                                    <label class="col d-flex align-items-center"> Defective
                                        <input type="radio" name="status" value="defective" class="slider-radio-input" required>
                                        <div class="slider-radio">
                                            <div class="slider-radio-thumb"></div>
                                        </div>
                                    </label>
                                    <label class="col d-flex align-items-center"> Other
                                        <input type="radio" name="status" value="other" class="slider-radio-input" required>
                                        <div class="slider-radio">
                                            <div class="slider-radio-thumb"></div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                {{-- <label for="">Date</label> --}}
                                <input type="date" class="text-muted form-control border border-0 border-bottom" name="date" required placeholder="Date" value="<?=date('Y-m-d') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                {{-- <label for="">Badge#</label> --}}
                                <input type="number" name="badge" class="form-control border border-0 border-bottom" placeholder="Badge#" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                {{-- <label for="">Vehicle Number</label> --}}
                                <input type="number" name="vehicle" class="form-control border border-0 border-bottom" placeholder="Vehicle Number" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                {{-- <label for="" class="mb-2">Remarks</label> --}}
                                <textarea name="remarks" id="" cols="20" rows="3" class="form-control border border-0 border-bottom" placeholder="Remarks"></textarea>
                            </div>
                        </div>
                        <div class="my-4 text-center container" >
                            <div class="row justify-content-center">
                                <div class="col-md-5 mb-3 ">
                                    <input type="submit" value="share" class="btn m-btn rounded-pill w-100">
                                </div>
                                <div class="col-md-5 mb-3">
                                    <a href="{{url('/sender/well-switch')}}" class="btn btn-outline-danger rounded-pill w-100">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            {{-- Details Sidbar --}}
            <div class="col-lg-2 border-start d-md-block d-none">
                <x-sender-details-sidebar />
            </div>
            
        </div>
    </div>
    
    {{-- Script --}}
    <script>
        const senderStatus = document.getElementById('selected-well').getAttribute('data-sender-status');
        // Get all the radio buttons with the same value as the select box
        var radios = document.querySelectorAll('input[type=radio][value="' + senderStatus + '"]');
        // Check if any radio buttons were found
        if (radios.length > 0) {
        // Mark the first radio button as selected
            radios[0].checked = true;
        }
    </script>
    
<x-footer />