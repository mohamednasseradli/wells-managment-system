<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\Trunk;
use Livewire\Component;

class Trunks extends Component
{
    public $allAreas;
    public $selectedArea;
    public $trunks;

    protected $rules = [
        'selectedArea' => 'required',
    ];
    
    public function render()
    {
        return view('livewire.trunks');
    }

    public function mount()
    {
        $this->allAreas = Area::all();
    }

    public function changeArea($areaId)
    {
        $this->selectedArea = $areaId;
        $this->trunks         = Trunk::where('area_id', $areaId)->get();
    }
}
