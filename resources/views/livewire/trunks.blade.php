<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 mb-3">
            <select name="area" id="area" class="rounded-0 form-control w-100" required wire:model="selectedArea" wire:change="changeArea($event.target.value)" required ">
                <option hidden selected> Choose A Area </option>
                @foreach ($allAreas as $area)
                    <option value="{{$area->id}}" @if ($selectedArea == $area->id) selected @endif>{{$area->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            @if ($trunks)
                <select name="trunk" id="select-trunk" class="rounded-0 form-control w-100" required>
                    <option disabled hidden selected> Choose A Trunk </option>
                    @foreach($trunks as $trunk)
                        <option value="{{ $trunk->id }}">{{ $trunk->name }} </option>
                    @endforeach
                </select>
            @endif
        </div>
        <div class="col-md-4 mb-3">
            <input type="number" name="well" class="rounded-0 form-control w-100" required placeholder="Enter Well">
        </div>
        <div class="col-md-4 mb-3 d-flex align-items-center">
            <button type="submit" class="btn m-btn w-100">
                Add Well
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
    </div>
</div>