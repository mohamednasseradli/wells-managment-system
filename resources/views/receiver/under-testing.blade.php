<x-header title="Wells Under Testing" />

    {{-- Toggle Sidebar icon --}}
    <div class="toggle-sidebar">
        <i class="fa-solid fa-bars fa-lg"></i>
    </div>
    <div class="receiver-dashboard container-fluid " style="min-height: 100vh">
        <div class="row">
            <div class="col-lg-1 col-md-12 sidebar-container">
                <x-user-sidebar />
            </div>
            <div class="col-lg-9 col-md-12 container pt-5">
                <h1 class="text-start m-color">Wells Under Testing</h1>
                {{-- Failure --}}
                <x-failure />
                {{-- Success --}}
                <x-success />   
                <div class="table-responsive mt-5">
                    <table class="table table-bordered table-stripped text-center">
                        <thead>
                            <tr>
                                <th class="bg-m-color bg-gradient text-white">Well</th>
                                <th class="text-nowrap bg-m-color bg-gradient text-white">Date</th>
                                <th class="text-nowrap bg-m-color bg-gradient text-white">Oil Rate</th>
                                <th class="text-nowrap bg-m-color bg-gradient text-white">Water Rate</th>
                                <th class="text-nowrap bg-m-color bg-gradient text-white">Water Cut</th>
                                <th class="text-nowrap bg-m-color bg-gradient text-white">SUC PRSS</th>
                                <th class="text-nowrap bg-m-color bg-gradient text-white">DIS PRSS</th>
                                <th class="text-nowrap bg-m-color bg-gradient text-white">TEMP</th>
                                <th class="text-nowrap bg-m-color bg-gradient text-white">Choke Set</th>
                                <th class="text-nowrap bg-m-color bg-gradient text-white">Completed</th>
                                <th class="text-nowrap bg-m-color bg-gradient text-white">No Flow</th>
                                <th class="text-nowrap bg-m-color bg-gradient text-white">Remarks</th>
                                <th class="text-nowrap bg-m-color bg-gradient text-white">Submit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trunks as $trunk)
                                @foreach ($trunk->wells as $well)
                                    @foreach ($well->data->where('status', 'under-testing') as $wellData)
                                        <tr>
                                            <form action="{{url('/receiver/submit-under-testing')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="wellData_id" value="{{$wellData->id}}">
                                                <input type="hidden" name="well_id" value="{{$wellData->well_id}}">
                                                <td class="text-nowrap bg-m-color bg-gradient text-white">{{$wellData->well->well}}</td>
                                                <td class="text-nowrap">{{$wellData->undertesting_datetime}}</td>
                                                <td><input type="text" name="oil_rate" class="form-control"></td>
                                                <td><input type="text" name="water_rate" class="form-control"></td>
                                                <td><input type="text" name="water_cut" class="form-control"></td>
                                                <td>{{$wellData->suc_prss}}</td>
                                                <td>{{$wellData->dis_prss}}</td>
                                                <td>{{$wellData->temp}}</td>
                                                <td>{{$wellData->choke_set}}</td>
                                                <div class="slider-radio-container">
                                                    <td>
                                                        <label class="d-flex align-items-center"> 
                                                            <input type="radio" name="testing_status" value="completed" class="slider-radio-input" required>
                                                            <div class="slider-radio">
                                                                <div class="slider-radio-thumb"></div>
                                                            </div>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="d-flex align-items-center">
                                                            <input type="radio" name="testing_status" value="no_flow" class="slider-radio-input" required>
                                                            <div class="slider-radio">
                                                                <div class="slider-radio-thumb"></div>
                                                            </div>
                                                        </label>
                                                    </td>
                                                </div>
                                                <td class="p-0"><input type="text" name="remarks" class="form-control h-100"></td>
                                                <td><input type="submit" value="Submit" class="btn m-btn rounded-pill"></td>

                                            </form>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- Details Sidbar --}}
            <div class="col-lg-2 border-start d-md-block d-none">
                <x-receiver-details-sidebar />
            </div>
        </div>
    </div>
    
    
<x-footer />