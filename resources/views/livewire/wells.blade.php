<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 mb-3">
            <select name="trunk" id="trunk" class="form-select border border-0 border-bottom p-2 w-100" required wire:model="selectedArea" wire:change="changeArea($event.target.value)" required ">
                <option hidden selected> Choose A Area </option>
                @foreach ($allAreas as $area)
                    <option value="{{$area->id}}" @if ($selectedArea == $area->id) selected @endif>{{$area->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            @if ($selectedArea)
                <select name="trunk" id="trunk" class="form-select border border-0 border-bottom p-2 w-100" required wire:model="selectedTrunk" wire:change="changeTrunk($event.target.value)" ">
                    <option hidden selected> Choose A Trunk </option>
                    @foreach ($trunks as $trunk)
                        <option value="{{$trunk->id}}" @if ($selectedTrunk == $trunk->id) selected @endif>{{$trunk->name}}</option>
                    @endforeach
                </select>
            @endif
        </div>
        <div class="col-md-6 mb-3">
            @if ($wells)
            <select name="well_id" id="select-well" class="form-select border border-0 border-bottom p-2 w-100" required onfocus="checkWellStatus()" onchange="selectRadioByWellStatus()">
                <option disabled selected> Choose A Well </option>
                @foreach($wells as $well)
                    <option value="{{ $well->id }}" data-status="{{$well->receiver_status}}" data-sender-status="{{$well->sender_status}}">{{ $well->well }}  @if ($well->sender_status == 'testing') <span class="text-danger">(testing)</span> @endif </option>
                @endforeach
            </select>
            @endif
        </div>
    </div>
</div>