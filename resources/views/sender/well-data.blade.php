<x-header title="Sender Dashboard" />

    {{-- Toggle Sidebar icon --}}
    <div class="toggle-sidebar">
        <i class="fa-solid fa-bars fa-lg"></i>
    </div>
    <div class="receiver-dashboard container-fluid " style="height: 100vh;">
        <div class="row">
            <div class="col-lg-1 col-md-12 sidebar-container">
                <x-user-sidebar />
            </div>
            <div class="col-lg-9 col-md-12 content-container pt-5">
                <h1 class="text-center">Well Data</h1>
                {{-- Failure --}}
                <x-failure />
                {{-- Success --}}
                <x-success />
                <form action="{{url('/sender/share-well-data')}}" method="POST">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="" class="mb-2">Well #</label>
                                <input type="number" name="well" value="{{$well}}" class="form-control" required>
                                <input type="hidden" name="well_id" value="{{$well_id}}" class="form-control">
                                <input type="hidden" name="wellData_id" value="{{$wellData_id}}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="mb-2">SUC PRSS</label>
                                <input type="number" name="suc_prss" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="mb-2">TEMP</label>
                                <input type="number" name="temp" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="mb-2">DIS PRSS</label>
                                <input type="number" name="dis_prss" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="mb-2">Choke set</label>
                                <input type="number" name="choke_set" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="mb-2">Vehicle Number</label>
                                <input type="number" name="vehicle" class="form-control" required>
                            </div>
                        </div>
                        <div class="my-4 text-center container" >
                            <div class="row justify-content-center">
                                <div class="col-md-5 mb-3 ">
                                    <input type="submit" value="share" class="btn btn-success w-100">
                                </div>
                                <div class="col-md-5 mb-3">
                                    <a href="{{url('/sender/well-data')}}" class="btn btn-outline-warning w-100">Cancel</a>
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