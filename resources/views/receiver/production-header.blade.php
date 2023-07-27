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
                <h1 class="text-start m-color">Production Header</h1>
                {{-- Failure --}}
                <x-failure />
                {{-- Success --}}
                <x-success />   
                <div class="table-responsive mt-5">
                    <table class="table table-bordered table-stripped text-center">
                        <thead>
                            <tr>
                                <th class="bg-m-color bg-gradient text-white">Well</th>
                                {{-- <th class="bg-m-color bg-gradient text-white">Date</th> --}}
                                {{-- <th class="bg-m-color bg-gradient text-white">Time</th> --}}
                                <th class="bg-m-color bg-gradient text-white">Oil Rate</th>
                                <th class="bg-m-color bg-gradient text-white">Water Rate</th>
                                <th class="bg-m-color bg-gradient text-white">Water Cut</th>
                                <th class="bg-m-color bg-gradient text-white">SUC PRSS</th>
                                <th class="bg-m-color bg-gradient text-white">DIS PRSS</th>
                                <th class="bg-m-color bg-gradient text-white">TEMP</th>
                                <th class="bg-m-color bg-gradient text-white">Choke Set</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($trunks as $trunk) --}}
                                {{-- @foreach ($trunk->wells as $well) --}}
                                    @foreach ($wells_data as $wellData)
                                        <tr>
                                            <td class="bg-m-color bg-gradient text-white">{{$wellData->well->well}}</td>
                                            {{-- <td class="text-nowrap">{{$well->date}}</td> --}}
                                            {{-- <td>{{$wellData->time}}</td> --}}
                                            <td>{{$wellData->oil_rate}}</td>
                                            <td>{{$wellData->water_rate}}</td>
                                            <td>{{$wellData->water_cut}}</td>
                                            <td>{{$wellData->suc_prss}}</td>
                                            <td>{{$wellData->dis_prss}}</td>
                                            <td>{{$wellData->temp}}</td>
                                            <td>{{$wellData->choke_set}}</td>
                                        </tr>
                                    @endforeach
                                {{-- @endforeach
                            
                            @endforeach --}}
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