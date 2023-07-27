<x-header title="Sender Dashboard" />

    {{-- Toggle Sidebar icon --}}
    <div class="toggle-sidebar">
        <i class="fa-solid fa-bars fa-lg"></i>
    </div>
    <div class="sender-dashboard container-fluid ">
        <div class="row">
            <div class="col-lg-1 col-md-12 sidebar-container">
                <x-user-sidebar />
            </div>
            <div class="col-lg-9 col-md-12 content-container pt-5">
                <h1 class="text-center">Well Switching Update</h1>
                {{-- Failure --}}
                <x-failure />
                {{-- Success --}}
                <x-success /> 
                
                <form action="{{url('/sender/update-well-switch/'.$data->id)}}" method="POST">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="" class="mb-2">Well #</label>
                                <input type="number" name="well" class="form-control" value="{{$data->well}}" disabled required>
                            </div>
                            <div class="col-md-6 mb-3 pt-3">
                                <div class="slider-radio-container">
                                    <label class="d-flex align-items-center"> On Test
                                        <input type="radio" name="status" value="testing" class="slider-radio-input" @if($data->status == 'testing') checked @endif required>
                                        <div class="slider-radio">
                                            <div class="slider-radio-thumb"></div>
                                        </div>
                                    </label>
                                    <label class="d-flex align-items-center"> On Trunk
                                        <input type="radio" name="status" value="production" class="slider-radio-input" @if($data->status == 'production') checked @endif required>
                                        <div class="slider-radio">
                                            <div class="slider-radio-thumb"></div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="mb-2">Remarks</label>
                                <textarea name="remarks" id="" cols="20" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6 mb-6">
                                <label for="">Date</label>
                                <input type="date" class="form-control" name="date" required value="<?=date('Y-m-d') ?>">
                            </div>
                            <div class="col-md-6 mb-6">
                                <label for="">Badge#</label>
                                <input type="number" name="badge" class="form-control" value="{{$data->badge}}" required>
                            </div>
                        </div>
                        <div class="my-4 text-center container" >
                            <div class="row justify-content-center">
                                <div class="col-md-5 mb-3 ">
                                    <input type="submit" value="share" class="btn btn-success w-100">
                                </div>
                                <div class="col-md-5 mb-3">
                                    <a href="{{url('/sender/well-switch')}}" class="btn btn-outline-warning w-100">Cancel</a>
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
    
    
<x-footer />