<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\Trunk;
use App\Models\Well;
use Livewire\Component;

class Wells extends Component
{
    // public $allTrunks;
    public $allAreas;
    public $selectedArea;
    public $selectedTrunk;
    public $trunks;
    public $wells;

    protected $rules = [
        'selectedArea' => 'required',
        'selectedTrunk' => 'required',
    ];
    
    public function render()
    {
        return view('livewire.wells');
    }

    public function mount()
    {
        $this->allAreas = Area::all();
    }

    public function changeArea($areaId)
    {
        $this->selectedArea     = $areaId;
        $this->trunks           = Trunk::where('area_id', $areaId)->get();
        $this->wells            = null;
    }
    public function changeTrunk($trunkId)
    {
        $this->selectedTrunk    = $trunkId;
        $this->wells            = Well::where('trunk_id', $trunkId)->get();
    }

}
