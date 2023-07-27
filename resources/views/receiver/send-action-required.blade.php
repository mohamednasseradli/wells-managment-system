<x-header title="Sender Dashboard" />

    {{-- Toggle Sidebar icon --}}
    <div class="toggle-sidebar">
        <i class="fa-solid fa-bars fa-lg"></i>
    </div>
    <div class="receiver-dashboard container-fluid" style="min-height: 100vh">
        <div class="row">
            <div class="col-lg-1 col-md-12 sidebar-container">
                <x-user-sidebar />
            </div>
            <div class="col-lg-9 col-md-12 content-container pt-5">
                <h1 class="text-center">Action Required</h1>
                <form action="{{url('/receiver/send-action-required')}}" method="POST">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="" class="mb-2">Field</label>
                                <input type="number" name="field" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="mb-2">Field Note</label>
                                <input type="text" name="field_note" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="operation" class="me-3">Operation </label>
                                <input type="number" name="operation" id="operation" class="form-control" required >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="mb-2">Operation Note</label>
                                <input type="text" name="operation_note" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-5 mb-3 my-4 text-center ">
                            <input type="submit" value="share" class="btn btn-success w-100">
                        </div>
                    </div>
                </form>
            </div>
            {{-- Details Sidbar --}}
            <div class="col-lg-2 border-start d-md-block d-none">
                <x-receiver-details-sidebar />
            </div>
        </div>
    </div>
<x-footer />